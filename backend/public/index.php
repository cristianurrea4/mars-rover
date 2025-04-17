<?php
// Inicia una sesión PHP para poder almacenar información persistente entre peticiones (como la posición del rover)
session_start();

// Incluye el archivo del controlador principal de la API, que contiene la lógica de control del rover
require_once '../src/controllers/ApiController.php';

// Se crea una instancia del controlador de la API, que se usará para procesar los comandos
$apiController = new ApiController();

// Si se recibe una petición POST con un parámetro 'command', se interpreta como una orden para mover el rover
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['command'])) {
    $command = $_GET['command']; // Obtiene el comando enviado desde el frontend (por ejemplo: M, L, R)
    $result = $apiController->moveRover($command); // Envía el comando al controlador para procesarlo
    echo json_encode($result ?: ['error' => 'No se pudo mover el rover.']); // Devuelve el resultado como JSON

// Si se recibe una petición GET con el comando "GET", se devuelve la posición actual del rover
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['command']) && $_GET['command'] === 'GET') {
    $result = $apiController->getRoverPosition(); // Obtiene la posición actual desde la sesión o el controlador
    echo json_encode($result); // Devuelve la posición como JSON

// Si no se cumple ninguna de las condiciones anteriores, se devuelve un error indicando un método o comando inválido
} else {
    echo json_encode(['error' => 'Método no permitido o parámetro incompleto.']);
}
