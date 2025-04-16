<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Rover;
use App\Grid;

class RoverTest extends TestCase
{
    public function testSimpleMovementWithoutObstacle()
    {
        $grid = new Grid();
        $rover = new Rover(0, 0, 'N', $grid);

        $result = $rover->executeCommands('FFRFF');

        $this->assertEquals('ok', $result['status']);
        $this->assertEquals(2, $result['x']);
        $this->assertEquals(2, $result['y']);
        $this->assertEquals('E', $result['direction']);
    }

    public function testObstacleStopsMovement()
    {
        $grid = new Grid(200, 200, [['x' => 0, 'y' => 2]]);
        $rover = new Rover(0, 0, 'N', $grid);

        $result = $rover->executeCommands('FFF');

        $this->assertEquals('obstacle', $result['status']);
        $this->assertEquals(0, $result['x']);
        $this->assertEquals(1, $result['y']);
    }
}
