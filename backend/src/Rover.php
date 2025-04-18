<?php

namespace App;

/**
 * Clase Rover
 * 
 * Representa un vehículo (rover) que puede moverse sobre un grid en las direcciones (x, y)
 * en las coordenadas Norte, Sur, Este y Oeste.
 */
class Rover {
    // Propiedades privadas que definen la posición actual y la orientación del rover
    private $x;
    private $y;
    private $orientation;

    /**
     * Constructor del rover
     * 
     * @param int $x           Posición horizontal inicial (columna)
     * @param int $y           Posición vertical inicial (fila)
     * @param string $orientation Dirección inicial del rover: 'N', 'E', 'S', 'W'
     */
    public function __construct($x = 0, $y = 0, $orientation = 'N') {
        $this->x = $x;
        $this->y = $y;
        $this->orientation = $orientation;
    }

    /**
     * Ejecuta un movimiento basado en el comando recibido.
     * 
     * @param string $direction Comando de movimiento: 
     *                          'M' para avanzar, 
     *                          'L' para girar a la izquierda,
     *                          'R' para girar a la derecha.
     * @param Grid $grid Objeto Grid para validar los límites del mapa.
     * @throws \Exception Si el movimiento resulta en una posición fuera del grid.
     */
    public function move($direction, $grid) {
        switch ($direction) {
            case 'M': // Moverse hacia adelante según orientación actual
                $this->moveForward($grid);
                break;
            case 'L': // Girar a la izquierda
                $this->turnLeft();
                break;
            case 'R': // Girar a la derecha
                $this->turnRight();
                break;
        }

        // Validación final: si la nueva posición es inválida, lanzar excepción
        if (!$grid->isPositionValid($this->x, $this->y)) {
            throw new \Exception("Posición fuera de los límites del mapa");
        }
    }

    /**
     * Mueve el rover hacia adelante según su orientación actual.
     * Si el movimiento lo saca del grid, se restaura la posición anterior.
     * 
     * @param Grid $grid Objeto Grid para validación de posición.
     */
    private function moveForward($grid) {
        // Guardamos la posición actual en caso de necesitar revertir
        $prevX = $this->x;
        $prevY = $this->y;

        // Avanza en la dirección actual
        switch ($this->orientation) {
            case 'N': $this->y++; break;
            case 'S': $this->y--; break;
            case 'E': $this->x++; break;
            case 'W': $this->x--; break;
        }

        // Si la nueva posición no es válida, revertimos
        if (!$grid->isPositionValid($this->x, $this->y)) {
            // Restauramos la posición original
            $this->x = $prevX;
            $this->y = $prevY;
        }
    }

    /**
     * Gira el rover 90 grados a la izquierda
     */
    private function turnLeft() {
        # Formato ternario
        $this->orientation = $this->orientation === 'N' ? 'W' :
                             ($this->orientation === 'W' ? 'S' :
                             ($this->orientation === 'S' ? 'E' : 'N'));

        /*
            if ($this->orientation === 'N') {
                $this->orientation = 'W';
            } elseif ($this->orientation === 'W') {
                $this->orientation = 'S';
            } elseif ($this->orientation === 'S') {
                $this->orientation = 'E';
            } else {
                $this->orientation = 'N';
            }
        */
    }

    /**
     * Gira el rover 90 grados a la derecha
     */
    private function turnRight() {
        $this->orientation = $this->orientation === 'N' ? 'E' :
                             ($this->orientation === 'E' ? 'S' :
                             ($this->orientation === 'S' ? 'W' : 'N'));
    }

    /**
     * Devuelve la posición actual del rover junto con su orientación.
     * 
     * @return array ['x' => int, 'y' => int, 'orientation' => string]
     */
    public function getPosition() {
        return [
            'x' => $this->x,
            'y' => $this->y,
            'orientation' => $this->orientation
        ];
    }
}
