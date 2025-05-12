<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user'])){
    header("Location: index.php");
}

$user = $_SESSION['user'];
$sql = "SELECT id FROM users WHERE username='$user'";
$res = $conn->query($sql);
$row = $res->fetch_assoc();
$user_id = $row['id'];

$sql2 = "SELECT * FROM complaints WHERE user_id='$user_id'";
$result = $conn->query($sql2);

while($row = $result->fetch_assoc()){
    echo "<p>ID: ".$row['id']." | Complaint: ".$row['complaint_text']." | Status: ".$row['status']." | Feedback: ".$row['feedback']."</p>";
}
?>
<a href="user_dashboard.php">Back</a>
