<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user = $_SESSION['user'];

// Get user_id from database
$sql_user = "SELECT id FROM users WHERE username='$user'";
$result_user = $conn->query($sql_user);
$user_data = $result_user->fetch_assoc();
$user_id = $user_data['id'];

if (isset($_POST['submit_complaint'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Insert complaint into the database
    $sql = "INSERT INTO complaints (user_id, title, description) VALUES ('$user_id', '$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Complaint registered successfully!');</script>";
        header("Location: user_dashboard.php");
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<form method="post" class="complaint-form">
    <h2>Register a Complaint</h2>
    <input type="text" name="title" placeholder="Complaint Title" required><br>
    <textarea name="description" placeholder="Complaint Description" required></textarea><br>
    <button type="submit" name="submit_complaint">Submit Complaint</button>
</form>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e0f7fa; /* Light blue background */
        margin: 0;
        padding: 0;
    }

    .complaint-form {
        width: 45%;
        margin: 80px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .complaint-form h2 {
        color: #333;
        margin-bottom: 20px;
    }

    .complaint-form input, 
    .complaint-form textarea {
        width: 85%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #b2ebf2;
        border-radius: 5px;
        font-size: 16px;
    }

    .complaint-form textarea {
        height: 120px;
        resize: none;
    }

    .complaint-form button {
        padding: 12px 30px;
        background-color: #039be5;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .complaint-form button:hover {
        background-color: #0288d1;
    }
</style>
