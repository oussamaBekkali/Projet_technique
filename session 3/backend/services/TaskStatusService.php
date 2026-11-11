<?php

require_once __DIR__ . "/BaseService.php";
require_once __DIR__ . "/../dao/TaskStatusDAO.php";

class TaskStatusService extends BaseService
{
    private TaskStatusDAO $taskStatusDAO;

    public function __construct()
    {
        $this->taskStatusDAO = new TaskStatusDAO();
    }

    public function getAll(): array
    {
        $data = [];
        foreach ($this->taskStatusDAO->findAll() as $status) {
            $data[] = [
                "id" => $status->getId(),
                "name" => $status->getName(),
                "description" => $status->getDescription(),
            ];
        }

        return $data;
    }

    public function add(): array
    {
        $input = json_decode(file_get_contents("php://input"), true);
        if (
            !is_array($input)
            || !isset($input["name"], $input["description"])
            || !is_string($input["name"])
            || !is_string($input["description"])
        ) {
            throw new InvalidArgumentException("Name and description are required.");
        }

        $this->taskStatusDAO->add($input["name"], $input["description"]);
        return ["message" => "TaskStatus added successfully."];
    }
}
