<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

if (!isset($_GET['userId']) || !isset($_GET['recipeId']) || empty($_GET['userId']) || empty($_GET['recipeId'])) {
    http_response_code(400);
    echo json_encode(['message' => 'Bad Request']);
    exit;
}

$userId = $_GET['userId'];
$recipeId = $_GET['recipeId'];
$recipe = new Recipe();
$result = $recipe->read_single($userId, $recipeId);

if (!empty($result)) {
    http_response_code(200);
    echo json_encode($result);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'No Content']);
}
