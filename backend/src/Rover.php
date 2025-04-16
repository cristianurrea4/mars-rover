<?php

namespace App;

class Rover {
    private $x;
    private $y;
    private $orientation;

    // Orientación: Norte (N), Este (E), Sur (S), Oeste (W)
    public function __construct($x = 0, $y = 0, $orientation = 'N') {
        $this->x = $x;
        $this->y = $y;
        $this->orientation = $orientation;
    }

    // Método para mover el rover
    public function move($direction, $grid) {
        switch ($direction) {
            case 'M': // Mover adelante
                $this->moveForward($grid);
                break;
            case 'L': // Girar a la izquierda
                $this->turnLeft();
                break;
            case 'R': // Girar a la derecha
                $this->turnRight();
                break;
        }

        // Verifica que la nueva posición sea válida
        if (!$grid->isPositionValid($this->x, $this->y)) {
            throw new \Exception("Posición fuera de los límites del mapa");
        }
    }

    // Método para mover hacia adelante
    private function moveForward($grid) {
        // Guardar la posición anterior para restaurarla si la nueva posición es inválida
        $prevX = $this->x;
        $prevY = $this->y;
        switch ($this->orientation) {
            case 'N': $this->y++; break;
            case 'S': $this->y--; break;
            case 'E': $this->x++; break;
            case 'W': $this->x--; break;
        }
       
        // Verifica si la nueva posición es válida
        if (!$grid->isPositionValid($this->x, $this->y)) {
            echo json_decode("entro");
            // Restaurar la posición anterior si la nueva es inválida
            $this->x = $prevX;
            $this->y = $prevY;
        }
    }

    private function turnLeft() {
        $this->orientation = $this->orientation === 'N' ? 'W' : ($this->orientation === 'W' ? 'S' : ($this->orientation === 'S' ? 'E' : 'N'));
    }

    private function turnRight() {
        $this->orientation = $this->orientation === 'N' ? 'E' : ($this->orientation === 'E' ? 'S' : ($this->orientation === 'S' ? 'W' : 'N'));
    }

    public function getPosition() {
        return ['x' => $this->x, 'y' => $this->y, 'orientation' => $this->orientation];
    }
}

