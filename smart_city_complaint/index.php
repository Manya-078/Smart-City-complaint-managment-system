<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $role = $_POST['role'];

    if ($role == 'user') {
        $sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['user'] = $uname;
            header("Location: user_dashboard.php");
        } else {
            echo "<script>alert('Invalid Credentials');</script>";
        }
    }

    if ($role == 'admin') {
        $sql = "SELECT * FROM admin WHERE username='$uname' AND password='$pass'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['admin'] = $uname;
            header("Location: admin_dashboard.php");
        } else {
            echo "<script>alert('Invalid Credentials');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Smart City Complaint Management System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #e3f2fd;
        }

        /* Header container for main topic name */
        .header-container {
            background-color: #0288d1;
            color: #ffffff;
            padding: 50px 0;
            text-align: center;
            font-size: 34px;
            font-weight: bold;
            letter-spacing: 1px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .main-container {
            text-align: center;
            padding: 30px 20px;
        }

        .login-container {
            background: #ffffff;
            width: 400px;
            max-width: 90%;
            margin: 30px auto;
            padding: 35px 25px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
            text-align: left;
        }

        .login-container h2 {
            text-align: center;
            color: #0288d1;
            margin-bottom: 25px;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container select,
        .login-container input[type="text"],
        .login-container input[type="password"] {
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #cfd8dc;
            border-radius: 6px;
            font-size: 16px;
        }

        .login-container button {
            padding: 14px;
            background-color: #0288d1;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            margin-top: 20px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-container button:hover {
            background-color: #0277bd;
        }

        .register-container {
            text-align: center;
            margin-top: 20px;
        }

        .register-link {
            color: #0288d1;
            text-decoration: none;
            font-size: 14px;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            color: #777;
            font-size: 13px;
        }
    </style>
</head>
<body>

<!-- Header Container -->
<div class="header-container">
    Smart City Complaint Management System
</div>

<div class="main-container">
    <div class="login-container">
        <h2>Login Portal</h2>

        <form method="post">
            <select name="role" required>
                <option value="">-- Select Role --</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login">Login</button>

            <div class="register-container">
                <a href="user_register.php" class="register-link">Don't have an account? Register here</a>
            </div>
        </form>
    </div>
</div>

<div class="footer">
    &copy; 2025 Smart City Complaint Management System. All rights reserved.
</div>

</body>
</html>
