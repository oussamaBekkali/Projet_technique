<?php
require_once 'db.php';
$sql = "SELECT task.title, task.description, task.priority, task.date_created, task.deadline, developer.first_name, developer.last_name,taskstatus.name AS status_name FROM task JOIN developer ON task.id_developer = developer.id_developer JOIN taskstatus ON task.id_status = taskstatus.id_status";
$stmt = $pdo->query($sql);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            flex-direction: column;

        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 20px;
        }

        th {
            background-color: #eee;
        }
    </style>
    <title>Tasks list</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>title</th>
            <th>description</th>
            <th>priority</th>
            <th>date created</th>
            <th>deadline</th>
            <th>developer</th>
            <th>status</th>
        </tr>
        <?php foreach ($tasks as $task) {
            echo "<tr>";
            echo "<td>" . $task["title"] . "</td>";
            echo "<td>" . $task["description"] . "</td>";
            echo "<td>" . $task["priority"] . "</td>";
            echo "<td>" . $task["date_created"] . "</td>";
            echo "<td>" . $task["deadline"] . "</td>";
            echo "<td>" . $task["first_name"] . " " . $task["last_name"] . "</td>";
            echo "<td>" . $task["status_name"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <hr>
    <a href="add_task.php">Add a new task</a>
</body>

</html>