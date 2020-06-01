<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$user = new User();

//get data
$data = json_decode(file_get_contents('php://input'));

if(!isset($data->pseudo) || !isset($data->password)){
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid key']);
    exit;
}

if (empty($data->pseudo) || empty($data->password)) {
    http_response_code(400);
    echo json_encode(['message' => 'Empty data']);
    exit;
}

$pseudo = $data->pseudo;
$password = $data->password;

$result = $user->create($pseudo, $password);
http_response_code(200);
echo json_encode(['message' => 'User created successfully']);
