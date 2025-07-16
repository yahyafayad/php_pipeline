<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO tasks (title, user_id) VALUES ('$title', $user_id)";
    mysqli_query($conn, $query);
    header("Location: tasks.php");
    exit();
}
?>

<form method="POST">
    <input name="title" placeholder="Task Title">
    <button type="submit">Add</button>
</form>