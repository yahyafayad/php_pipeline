<?php
session_start();
include("db.php");

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM tasks WHERE id = $id");

header("Location: tasks.php");
?>