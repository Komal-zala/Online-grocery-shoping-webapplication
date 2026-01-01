<?php include_once("header.php"); ?>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "client"); // Change DB name

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $rating = (int)$_POST['rating'];
    $comment = $conn->real_escape_string($_POST['comment']);

    $stmt = $conn->prepare("INSERT INTO customer_reviews (name, rating, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $rating, $comment);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Customer Reviews - KJ General Store</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      color: #4CAF50;
      margin-top: 30px;
    }

    .container {
      max-width: 900px;
      margin: 30px auto;
      padding: 20px;
    }

    .review-card {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .stars {
      color: #FFD700;
    }

    form {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      margin-bottom: 30px;
      display: none;
    }

    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    button {
      padding: 10px 20px;
      margin-top: 15px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }

    .btn-container {
      text-align: center;
      margin: 20px 0;
    }
  </style>
  <script>
    function showForm() {
      document.getElementById('reviewForm').style.display = 'block';
    }
  </script>
</head>
<body>

  <h1>Customer Reviews</h1>

  <div class="container">

    <div class="btn-container">
      <button onclick="showForm()">Give Your Review</button>
    </div>

    <!-- Review Form -->
    <form id="reviewForm" method="POST" action="review.php">
      <h3>Submit Your Review</h3>
      <input type="text" name="name" placeholder="Your Name" required>
      <select name="rating" required>
        <option value="">Rating</option>
        <option value="5">★★★★★ (5)</option>
        <option value="4">★★★★☆ (4)</option>
        <option value="3">★★★☆☆ (3)</option>
        <option value="2">★★☆☆☆ (2)</option>
        <option value="1">★☆☆☆☆ (1)</option>
      </select>
      <textarea name="comment" placeholder="Your Comment" required></textarea>
      <button type="submit">Submit Review</button>
    </form>

    <!-- Show Reviews -->
    <?php
    $result = $conn->query("SELECT * FROM customer_reviews ORDER BY submitted_at DESC");
    while ($row = $result->fetch_assoc()) {
        echo '<div class="review-card">';
        echo '<strong>' . htmlspecialchars($row['name']) . '</strong><br>';
        echo '<div class="stars">' . str_repeat('★', $row['rating']) . str_repeat('☆', 5 - $row['rating']) . '</div>';
        echo '<p>' . nl2br(htmlspecialchars($row['comment'])) . '</p>';
        echo '</div>';
    }
    $conn->close();
    ?>

  </div>

</body>
</html>
