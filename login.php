<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 🔐 هات المستخدم فقط بالـ username
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // ✅ استخدم password_verify للمقارنة
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: tasks.php");
            exit();
        } else {
            echo "Wrong password.";
        }
    } else {
        echo "User not found.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login Form</title>
<style>
  /* الخلفية مع تأثير التعتيم */
  body {
    margin: 0;
    height: 100vh;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: 
      linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
      url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
    background-size: cover;
    
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .login-container {
    background: rgba(255, 255, 255, 0.9);
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    width: 320px;
  }

  .login-container h2 {
    margin-bottom: 24px;
    color: #333;
    text-align: center;
  }

  .login-container input[type="text"],
  .login-container input[type="password"] {
    width: 100%;
    padding: 12px 14px;
    margin: 10px 0 20px 0;
    border: 1.8px solid #ddd;
    border-radius: 8px;
    font-size: 15px;
    transition: border-color 0.3s ease;
  }

  .login-container input[type="text"]:focus,
  .login-container input[type="password"]:focus {
    border-color: #007bff;
    outline: none;
  }

  .login-container button {
    width: 100%;
    padding: 12px;
    background: #007bff;
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .login-container button:hover {
    background: #0056b3;
  }
</style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form method="POST">
      <input name="username" type="text" placeholder="Username" required />
      <input name="password" type="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>

