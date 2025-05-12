<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

$user = $_SESSION['user']; // Get the logged-in username

// Fetch the user ID from the database
$sql_user = "SELECT id FROM users WHERE username='$user'";
$result_user = $conn->query($sql_user);
$user_data = $result_user->fetch_assoc();
$user_id = $user_data['id'];

// Fetch complaints for this user
$sql_complaints = "SELECT * FROM complaints WHERE user_id='$user_id'";
$result_complaints = $conn->query($sql_complaints);

// Delete complaint functionality
/*if (isset($_GET['delete'])) {
    $complaint_id = $_GET['delete'];
    $sql_delete = "DELETE FROM complaints WHERE id='$complaint_id' AND user_id='$user_id'";
    if ($conn->query($sql_delete)) {
        echo "<script>alert('Complaint deleted successfully!');</script>";
        header("Location: user_dashboard.php");
    } else {
        echo "<script>alert('Error deleting complaint.');</script>";
    }
}*/
?>

<link rel="stylesheet" href="css/style.css">

<div class="dashboard-container">
    <h2>Welcome, <?php echo $user; ?>!</h2>

    <h3>Your Complaints:</h3>
    <table class="complaints-table">
        <thead>
            <tr>
                <th>Complaint ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Feedback</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result_complaints->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['feedback']; ?></td>
                    <td>
                        <a href="feedback.php?id=<?php echo $row['id']; ?>" class="action-link">Give Feedback</a> | 
                        
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <p><a href="complaint_register.php" class="new-complaint-link">Register a new complaint</a></p>
    <a href="index.php" class="logout">Logout</a>
</div>

<style>
    .dashboard-container {
        text-align: center;
        margin-top: 20px;
    }

    h2, h3 {
        color: #333;
    }

    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #f8f8f8;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #5b86e5;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f1f1f1;
    }

    tr:hover {
        background-color: #e1e1e1;
    }

    .action-link {
        color: #5b86e5;
        text-decoration: none;
    }

    .action-link:hover {
        text-decoration: underline;
    }

    .delete-link {
        color: red;
    }

    .delete-link:hover {
        text-decoration: underline;
    }

    .new-complaint-link {
        color: #5b86e5;
        text-decoration: none;
        font-weight: bold;
    }

    .new-complaint-link:hover {
        text-decoration: underline;
    }
</style>
