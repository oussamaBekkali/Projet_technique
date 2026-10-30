<?php

require_once __DIR__ . "/../controller/TaskStatusController.php";

header("Content-Type: application/json");

$methode = $_SERVER["REQUEST_METHOD"];
$controller = new ControllerTs();

try {
    if ($methode === "GET") {
        echo json_encode($controller->list());
    } elseif ($methode === "POST") {
        echo json_encode($controller->addTaskStatus());
    } else {
        http_response_code(405);
        echo json_encode([
            "message" => "Method not allowed"
        ]);
    }
} catch (Throwable $e) {
    http_response_code(500);

    echo json_encode([
        "message" => "Internal server error"
    ]);
}
