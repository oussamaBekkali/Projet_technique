<?php
require_once 'db.php';
$sql = "select * from developer";
$stmt = $pdo->query($sql);
$devs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql2 = "select * from taskstatus";
$stmt2 = $pdo->query($sql2);
$ts = $stmt2->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'] ?? "";
    $desc = $_POST['desc'] ?? "";
    $priority = $_POST['priority'] ?? "";
    $deadline = $_POST['deadline'] ?? "";
    $developer = $_POST['devs'] ?? "";
    $tss = $_POST['ts'] ?? "";
    if (!empty($title) && !empty($desc) && !empty($priority) && !empty($deadline) && !empty($developer) && !empty($ts)) {
        $sql = "insert into task (title, description, priority, deadline, id_developer, id_status) values (?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $title,
            $desc,
            $priority,
            $deadline,
            $developer,
            $tss
        ]);
        header("Location: 'index.php'");
        exit;
    } else {
        echo "failed";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 300px;
        }
    </style>
    <title>Add a task</title>
</head>

<body>
    <form method="post">
        <label>Title :</label>
        <input type="text" name="title">
        <label>Description :</label>
        <input type="text" name="desc">
        <select name="priority">
            <option>select priority</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>
        <label>Deadline :</label>
        <input type="date" name="deadline">
        <select name="devs">
            <?php
            foreach ($devs as $dev) {
                echo "<option value='{$dev['id_developer']}'>" . $dev["first_name"] . $dev["last_name"] . "</option>";
            }
            ?>

        </select>
        <select name="ts">
            <?php
            foreach ($ts as $t) {
                echo "<option value='{$t['id_status']}'>" . $t["name"] . "</option>";
            }
            ?>

        </select>
        <button type="submit">add</button>
    </form>
</body>

</html>