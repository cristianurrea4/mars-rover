<?php
require_once __DIR__ . '/../Rover.php';
require_once __DIR__ . '/../Grid.php';

use App\Rover;
use App\Grid;

class ApiController {

    public function moveRover($direction) {
        $grid = new Grid();

        if (isset($_SESSION['rover'])) {
            $roverData = $_SESSION['rover'];
            $rover = new Rover($roverData['x'], $roverData['y'], $roverData['orientation']);
        } else {
            $rover = new Rover(); 
        }

        try {
            $rover->move($direction, $grid);
            $_SESSION['rover'] = $rover->getPosition();
            return $rover->getPosition();
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getRoverPosition() {
        if (isset($_SESSION['rover'])) {
            return $_SESSION['rover'];
        } else {
            return (new Rover())->getPosition();
        }
    }
}
