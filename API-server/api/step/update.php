<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$step = new Step();

//get data
$data = json_decode(file_get_contents('php://input'));

if (isset($data->stepId) && isset($data->order) && isset($data->description)) {
    if (!empty($data->stepId) && !empty($data->order) && !empty($data->description)) {
        $step->update($data->stepId, $data->order, $data->description);
        http_response_code(200);
        echo json_encode(['message' => 'Recipe\'s step updated successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Empty data']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid key']);
}
