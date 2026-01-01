<?php
include_once("a_header.php");

// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "client"; // database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users
$sql = "SELECT * FROM login ORDER BY id DESC"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Users</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .container {
      margin: 20px;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #2c3e50;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    table th, table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }
    table th {
      background: #2c3e50;
      color: #fff;
    }
    table tr:nth-child(even) {
      background: #f9f9f9;
    }
    .btn {
      display: block;
      width: 200px;
      margin: 20px auto;
      padding: 10px;
      background: #3498db;
      color: #fff;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
      transition: background 0.3s;
    }
    .btn:hover {
      background: #2980b9;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>👥 All Registered Customer</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Email</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['email']}</td>
                   
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No users found</td></tr>";
    }
    ?>
  </table>

  <!-- Single button below table -->
  <a href="admin.php" class="btn">Go to Admin Page</a>
</div>

</body>
</html>

<?php $conn->close(); ?>
