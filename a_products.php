<?php
$con = mysqli_connect("localhost","root","","client");
if(!$con) die("DB Failed: ".mysqli_connect_error());

// Get subcategory_id
$subcategory_id = intval($_GET['subcategory_id'] ?? 0);
if ($subcategory_id <= 0) {
    $first_sub = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM subcategories ORDER BY id ASC LIMIT 1"));
    if ($first_sub) $subcategory_id = $first_sub['id'];
    else die("No subcategories found.");
}

// Add product
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add_product'])){
    $name = trim($_POST['name']);
    $image = 'noimage.png';

    // File upload takes priority
    if(isset($_FILES['image_file']) && $_FILES['image_file']['error'] == 0){
        $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $image = uniqid('prod_').".".$ext;
        move_uploaded_file($_FILES['image_file']['tmp_name'], "uploads/".$image);
    } elseif(!empty($_POST['image_url'])){ // If no file, use URL
        $image = trim($_POST['image_url']);
    }

    $stmt = mysqli_prepare($con, "INSERT INTO products (subcategory_id, name, image) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'iss', $subcategory_id, $name, $image);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: a_products.php?subcategory_id=$subcategory_id");
    exit;
}

// Delete product
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    $img_res = mysqli_query($con, "SELECT image FROM products WHERE id=$id");
    $img_row = mysqli_fetch_assoc($img_res);

    // Delete local file if not a URL
    if($img_row && !filter_var($img_row['image'], FILTER_VALIDATE_URL) && file_exists("uploads/".$img_row['image'])){
        unlink("uploads/".$img_row['image']);
    }

    mysqli_query($con, "DELETE FROM products WHERE id=$id");
    header("Location: a_products.php?subcategory_id=$subcategory_id");
    exit;
}

include_once("a_header.php");

// Fetch products
$res = mysqli_query($con, "SELECT * FROM products WHERE subcategory_id=$subcategory_id ORDER BY id DESC");
$subcat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM subcategories WHERE id=$subcategory_id"));
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin - Products</title>
<style>
body { font-family: 'Segoe UI', Arial, sans-serif; background: #f5f6fa; margin: 0; padding: 20px; }
h2 { text-align: center; color: #333; margin-bottom: 20px; }
form { background: #fff; padding: 20px; margin: 20px auto; max-width: 400px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center; }
input, button, a { margin: 8px 0; padding: 10px; font-size: 14px; border-radius: 5px; border: 1px solid #ccc; }
input { width: 90%; }
button { background: #27ae60; color: white; border: none; cursor: pointer; font-size: 14px; display: inline-block; padding: 6px 14px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
button:hover { background: #219150; }
.back-link { text-decoration: none; color: #333; font-size: 14px; margin-left: 10px; }
table { width: 95%; margin: 20px auto 80px auto; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: center; }
th { background: #27ae60; color: white; }
tr:hover { background: #f9f9f9; }
img { max-width: 70px; border-radius: 5px; }
.btn { padding: 6px 14px; border-radius: 6px; text-decoration: none; font-size: 14px; display: inline-block; margin: 2px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
.btn-edit { background: #3498db; color: white; }
.btn-edit:hover { background: #2980b9; }
.btn-delete { background: #e74c3c; color: white; }
.btn-delete:hover { background: #c0392b; }
</style>
</head>
<body>

<h2>Products in <?= htmlspecialchars($subcat['name'] ?? 'Unknown') ?></h2>

<form method="post" enctype="multipart/form-data">
    <input name="name" placeholder="Product name" required><br>
    <input type="file" name="image_file" accept="image/*"><br>
    <input type="url" name="image_url" placeholder="https://example.com/image.jpg"><br>
    <button name="add_product" type="submit">Add Product</button>
    <a href="a_subcategories.php?category_id=<?= $subcat['category_id'] ?? 0 ?>" class="back-link">← Back</a>
</form>

<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Image</th>
  <th>Actions</th>
</tr>
<?php while($r = mysqli_fetch_assoc($res)): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <!-- Name styled as a button -->
  <td>
    <a href="a_product_types.php?product_id=<?= $r['id'] ?>" class="btn btn-edit">
      <?= htmlspecialchars($r['name']) ?>
    </a>
  </td>
  <td>
    <?php if(filter_var($r['image'], FILTER_VALIDATE_URL)): ?>
        <img src="<?= htmlspecialchars($r['image']) ?>" alt="">
    <?php else: ?>
        <img src="uploads/<?= htmlspecialchars($r['image']) ?>" alt="">
    <?php endif; ?>
  </td>
  <td>
    <a href="a_edit_product.php?id=<?= $r['id'] ?>" class="btn btn-edit">Edit</a>
    <a href="?subcategory_id=<?= $subcategory_id ?>&delete=<?= $r['id'] ?>" 
       class="btn btn-delete" 
       onclick="return confirm('Are you sure?')">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>
<?php mysqli_close($con); ?>
