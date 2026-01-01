<?php
include_once("a_header.php");

// DB connection
$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subcategory_id = $_POST['subcategory_id'];
    $name  = $_POST['name'];
    $desc  = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock']; // Yes/No
    $image = "";

    // If file uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = "uploads/" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } elseif (!empty($_POST['image_url'])) {
        $image = $_POST['image_url']; // URL directly
    }

    // Insert query
    $sql = "INSERT INTO products (subcategory_id, name, description, price, stock, image) 
            VALUES ('$subcategory_id', '$name', '$desc', '$price', '$stock', '$image')";
    mysqli_query($con, $sql);

    header("Location: a_products.php?msg=added");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; }
    .container { margin-left:220px; padding:20px; }
    form { background:#fff; padding:20px; border-radius:8px; width:500px; margin:auto; }
    label { display:block; margin-top:10px; font-weight:bold; }
    input, textarea, select { width:100%; padding:8px; margin-top:5px; border:1px solid #ccc; border-radius:5px; }
    button { margin-top:15px; padding:10px; background:#1abc9c; color:white; border:none; border-radius:5px; cursor:pointer; }
    button:hover { background:#16a085; }
  </style>
</head>
<body>
  <div class="container">
    <h2>➕ Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
      
      <!-- Select Subcategory -->
      <label>Subcategory:</label>
      <select name="subcategory_id" required>
        <?php
        $res = mysqli_query($con, "SELECT id, name FROM subcategories");
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
        ?>
      </select>

      <label>Name:</label>
      <input type="text" name="name" required>

      <label>Description:</label>
      <textarea name="description"></textarea>

      <label>Price (₹):</label>
      <input type="number" step="0.01" name="price" required>

      <label>Stock:</label>
      <select name="stock">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>

      <label>Upload Image:</label>
      <input type="file" name="image">

      <label>OR Image URL:</label>
      <input type="url" name="image_url">

      <button type="submit">Add Product</button>
    </form>
  </div>
</body>
</html>

<?php mysqli_close($con); ?>
