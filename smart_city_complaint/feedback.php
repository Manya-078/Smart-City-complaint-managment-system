<?php
include 'config.php';
session_start();

if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}

if(isset($_POST['submit'])){
    $complaint_id = $_POST['complaint_id'];
    $feedback = $_POST['feedback'];

    if(!empty($complaint_id) && !empty($feedback)){
        // Prevent SQL injection by using prepared statements
        $stmt = $conn->prepare("UPDATE complaints SET feedback=? WHERE id=?");
        $stmt->bind_param("si", $feedback, $complaint_id);
        
        if($stmt->execute()){
            echo "<script>alert('Feedback submitted!'); window.location='user_dashboard.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please enter feedback.');</script>";
    }
}

// Check if complaint_id is passed via GET
if(isset($_GET['id'])){
    $complaint_id = $_GET['id'];
} else {
    echo "<script>alert('Invalid Complaint ID.'); window.location='user_dashboard.php';</script>";
    exit();
}
?>

<form method="post" class="feedback-form">
    <h2>Give Feedback</h2>
    <input type="hidden" name="complaint_id" value="<?php echo $complaint_id; ?>">
    <textarea name="feedback" placeholder="Enter your feedback" required></textarea><br>
    <button type="submit" name="submit">Submit Feedback</button>
</form>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .feedback-form {
        width: 50%;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .feedback-form h2 {
        color: #333;
        margin-bottom: 20px;
    }

    .feedback-form textarea {
        width: 90%;
        height: 150px;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: none;
        font-size: 16px;
    }

    .feedback-form button {
        padding: 10px 20px;
        background-color: #5b86e5;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .feedback-form button:hover {
        background-color: #4a74c2;
    }
</style>
