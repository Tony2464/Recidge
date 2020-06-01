<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$user = new User();

//get data
$data = json_decode(file_get_contents('php://input'));

if (isset($data->userId)) {
    if (!empty($data->userId)) {
        if (isset($data->pseudo) || isset($data->password)) {
            if (isset($data->pseudo) && isset($data->password)) {
                if (!empty($data->pseudo) && !empty($data->password)) {
                    $user->update($data->userId, $data->pseudo, $data->password);
                    http_response_code(200);
                    echo json_encode(['message' => 'User pseudo and data updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['message' => 'UserId or password empty']);
                }
            } else {
                if (isset($data->pseudo)) {
                    if (!empty($data->pseudo)) {
                        $user->update($data->userId, $data->pseudo);
                        http_response_code(200);
                        echo json_encode(['message' => 'User pseudo updated successfully']);
                    } else {
                        http_response_code(400);
                        echo json_encode(['message' => 'Pseudo empty']);
                    }
                } else {
                    if (!empty($data->password)) {
                        $user->update($data->userId, $data->password);
                        http_response_code(200);
                        echo json_encode(['message' => 'User password updated successfully']);
                    } else {
                        http_response_code(400);
                        echo json_encode(['message' => 'Password empty']);
                    }
                }
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Unvalid pseudo and password key']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'UserId empty']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid userId key']);
}
