<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$step = new Step();

//get data
$data = json_decode(file_get_contents('php://input'));

if(!isset($data->recipeId) || !isset($data->order) || !isset($data->description)){
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid key']);
    exit;
}

if (empty($data->recipeId) || empty($data->order) || empty($data->description)) {
    http_response_code(400);
    echo json_encode(['message' => 'Empty data']);
    exit;
}

$result = $step->create($data->recipeId,$data->order,$data->description);
http_response_code(200);
echo json_encode(['message' => 'Step created successfully']);
