<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$ingredients = new Ingredient();

$results = $ingredients->read();

if (!empty($results)) {
    http_response_code(200);
    echo json_encode($results);
} else {
    http_response_code(204);
    echo json_encode($results);
}
