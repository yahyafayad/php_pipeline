<?php
session_start();
include("db.php");

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    mysqli_query($conn, "UPDATE tasks SET title = '$title' WHERE id = $id");
    header("Location: tasks.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM tasks WHERE id = $id");
$row = mysqli_fetch_assoc($result);
?>

<form method="POST">
    <input name="title" value="<?= $row['title'] ?>">
    <button type="submit">Save</button>
</form>