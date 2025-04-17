<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Rover;
use App\Grid;

class RoverTest extends TestCase
{
    public function testSimpleMovementWithoutObstacle()
    {
        // Creamos una grilla sin obstáculos
        $grid = new Grid(5, 5);
        $rover = new Rover(0, 0, 'N');

        // Comandos: avanzar 2 veces, girar a la derecha, avanzar 2 veces
        $commands = ['M', 'M', 'R', 'M', 'M'];

        foreach ($commands as $command) {
            $rover->move($command, $grid);
        }

        $position = $rover->getPosition();

        $this->assertEquals(2, $position['x']);
        $this->assertEquals(2, $position['y']);
        $this->assertEquals('E', $position['orientation']);
    }

    public function testObstacleStopsMovement()
    {
        // Grilla con un obstáculo virtual: posición (0, 2) no es válida
        $grid = new class(5, 5) extends Grid {
            public function isPositionValid($x, $y) {
                return !($x === 0 && $y === 2) && parent::isPositionValid($x, $y);
            }
        };

        $rover = new Rover(0, 0, 'N');

        // Comandos: intentar avanzar 3 veces hacia el Norte
        $commands = ['M', 'M', 'M'];
        foreach ($commands as $command) {
            try {
                $rover->move($command, $grid);
            } catch (\Exception $e) {
                break; // Detenemos si hay excepción
            }
        }

        $position = $rover->getPosition();

        // El rover debe haberse detenido en (0, 1)
        $this->assertEquals(0, $position['x']);
        $this->assertEquals(1, $position['y']);
        $this->assertEquals('N', $position['orientation']);
    }
}
