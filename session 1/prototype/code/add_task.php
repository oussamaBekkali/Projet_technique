<?php require_once 'db.php';
$sql = $pdo->query("SELECT id_developer, first_name, last_name FROM developer");
$devs = $sql->fetchAll(PDO::FETCH_ASSOC);
$sql2 = $pdo->query("SELECT id_status, name FROM taskstatus");
$taskstatus = $sql2->fetchAll(PDO::FETCH_ASSOC);
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"] ?? "";
    $desc = $_POST["desc"] ?? "";
    $priority = $_POST["priority"] ?? "";
    $deadline = $_POST["deadline"] ?? "";
    $developer = $_POST["devs"] ?? "";
    $ts = $_POST["tstatus"] ?? "";
    if (!empty($title) && !empty($desc) && !empty($priority) && !empty($deadline) && !empty($developer) && !empty($ts)) {
        $sql = "INSERT INTO task (title, description, priority, deadline, id_developer, id_status) VALUES (?, ?, ?, ?, ?, ?)";
        $ins = $pdo->prepare($sql);
        $ins->execute([$title, $desc, $priority, $deadline, $developer, $ts]);
        $message = "<p id='succ'>success</p>";
    } else {
        $message = "<p id='err'>All fields are required</p>";
    }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 300px;
        }

        #err {
            color: red;
        }

        #succ {
            color: green;
        }
    </style>
    <title>New task</title>
</head>

<body>
    <form method="post">
        <label>Title</label>
        <input type="text" name="title">
        <label>Description</label>
        <input type="text" name="desc">
        <label>Priority</label>
        <select name="priority">
            <option value="">Choose priority</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>
        <label>Deadline</label>
        <input type="date" name="deadline">
        <label>Developer</label> <select name="devs">
            <option value="">Choose developer</option>
            <?php foreach ($devs as $dev) { ?>
                <option value="<?= $dev['id_developer'] ?>">
                    <?= $dev["first_name"] . " " . $dev["last_name"] ?>
                </option> <?php } ?>
        </select>
        <label>Status</label>
        <select name="tstatus">
            <option value="">Choose status</option>
            <?php foreach ($taskstatus as $ts) { ?>
                <option value="<?= $ts['id_status'] ?>"> <?= $ts["name"] ?> </option> <?php } ?>
        </select> <button type="submit">Add</button>
    </form>
    <br>
    <?php if ($message) {
        echo $message;
    } ?>
</body>

</html>