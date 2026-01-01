<?php
include_once("a_header.php");

// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "client"; // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM customer_reviews WHERE id = $delete_id");
    // refresh page after delete
    header("Location: a_reviews.php");
    exit();
}

// Fetch reviews
$sql = "SELECT * FROM customer_reviews ORDER BY submitted_at DESC"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Reviews</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .container {
      margin: 20px auto;
      padding: 20px;
      max-width: 950px;
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
      padding: 6px 12px;
      color: #fff;
      background: #e74c3c;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
    }
    .btn:hover {
      background: #c0392b;
    }
    .back-btn {
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
    .back-btn:hover {
      background: #2980b9;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>⭐ Customer Reviews</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Rating</th>
      <th>Comment</th>
      <th>Submitted At</th>
      <th>Action</th>
    </tr>
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['rating']}</td>
                    <td>{$row['comment']}</td>
                    <td>{$row['submitted_at']}</td>
                    <td>
                      <a class='btn' href='a_reviews.php?delete_id={$row['id']}' 
                         onclick=\"return confirm('Are you sure you want to delete this review?');\">Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No reviews found</td></tr>";
    }
    ?>
  </table>

  <!-- Back to Admin Page -->
  <a href="admin.php" class="back-btn">Go to Admin Page</a>
</div>

</body>
</html>

<?php $conn->close(); ?>
