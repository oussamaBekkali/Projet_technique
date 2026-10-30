<?php
require_once __DIR__ . "/../classes/GestionTs.php";
class ControllerTs
{
    private GestionTs $gestion;
    public function __construct()
    {
        $this->gestion = new GestionTs();
    }

    public function list()
    {
        $Ts = $this->gestion->display();

        $data = [];

        foreach ($Ts as $status) {
            $data[] = [
                "id" => $status->getId(),
                "name" => $status->getName(),
                "description" => $status->getDescription(),
            ];
        }
        return $data;
    }

    public function addTaskStatus()
    {
        $input = json_decode(file_get_contents("php://input"), true);
        $this->gestion->add($input["name"], $input["description"]);
        return ["message" => "New TaskStatus apeared!"];
    }
}
