<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$userIngredient = new UserIngredient();

//get data
$data = json_decode(file_get_contents('php://input'));

if (!isset($data->userId) || !isset($data->ingredientId) || !isset($data->quantity)) {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid key']);
    exit;
}

if (empty($data->userId) || empty($data->ingredientId) || empty($data->quantity)) {
    http_response_code(400);
    echo json_encode(['message' => 'Empty data']);
    exit;
}

$userId = $data->userId;
$ingredientId = $data->ingredientId;
$quantity = $data->quantity;

$result = $userIngredient->create($userId, $ingredientId, $quantity);
http_response_code(200);
echo json_encode(['message' => 'User\'s ingredient created successfully']);
