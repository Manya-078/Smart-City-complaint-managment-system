<?php
session_start();
include 'config.php';

if(isset($_POST['login'])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$uname' AND password='$pass'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $_SESSION['admin'] = $uname;
        header("Location: admin_dashboard.php");
    } else {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>

<form method="post">
    <h2>Admin Login</h2>
    <input type="text" name="username" placeholder="Admin Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="login">Login</button>
</form>
