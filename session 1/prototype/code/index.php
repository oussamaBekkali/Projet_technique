<?php
require_once 'db.php';
$query = "SELECT task.title, task.description, task.priority, task.deadline, task.date_created, developer.first_name, developer.last_name, taskstatus.name AS status_name FROM task JOIN developer ON task.id_developer = developer.id_developer JOIN taskstatus ON task.id_status = taskstatus.id_status";
$resp = $pdo->query($query);
$tasks = $resp->fetchAll(PDO::FETCH_ASSOC); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        table {
            border-collapse: collapse;
            margin-top: 30px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid black;
        }

        th {
            background-color: #eee;
        }
    </style>
    </style>
    <title>Tasks list</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Deadline</th>
            <th>Date Created</th>
            <th>Developer</th>
            <th>Status</th>
        </tr> <?php foreach ($tasks as $task) {
                    echo "<tr>";
                    echo "<td>" . $task["title"] . "</td>";
                    echo "<td>" . $task["description"] . "</td>";
                    echo "<td>" . $task["priority"] . "</td>";
                    echo "<td>" . $task["deadline"] . "</td>";
                    echo "<td>" . $task["date_created"] . "</td>";
                    echo "<td>" . $task["first_name"] . " " . $task["last_name"] . "</td>";
                    echo "<td>" . $task["status_name"] . "</td>";
                    echo "</tr>";
                } ?>
    </table>
    <hr>
    <a href="add_task.php">New task</a>
</body>

</html>