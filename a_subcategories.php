<?php
include_once("a_header.php");
$con = mysqli_connect("localhost","root","","client");
if(!$con) die("DB Failed: ".mysqli_connect_error());

$category_id = intval($_GET['category_id'] ?? 0);
if ($category_id <= 0) die("Missing category_id.");

// Upload directory
$upload_dir = "uploads/subcategories/";
if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

// Add subcategory
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add_subcat'])){
    $name = trim($_POST['name']);
    $image = 'noimage.png';

    // URL if provided
    if (!empty($_POST['image_url'])) {
        $image = trim($_POST['image_url']);
    }

    // File upload takes priority
    if(isset($_FILES['image_file']) && $_FILES['image_file']['error'] == UPLOAD_ERR_OK){
        $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $new_name = uniqid('subcat_') . '.' . strtolower($ext);
        $target_path = $upload_dir . $new_name;
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if(in_array(strtolower($ext), $allowed)){
            if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target_path)){
                $image = $target_path;
            }
        }
    }

    $stmt = mysqli_prepare($con, "INSERT INTO subcategories (category_id, name, image) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'iss', $category_id, $name, $image);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: a_subcategories.php?category_id=$category_id"); 
    exit;
}

// Delete subcategory
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    mysqli_query($con, "DELETE FROM subcategories WHERE id=$id");
    header("Location: a_subcategories.php?category_id=$category_id"); 
    exit;
}

// Fetch subcategories
$res = mysqli_query($con, "SELECT * FROM subcategories WHERE category_id=$category_id ORDER BY id DESC");
$cat = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM categorie WHERE id=$category_id"));
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - Subcategories</title>
  <style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: #eef2f7;
        margin: 0;
        padding: 0;
    }
    h2 {
        color: white;
        text-align: center;
        padding: 20px;
        background: #4CAF50;
        margin: 0;
    }
    form {
        width: 500px;
        background: white;
        padding: 25px;
        margin: 20px auto;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        text-align: center;
    }
    /* Make the name input bigger */
input[name="name"] {
    padding: 18px;        /* taller */
    margin: 12px 0;
    width: 95%;           /* wider */
    font-size: 18px;      /* bigger text */
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
}

/* Image URL input */
input[name="image_url"] {
    padding: 16px;
    margin: 12px 0;
    width: 95%;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
}

/* File input */
input[type="file"] {
    padding: 12px;
    margin: 12px 0;
    width: 95%;
    font-size: 16px;
    border-radius: 8px;
}

    .btn {
        padding: 12px 18px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        font-size: 16px;
        transition: 0.3s ease;
        display: inline-block;
        margin: 6px 2px;
    }
    .btn-add {
        background: #28a745;
        color: white;
        width: 95%;
        font-weight: 600;
    }
    .btn-add:hover { background: #218838; }
    .btn-delete {
        padding: 8px 14px;
        font-size: 14px;
        background: red;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-delete:hover { background: darkred; }
    .back-link {
        display: inline-block;
        margin-top: 10px;
        color: #555;
        text-decoration: none;
    }
    .back-link:hover { color: #000; }

    table {
        border-collapse: collapse;
        width: 90%;
        margin: 20px auto;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
        padding: 14px;
        text-align: center;
        border-bottom: 1px solid #eee;
        font-size: 16px;
    }
    th {
        background: #2c3e50;
        color: white;
        text-transform: uppercase;
    }
    tr:hover { background: #f5f5f5; }
    img {
        max-width: 80px;
        border-radius: 6px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }
    /* Subcategory name as button */
    .subcat-btn {
        display: inline-block;
        padding: 8px 16px;
        background: #27ae60;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        transition: 0.3s;
        font-weight: 500;
    }
    .subcat-btn:hover {
        background: #2ecc71;
        transform: translateY(-2px);
    }
  </style>
</head>
<body>

<h2>Subcategories for <?= htmlspecialchars($cat['name'] ?? 'Unknown') ?></h2>

<form method="post" enctype="multipart/form-data">
    <input name="name" placeholder="Subcategory name" required><br>
    <input name="image_url" placeholder="Image URL (optional)"><br>
    <input type="file" name="image_file" accept="image/*"><br>
    <button name="add_subcat" type="submit" class="btn btn-add">+ Add Subcategory</button><br>
    <a href="a_categories.php" class="back-link">← Back to Categories</a>
</form>

<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Image</th>
  <th>Created</th>
  <th>Actions</th>
</tr>
<?php while($r = mysqli_fetch_assoc($res)): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <td>
    <a href="a_products.php?subcategory_id=<?= $r['id'] ?>" class="subcat-btn">
      <?= htmlspecialchars($r['name']) ?>
    </a>
  </td>
  <td><img src="<?= htmlspecialchars($r['image']) ?>" alt=""></td>
  <td><?= $r['created_at'] ?></td>
  <td>
    <a href="?category_id=<?= $category_id ?>&delete=<?= $r['id'] ?>" 
       class="btn-delete"
       onclick="return confirm('Are you sure you want to delete this subcategory?')">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>
<?php mysqli_close($con); ?>
