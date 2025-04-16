<?php
session_start();

require_once '../src/controllers/ApiController.php';

$apiController = new ApiController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['command'])) {
    $command = $_GET['command'];
    $result = $apiController->moveRover($command);
    echo json_encode($result ?: ['error' => 'No se pudo mover el rover.']);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['command']) && $_GET['command'] === 'GET') {
    $result = $apiController->getRoverPosition();
    echo json_encode($result);
} else {
    echo json_encode(['error' => 'Método no permitido o parámetro incompleto.']);
}
