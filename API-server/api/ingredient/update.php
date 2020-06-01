<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Authorization,X-Requested-With');

//initialize API
require_once __DIR__ . '/../../includes/api_initialize.php';

$ingredient = new Ingredient();

//get data
$data = json_decode(file_get_contents('php://input'));

if (isset($data->ingredientId)) {
    if (!empty($data->ingredientId)) {
        if (isset($data->name) || isset($data->unit)) {
            if (isset($data->name) && isset($data->unit)) {
                if (!empty($data->name) && !empty($data->unit)) {
                    $ingredient->update($data->ingredientId, $data->name, $data->unit);
                    http_response_code(200);
                    echo json_encode(['message' => 'ingredient name and data updated successfully']);
                } else {
                    http_response_code(400);
                    echo json_encode(['message' => 'ingredientId or unit empty']);
                }
            } else {
                if (isset($data->name)) {
                    if (!empty($data->name)) {
                        $ingredient->update($data->ingredientId, $data->name);
                        http_response_code(200);
                        echo json_encode(['message' => 'ingredient name updated successfully']);
                    } else {
                        http_response_code(400);
                        echo json_encode(['message' => 'name empty']);
                    }
                } else {
                    if (!empty($data->unit)) {
                        $ingredient->update($data->ingredientId, $data->unit);
                        http_response_code(200);
                        echo json_encode(['message' => 'ingredient unit updated successfully']);
                    } else {
                        http_response_code(400);
                        echo json_encode(['message' => 'unit empty']);
                    }
                }
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Unvalid name and unit key']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'ingredientId empty']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Unvalid ingredientId key']);
}
