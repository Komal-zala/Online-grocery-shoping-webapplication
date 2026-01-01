<?php 
include_once("header.php");

// DB connection
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all categories
$result = mysqli_query($con, "SELECT * FROM categorie");
?>

<!DOCTYPE html>
<html>
<head>
  <title>KJ General Store</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .category-table {
      width: 80%;
      margin: 50px auto;
      border-collapse: separate;
      border-spacing: 20px;
    }

    .category-cell {
      width: 33.33%;
      text-align: center;
      vertical-align: top;
      background: #fff;
      border: 2px solid #4CAF50;
      border-radius: 15px;
      padding: 15px;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .category-cell:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .category-cell img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 10px;
    }

    .category-name {
      display: block;
      margin-top: 10px;
      font-weight: bold;
      background-color: #4CAF50;
      color: #fff;
      padding: 5px 0;
      border-radius: 5px;
    }

   
    a {
      text-decoration: none;
      color: inherit;
    }

    @media screen and (max-width: 768px) {
      .category-cell {
        width: 45%;
        margin-bottom: 20px;
      }
    }

    @media screen and (max-width: 480px) {
      .category-cell {
        width: 100%;
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>

  <table class="category-table">
    <tr>
      <?php 
      $count = 0;
      while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['id'];
          $name = $row['name'];
          $image = $row['image'] ? $row['image'] : "noimage.png";

          echo "<td class='category-cell'>
                  <a href='subcategory.php?cat_id=$id'>
                    <img src='$image' alt='$name'>
                    <span class='category-name'>$name</span>
                  </a>
                </td>";

          $count++;
          if ($count % 3 == 0) { echo "</tr><tr>"; }
      }

      // Fill empty cells if last row has <3 items
      while ($count % 3 != 0) {
          echo "<td class='category-cell'></td>";
          $count++;
      }
      ?>
    </tr>
  </table>

 <footer>
    <div class="footer-container">
        <h3>Daily Delight</h3>
        <p>&copy; 2025 Daily Delight. All rights reserved.</p>
        
        <p>
            Contact No: <a href="tel:8220459201">8220459201</a> | 
            Email: <a href="mailto:dailydelight002@gmail.com">dailydelight002@gmail.com</a>
        </p>
        
        <p>
            Shop No. 12, Shree Krishna Complex, Near Kalavad Road, Mavdi Area, <br>
            Rajkot, Gujarat - 360004, India
        </p>
    </div>
</footer>

</body>
</html>

<?php mysqli_close($con); ?>
