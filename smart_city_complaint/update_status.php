<?php
session_start();
include 'config.php';

if(isset($_POST['update'])){
    $id = $_POST['complaint_id'];
    $status = $_POST['status'];

    $sql = "UPDATE complaints SET status='$status' WHERE id='$id'";
    if($conn->query($sql)){
        header("Location: admin_dashboard.php");
    } else {
        echo "Error updating status.";
    }
}
?>
