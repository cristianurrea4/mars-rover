<?php

// Carga automática de clases desde composer
require_once __DIR__ . '/../vendor/autoload.php';

// Importación de clases necesarias
use PHPUnit\Framework\TestCase;
use App\Rover;
use App\Grid;

/**
 * Clase de pruebas unitarias para el Rover, clase abstracta TestCase
 */
class RoverTest extends TestCase
{
    /**
     * Prueba el movimiento básico del rover sin ningún obstáculo
     * 
     * Escenario:
     * - El rover empieza en (0, 0, N) mirando al norte.
     * - Se mueve dos veces hacia adelante -> (0, 2, N).
     * - Gira a la derecha -> ahora mira al Este -> (0, 2, E).
     * - Se mueve dos veces hacia adelante -> (2, 2, E).
     * - Resultado esperado: (2, 2, E) orientación 'E'.
     */
    public function testSimpleMovementWithoutObstacle()
    {
        // Crea un grid de 5x5 sin obstáculos
        $grid = new Grid(5, 5);
        $rover = new Rover(0, 0, 'N');

        // Secuencia de comandos a ejecutar
        $commands = ['M', 'M', 'R', 'M', 'M'];

        // Ejecutamos cada comando
        foreach ($commands as $command) {
            $rover->move($command, $grid);
        }

        // Obtenemos la posición final
        $position = $rover->getPosition();

        // Verificamos que esté en la posición esperada
        // assertEquals método de PHPUnit que permite comparar dos valores y si son iguales pasa la prueba sino falla.
        $this->assertEquals(2, $position['x']);
        $this->assertEquals(2, $position['y']);
        $this->assertEquals('E', $position['orientation']);
    }

    /**
     * Prueba cómo reacciona el rover ante un "obstáculo"
     * 
     * Escenario:
     * - Creamos un grid extendida que considera (0, 2) como una posición inválida (simulando obstáculo).
     * - El rover comienza en (0, 0, N) mirando al norte.
     * - Intenta avanzar 3 veces.
     * - Debería detenerse antes de entrar en (0, 2, N), es decir, quedarse en (0, 1, N).
     */
    public function testObstacleStopsMovement()
    {
        // Creamos un grid personalizada extendiendo Grid, donde (0, 2) es un obstáculo
        $grid = new class(5, 5) extends Grid {
            public function isPositionValid($x, $y) {
                // Posición (0, 2) es considerada como un obstáculo
                // parent: Llama a la clase padre (Grid) porque necesitamos verificar las coordenadas x, y
                // Por lo tanto si las coordenadas son (0, 2), siempre devolverá "false" ya que es una posición con obstaculo
                // Si las coordenadas son válida segudo la clase padre Grid y no son (0, 2), devuelve true y sino false
                return !($x === 0 && $y === 2) && parent::isPositionValid($x, $y);
            }
        };

        // Inicializamos el rover en la posición (0, 0), mirando al norte
        $rover = new Rover(0, 0, 'N');

        // Comandos: intenta moverse 3 veces al norte
        $commands = ['M', 'M', 'M'];

        // Ejecutamos cada comando, deteniéndonos si hay una excepción
        foreach ($commands as $command) {
            try {
                $rover->move($command, $grid);
            } catch (\Exception $e) {
                break;
            }
        }

        // Obtenemos la posición después de los movimientos
        $position = $rover->getPosition();

        // Esperamos que el rover se haya detenido en (0, 1, N) mirando al norte
        $this->assertEquals(0, $position['x']);
        $this->assertEquals(1, $position['y']);
        $this->assertEquals('N', $position['orientation']);
    }
}
