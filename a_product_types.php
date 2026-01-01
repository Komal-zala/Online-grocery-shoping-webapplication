<?php
include_once("a_header.php");
$con = mysqli_connect("localhost","root","","client");
if(!$con) die("DB Failed: ".mysqli_connect_error());

$product_id = intval($_GET['product_id'] ?? 0);
if ($product_id <= 0) die("Missing product_id.");

// Add type
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add_type'])){
    $name = trim($_POST['name']);
    $desc = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $stock = $_POST['stock'] ?? 'Yes';
    $image = 'noimage.png';

    // 1️⃣ Check file upload first
    if(isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0){
        $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $image = uniqid('type_').".".$ext;
        move_uploaded_file($_FILES['image_file']['tmp_name'], "uploads/".$image);
    }
    // 2️⃣ If no file, check URL
    elseif(!empty($_POST['image_url'])){
        $image = trim($_POST['image_url']);
    }

    $stmt = mysqli_prepare($con, "INSERT INTO product_types (product_id,name,description,price,stock,image) VALUES (?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt, 'issdss', $product_id, $name, $desc, $price, $stock, $image);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: a_product_types.php?product_id=$product_id");
    exit;
}

// Delete
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);

    // Delete local file if exists and not a URL
    $img_res = mysqli_query($con, "SELECT image FROM product_types WHERE id=$id");
    $img_row = mysqli_fetch_assoc($img_res);
    if($img_row && !filter_var($img_row['image'], FILTER_VALIDATE_URL) && file_exists("uploads/".$img_row['image'])){
        unlink("uploads/".$img_row['image']);
    }

    mysqli_query($con, "DELETE FROM product_types WHERE id=$id");
    header("Location: a_product_types.php?product_id=$product_id");
    exit;
}

$res = mysqli_query($con, "SELECT * FROM product_types WHERE product_id=$product_id ORDER BY id DESC");
$product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM products WHERE id=$product_id"));
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin - Product Types</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 20px; }
h2 { text-align: center; margin-bottom: 20px; color: #2c3e50; }
form { max-width: 600px; margin: 0 auto 30px auto; padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
form input, form select, form textarea { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 8px; }
form button { background: #27ae60; color: #fff; border: none; padding: 12px 18px; border-radius: 8px; cursor: pointer; font-size: 15px; }
form button:hover { background: #219150; }
.btn-back { background: #7f8c8d; color: white; padding: 12px 18px; border-radius: 8px; text-decoration: none; font-size: 15px; transition: 0.3s; }
.btn-back:hover { background: #636e72; }
table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
th { background: #27ae60; color: white; padding: 12px; text-align: left; }
td { padding: 12px; border-bottom: 1px solid #ddd; vertical-align: middle; }
td img { border-radius: 6px; max-width: 70px; }
tr:hover { background: #f9f9f9; }
.btn-edit { background: #3498db; color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-size: 14px; margin-right: 5px; }
.btn-edit:hover { background: #2c80b4; }
.btn-delete { background: #e74c3c; color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-size: 14px; }
.btn-delete:hover { background: #c0392b; }
.form-actions { display: flex; justify-content: space-between; align-items: center; margin-top: 12px; }
</style>
</head>
<body>

<h2>Types for <?= htmlspecialchars($product['name'] ?? 'Unknown') ?></h2>

<form method="post" enctype="multipart/form-data">
    <input name="name" placeholder="Name" required>
    <input name="price" placeholder="Price" type="number" step="0.01" required>
    <select name="stock"><option>Yes</option><option>No</option></select>
    
    <!-- Image input: file or URL -->
    <input type="file" name="image_file" accept="image/*">
    <input type="url" name="image_url" placeholder="https://example.com/image.jpg">

    <textarea name="description" placeholder="Description"></textarea>
    
    <div class="form-actions">
        <button name="add_type" type="submit">➕ Add Type</button>
        <a href="a_products.php?subcategory_id=<?= $product['subcategory_id'] ?? 0 ?>" class="btn-back">⬅ Back</a>
    </div>
</form>

<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Price</th>
  <th>Stock</th>
  <th>Image</th>
  <th>Description</th>
  <th>Actions</th>
</tr>
<?php while($r = mysqli_fetch_assoc($res)): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <td><?= htmlspecialchars($r['name']) ?></td>
  <td>₹ <?= number_format($r['price'],2) ?></td>
  <td><?= $r['stock'] ?></td>
  <td>
      <?php if(filter_var($r['image'], FILTER_VALIDATE_URL)): ?>
          <img src="<?= htmlspecialchars($r['image']) ?>" alt="">
      <?php else: ?>
          <img src="uploads/<?= htmlspecialchars($r['image']) ?>" alt="">
      <?php endif; ?>
  </td>
  <td><?= htmlspecialchars($r['description']) ?></td>
  <td>
      <a href="a_edit.php?id=<?= $r['id'] ?>&product_id=<?= $product_id ?>" class="btn-edit">✏ Edit</a>
      <a href="?product_id=<?= $product_id ?>&delete=<?= $r['id'] ?>" class="btn-delete" onclick="return confirm('Delete?')">🗑 Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>
<?php mysqli_close($con); ?>
