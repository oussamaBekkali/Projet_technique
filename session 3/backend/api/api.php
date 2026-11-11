<?php

require_once __DIR__ . "/../services/TaskStatusService.php";

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"] ?? "";

try {
    $service = new TaskStatusService();

    if ($method === "GET") {
        $response = $service->getAll();
    } elseif ($method === "POST") {
        $response = $service->add();
        http_response_code(201);
    } else {
        http_response_code(405);
        header("Allow: GET, POST");
        $response = ["message" => "Method not allowed"];
    }

    echo json_encode($response, JSON_THROW_ON_ERROR);
} catch (InvalidArgumentException $e) {
    http_response_code(400);
    echo json_encode(["message" => $e->getMessage()]);
} catch (Throwable $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo json_encode(["message" => "Internal server error"]);
}
