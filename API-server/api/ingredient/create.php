<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$ingredient = new Ingredient();

//get data
$data = json_decode(file_get_contents('php://input'));

if(!isset($data->name) || !isset($data->unit)){
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid key']);
    exit;
}

if (empty($data->name) || empty($data->unit)) {
    http_response_code(400);
    echo json_encode(['message' => 'Empty data']);
    exit;
}

$name = $data->name;
$unit = $data->unit;

$result = $ingredient->create($name, $unit);
http_response_code(200);
echo json_encode(['message' => 'Ingredient successfully']);
