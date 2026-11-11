<?php

require_once __DIR__ . "/../classes/TaskStatus.php";

class TaskStatusDAO
{
    private string $file = __DIR__ . "/../data/data.json";

    public function findAll(): array
    {
        $taskStatuses = [];

        $content = @file_get_contents($this->file);
        if ($content === false) {
            throw new RuntimeException("Unable to read TaskStatus data.");
        }

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        if (!is_array($data)) {
            throw new RuntimeException("TaskStatus data is invalid.");
        }

        foreach ($data as $row) {
            $taskStatuses[] = new TaskStatus(
                $row["id"],
                $row["name"],
                $row["description"]
            );
        }

        return $taskStatuses;
    }

    public function add(string $name, string $description): void
    {
        if (trim($name) === "" || trim($description) === "") {
            throw new InvalidArgumentException("Name and description are required.");
        }

        $content = @file_get_contents($this->file);
        if ($content === false) {
            throw new RuntimeException("Unable to read TaskStatus data.");
        }

        $data = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        if (!is_array($data)) {
            throw new RuntimeException("TaskStatus data is invalid.");
        }

        $id = 0;
        foreach ($data as $row) {
            $id = max($id, (int) $row["id"]);
        }

        $taskStatus = new TaskStatus($id + 1, $name, $description);
        $data[] = [
            "id" => $taskStatus->getId(),
            "name" => $taskStatus->getName(),
            "description" => $taskStatus->getDescription(),
        ];

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
        if (@file_put_contents($this->file, $json, LOCK_EX) === false) {
            throw new RuntimeException("Unable to save TaskStatus data.");
        }
    }
}
