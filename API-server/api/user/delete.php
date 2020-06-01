<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$user = new User();

//get data
$data = json_decode(file_get_contents('php://input'));

if (isset($data->userId)) {
    if (!empty($data->userId)) {
        $user->delete($data->userId);
        http_response_code(200);
        echo json_encode(['message' => 'User deleted successfully']);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'UserId empty']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid userId key']);
}
