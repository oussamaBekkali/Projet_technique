<?php
require_once 'TaskStatus.php';

class GestionTs
{
    private static $file = __DIR__ . '/../data/data.json';
    public function display()
    {
        $content = file_get_contents(self::$file);
        $ts = json_decode($content, true);
        $data = [];
        foreach ($ts as $taskst) {
            $data[] = new TaskStatus(
                $taskst['id'],
                $taskst['name'],
                $taskst['description']
            );
        }
        return $data;
    }
    public function add(string $name, string $description)
    {
        $content = file_get_contents(self::$file);
        $data = json_decode($content, true);


        $id = count($data) + 1;
        $status[] = new TaskStatus($id, $name, $description);

        $data[] = [
            "id" => $id,
            "name" => $name,
            "description" => $description,
        ];


        file_put_contents(self::$file, json_encode($data, JSON_PRETTY_PRINT));
    }
}
