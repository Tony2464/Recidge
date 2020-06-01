<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$step = new Step();

//get data
$data = json_decode(file_get_contents('php://input'));

if (isset($data->stepId)) {
    if (!empty($data->stepId)) {
        $step->delete($data->stepId);
        http_response_code(200);
        echo json_encode(['message' => 'step deleted successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'stepId empty']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid stepId key']);
}
