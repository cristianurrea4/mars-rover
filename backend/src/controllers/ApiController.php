<?php
// Se incluyen las clases necesarias: Rover y Grid, ubicadas en el directorio superior
require_once __DIR__ . '/../Rover.php';
require_once __DIR__ . '/../Grid.php';

// Se importan los espacios de nombres (namespaces) definidos en las clases
use App\Rover;
use App\Grid;

/**
 * Clase ApiController
 * 
 * Este controlador maneja la lógica principal del backend para:
 * - Ejecutar movimientos del rover.
 * - Obtener su posición actual.
 * 
 * La sesión se usa para mantener el estado entre peticiones HTTP.
 */
class ApiController {

    /**
     * Ejecuta un comando de movimiento sobre el rover.
     * 
     * @param string $direction Comando de dirección: 'M' (mover), 'L' (girar izquierda), 'R' (girar derecha)
     * @return array Retorna la nueva posición del rover o un error si falla.
     */
    public function moveRover($direction) {
        $grid = new Grid(); // Se crea una grilla de 5x5 (por defecto)

        // Si ya hay una posición guardada en sesión, se crea el rover con esa posición, usame isset() "esta definida y no es null"
        if (isset($_SESSION['rover'])) {
            $roverData = $_SESSION['rover'];
            $rover = new Rover($roverData['x'], $roverData['y'], $roverData['orientation']);
        } else {
            // Si no existe una posición previa, se inicializa el rover en la posición (0, 0, N) orientado al norte
            $rover = new Rover(); 
        }

        try {
            // Se intenta ejecutar el movimiento en la grilla
            $rover->move($direction, $grid);

            // Si el movimiento fue exitoso, se guarda la nueva posición en la sesión
            $_SESSION['rover'] = $rover->getPosition();

            // Se devuelve la nueva posición del rover
            return $rover->getPosition();

        } catch (Exception $e) {
            // Si ocurre un error (como salirse del grid), se devuelve un mensaje de error
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Devuelve la posición actual del rover.
     * 
     * @return array Posición actual del rover (x, y, orientación)
     */
    public function getRoverPosition() {
        // Si hay una posición guardada en la sesión, se devuelve
        if (isset($_SESSION['rover'])) {
            return $_SESSION['rover']; # Podemos verificar la posicion a travez de la consola del navegador en netword->response
        } else {
            // Si no, se devuelve la posición inicial por defecto
            return (new Rover())->getPosition();
        }
    }
}
