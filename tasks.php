<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM tasks WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Tasks</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f7fa;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 60px auto;
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    .actions {
      display: flex;
      justify-content: space-between;
      margin-bottom: 30px;
    }

    .actions a {
      text-decoration: none;
      background: #007bff;
      color: white;
      padding: 10px 15px;
      border-radius: 5px;
      transition: background 0.2s;
    }

    .actions a:hover {
      background: #0056b3;
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    li {
      background: #f0f4f8;
      margin: 10px 0;
      padding: 15px;
      border-radius: 6px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .task-title {
      font-size: 16px;
      color: #333;
    }

    .task-actions a {
      margin-left: 10px;
      text-decoration: none;
      padding: 6px 10px;
      border-radius: 4px;
      font-size: 14px;
      color: white;
    }

    .edit-btn {
      background: #28a745;
    }

    .edit-btn:hover {
      background: #218838;
    }

    .delete-btn {
      background: #dc3545;
    }

    .delete-btn:hover {
      background: #c82333;
    }

  </style>
</head>
<body>

<div class="container">
  <h2>مهامي</h2>

  <div class="actions">
    <a href="add_task.php">+ إضافة مهمة</a>
    <a href="logout.php">تسجيل الخروج</a>
  </div>

  <ul>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <li>
        <span class="task-title"><?= htmlspecialchars($row['title']) ?></span>
        <div class="task-actions">
          <a class="edit-btn" href="edit_task.php?id=<?= $row['id'] ?>">تعديل</a>
          <a class="delete-btn" href="delete_task.php?id=<?= $row['id'] ?>">حذف</a>
        </div>
      </li>
    <?php endwhile; ?>
  </ul>
</div>

</body>
</html>
