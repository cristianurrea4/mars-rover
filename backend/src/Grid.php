<?php

// Se define el espacio de nombres para organizar mejor las clases del proyecto
namespace App;

/**
 * Clase Grid
 * 
 * Representa una grilla bidimensional que define el terreno sobre el que el rover se puede mover.
 * Por defecto, es una grilla de 5x5 unidades.
 */
class Grid {
    // Propiedades privadas que almacenan el ancho y el alto de la grilla
    private $width;
    private $height;

    /**
     * Constructor de la clase Grid
     * 
     * @param int $width  Ancho de la grilla (número de columnas)
     * @param int $height Alto de la grilla (número de filas)
     */
    public function __construct($width = 5, $height = 5) {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Verifica si una posición dada (x, y) está dentro de los límites válidos de la grilla.
     * 
     * @param int $x Coordenada X (columna)
     * @param int $y Coordenada Y (fila)
     * @return bool True si la posición es válida, False si está fuera del límite
     */
    public function isPositionValid($x, $y) {
        return $x >= 0 && $x < $this->width && $y >= 0 && $y < $this->height;
    }
}
