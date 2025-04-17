<?php

// Carga automática de clases desde composer
require_once __DIR__ . '/../vendor/autoload.php';

// Importación de clases necesarias
use PHPUnit\Framework\TestCase;
use App\Rover;
use App\Grid;

/**
 * Clase de pruebas unitarias para el Rover
 */
class RoverTest extends TestCase
{
    /**
     * Prueba el movimiento básico del rover sin ningún obstáculo
     * 
     * Escenario:
     * - El rover empieza en (0, 0) mirando al norte.
     * - Se mueve dos veces hacia adelante → (0, 2).
     * - Gira a la derecha → ahora mira al Este.
     * - Se mueve dos veces hacia adelante → (2, 2).
     * - Resultado esperado: (2, 2) orientación 'E'.
     */
    public function testSimpleMovementWithoutObstacle()
    {
        // Crea una grilla de 5x5 sin obstáculos
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
        $this->assertEquals(2, $position['x']);
        $this->assertEquals(2, $position['y']);
        $this->assertEquals('E', $position['orientation']);
    }

    /**
     * Prueba cómo reacciona el rover ante un "obstáculo"
     * 
     * Escenario:
     * - Creamos una grilla extendida que considera (0, 2) como una posición inválida (simulando obstáculo).
     * - El rover comienza en (0, 0) mirando al norte.
     * - Intenta avanzar 3 veces.
     * - Debería detenerse antes de entrar en (0, 2), es decir, quedarse en (0, 1).
     */
    public function testObstacleStopsMovement()
    {
        // Creamos una grilla personalizada extendiendo Grid, donde (0, 2) es un obstáculo
        $grid = new class(5, 5) extends Grid {
            public function isPositionValid($x, $y) {
                // Posición (0, 2) es considerada como un obstáculo
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

        // Esperamos que el rover se haya detenido en (0, 1) mirando al norte
        $this->assertEquals(0, $position['x']);
        $this->assertEquals(1, $position['y']);
        $this->assertEquals('N', $position['orientation']);
    }
}
