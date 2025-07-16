<?php
$conn = mysqli_connect("localhost", "root", "", "taskapp");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>