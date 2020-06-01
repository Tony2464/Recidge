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

$recipeId = $_GET['id'];
$recipeIngredients = new RecipeIngredient();
$results = $recipeIngredients->read($recipeId);

if (!empty($results)) {
    http_response_code(200);
    echo json_encode($results);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'No Content']);
}
