<?php

header("Content-Type: application/json");

require_once "TaskStatus.php";

$file = "data.json";

$statuses = json_decode(file_get_contents($file), true);


// GET → show all statuses
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo json_encode($statuses);
    exit;
}


// POST → add a status
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    $id = count($statuses) + 1;

    $status = new TaskStatus(
        $id,
        $data["name"],
        $data["description"]
    );

    $statuses[] = [
        "id" => $status->id,
        "name" => $status->name,
        "description" => $status->description
    ];

    file_put_contents(
        $file,
        json_encode($statuses, JSON_PRETTY_PRINT)
    );

    echo json_encode($status);
}
