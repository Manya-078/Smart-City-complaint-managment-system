<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

// Fetch complaints
$sql = "SELECT c.id, u.username, c.title, c.description, c.status FROM complaints c JOIN users u ON c.user_id = u.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #fce4ec; /* light baby pink */
        }

        .header-container {
            background-color: #ec407a;
            color: white;
            padding: 20px 0;
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
        }

        .dashboard {
            width: 90%;
            max-width: 1000px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #e0e0e0;
            padding: 12px;
        }

        table th {
            background-color: #f8bbd0;
            color: #333;
        }

        table td {
            background-color: #fce4ec;
        }

        table select, table button {
            padding: 6px 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-left: 5px;
            font-size: 14px;
        }

        table button {
            cursor: pointer;
            background: #ec407a;
            color: white;
            border: none;
            transition: background 0.3s;
        }

        table button:hover {
            background: #d81b60;
        }

        .logout {
            display: block;
            text-align: center;
            margin: 30px auto;
            text-decoration: none;
            color: white;
            background: #ec407a;
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 16px;
            width: 120px;
        }

        .logout:hover {
            background: #d81b60;
        }

        .no-complaints {
            text-align: center;
            font-size: 18px;
            color: #555;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="header-container">
    Smart City Complaint Management - Admin Dashboard
</div>

<div class="dashboard">
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>User</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
              </tr>";

        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>
                    <form method='post' action='update_status.php' style='display:inline-block;'>
                        <input type='hidden' name='complaint_id' value='" . $row['id'] . "'>
                        <select name='status'>
                            <option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
                            <option value='In Progress'" . ($row['status'] == 'In Progress' ? ' selected' : '') . ">In Progress</option>
                            <option value='Resolved'" . ($row['status'] == 'Resolved' ? ' selected' : '') . ">Resolved</option>
                        </select>
                        <button type='submit' name='update'>Update</button>
                    </form>
                    
                    <form method='post' action='delete_complaint.php' style='display:inline-block; margin-left:5px;'>
                        <input type='hidden' name='complaint_id' value='" . $row['id'] . "'>
                        <button type='submit' name='delete' style='background:#ef5350;'>Delete</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='no-complaints'>No complaints found.</p>";
    }
    ?>
</div>

<a href="index.php" class="logout">Logout</a>

</body>
</html>
