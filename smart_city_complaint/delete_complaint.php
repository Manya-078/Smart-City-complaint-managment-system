<?php
session_start();
include 'config.php';

if(isset($_POST['delete'])){
    $complaint_id = $_POST['complaint_id'];

    $sql = "DELETE FROM complaints WHERE id='$complaint_id'";
    if($conn->query($sql)){
        header("Location: admin_dashboard.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
