<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$recipe = new Recipe();

//get data
$data = json_decode(file_get_contents('php://input'));

if (
    !isset($data->userId)
    || !isset($data->name)
    || !isset($data->person)
    || !isset($data->cookingTime)
    || !isset($data->preparationTime)
    || !isset($data->difficulty)
    || !isset($data->note)
) {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid key']);
    exit;
}

if (
    empty($data->userId)
    || empty($data->name)
    || empty($data->person)
    || empty($data->cookingTime)
    || empty($data->preparationTime)
    || empty($data->difficulty)
    || empty($data->note)
) {
    http_response_code(400);
    echo json_encode(['message' => 'Empty data']);
    exit;
}

$userId = $data->userId;
$name = $data->name;
$person = $data->person;
$cookingTime = $data->cookingTime;
$preparationTime = $data->preparationTime;
$difficulty = $data->difficulty;
$note = $data->note;

$result = $recipe->create($userId, $name, $person, $cookingTime, $preparationTime, $difficulty, $note);
http_response_code(200);
echo json_encode(['message' => 'Recipe created successfully']);
