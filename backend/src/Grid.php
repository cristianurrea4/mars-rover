<?php

// Se define el espacio de nombres para organizar mejor las clases del proyecto, esto evita conflictos de nombres cuando puede haber varias clases con el mismo nombre
namespace App;

/**
 * Clase Grid
 * 
 * Define el tamaño del terreno sobre el que el rover se puede mover.
 * Por defecto, el grid es de 5x5.
 */
class Grid {
    // Propiedades privadas que almacenan el ancho y el alto del grid, al ser privadas solo se usaran en esta clase
    private $width;
    private $height;

    /**
     * Constructor de la clase Grid
     * 
     * @param int $width  Ancho del grid (número de columnas)
     * @param int $height Alto del grid (número de filas)
     */
    public function __construct($width = 5, $height = 5) {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Verifica si una posición dada (x, y) está dentro de los límites válidos del grid.
     * 
     * @param int $x Coordenada X (columna)
     * @param int $y Coordenada Y (fila)
     * @return bool True si la posición es válida, False si está fuera del límite
     */

     # Método para comprovar si la posición es valida
    public function isPositionValid($x, $y) {
        # Lógica:
        # $x >= 0: Verifica primero que este en la posicion de inicio x=0, luego que este dentro de los limites del grid en la dirección horizontal (de izquierda a derecha)
        # $this->width: Nos dice el ancho del grid
        # $x >= 0 && $x < $this->width: Por lo tanto, esto quiere decir que si la posición del rover en el eje X horizontal es mayor al ancho "$width" quiere decir que esta
        # fuera de los limites y por lo tanto devolvera un false, sino pasarémos a la siguiente verificado en el eje Y vertical, es lo mismo que lo anteriores pero 
        # verifica en vertical de arriba a abajo, y luego se comprueba que no sea mayor a la altura "$height" del grid, porque sino es porque está fuera de los limites,
        # y devolveria un false, en caso contrario si se cumple todo devuelve un true.
        return $x >= 0 && $x < $this->width && $y >= 0 && $y < $this->height;
    }
}
