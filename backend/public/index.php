<?php
// Configurar el encabezado para permitir solicitudes desde cualquier origen (CORS)
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');  // O puedes restringir a tu dominio frontend: http://localhost:8080

// Aquí se cargan las rutas de la API
require_once '../src/ApiController.php';

$method = $_SERVER['REQUEST_METHOD']; // Obtiene el tipo de solicitud (GET, POST, PUT, DELETE)

// Enrutamiento básico
if ($method == 'GET') {
    ApiController::getData();
} elseif ($method == 'POST') {
    ApiController::postData();
} else {
    http_response_code(405); // Método no permitido
    echo json_encode(['error' => 'Método no permitido']);
}
