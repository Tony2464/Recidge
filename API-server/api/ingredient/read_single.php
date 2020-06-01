<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['message' => 'Bad Request']);
    exit;
}

$ingredientId = $_GET['id'];
$ingredient = new Ingredient();
$result = $ingredient->read_single($ingredientId);

if (!empty($result)) {
    http_response_code(200);
    echo json_encode($result);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'No Content']);
}
