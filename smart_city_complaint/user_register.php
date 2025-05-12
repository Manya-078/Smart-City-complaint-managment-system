<?php
session_start();
include 'config.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Check if user already exists
    $sql_check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "<script>alert('Username or Email already exists.');</script>";
    } else {
        // Insert new user into the database
        $sql_insert = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "<script>alert('Registration successful! You can now log in.');</script>";
            header("Location: index.php"); // Redirect to login page after successful registration
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}
?>

<form method="post" class="registration-form">
    <h2>User Registration</h2>
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <button type="submit" name="register">Register</button>
</form>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffe4b5; /* Peach background color */
        margin: 0;
        padding: 0;
    }

    .registration-form {
        width: 40%;
        margin: 100px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .registration-form h2 {
        color: #333;
        margin-bottom: 20px;
    }

    .registration-form input {
        width: 80%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .registration-form button {
        padding: 10px 20px;
        background-color: #5b86e5;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .registration-form button:hover {
        background-color: #4a74c2;
    }
</style>
