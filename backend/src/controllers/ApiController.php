<?php

class ApiController {
    // Obtener datos (GET)
    public static function getData() {
        // Simula obtener datos (puedes reemplazarlo con la lógica de base de datos)
        echo json_encode(['message' => 'Datos obtenidos correctamente']);
    }

    // Insertar datos (POST)
    public static function postData() {
        // Recibe los datos en formato JSON
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['name'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Falta el campo "name"']);
            return;
        }
        
        echo json_encode(['message' => 'Datos guardados correctamente']);
    }
}
