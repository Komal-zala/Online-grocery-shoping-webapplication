<?php
include_once("a_header.php");

$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) die("DB Failed: " . mysqli_connect_error());

// Upload directory
$upload_dir = "uploads/categories/";
if (!file_exists($upload_dir)) mkdir($upload_dir, 0777, true);

// Add category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    $name = trim($_POST['name']);
    $image = 'noimage.png';

    // Use URL if provided
    if (!empty($_POST['image_url'])) {
        $image = trim($_POST['image_url']);
    }

    // Use file upload if provided
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $new_name = uniqid('cat_') . '.' . strtolower($ext);
        $target_path = $upload_dir . $new_name;
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (in_array(strtolower($ext), $allowed)) {
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $target_path)) {
                $image = $target_path;
            }
        }
    }

    $stmt = mysqli_prepare($con, "INSERT INTO categorie (name, image) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, 'ss', $name, $image);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: a_categories.php");
    exit;
}

// Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($con, "DELETE FROM categorie WHERE id=$id");
    header("Location: a_categories.php");
    exit;
}

$res = mysqli_query($con, "SELECT * FROM categorie ORDER BY id DESC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin - Categories</title>
<style>
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: #f5f6fa;
    margin: 0;
    padding: 20px;
    color: #333;
}
h2 {
    text-align: center;
    font-size: 28px;
    margin-bottom: 20px;
    color: #2c3e50;
}
form {
    max-width: 600px;
    margin: 0 auto 30px;
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
form input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    box-sizing: border-box;
}
form button {
    width: 100%;
    padding: 12px;
    background: linear-gradient(to right, #27ae60, #2ecc71);
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}
form button:hover {
    background: linear-gradient(to right, #2ecc71, #27ae60);
}
a.btn-back {
    display: inline-block;
    margin-top: 10px;
    text-decoration: none;
    color: #fff;
    background: #3498db;
    padding: 10px 20px;
    border-radius: 6px;
    transition: 0.3s;
}
a.btn-back:hover {
    background: #2980b9;
}
table {
    width: 90%;
    margin: 0 auto;
    border-collapse: collapse;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    font-size: 16px;
}
th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}
th {
    background: #27ae60;
    color: white;
    font-size: 16px;
}
td img {
    max-width: 100px;
    border-radius: 6px;
}
.category-btn {
    display: inline-block;
    padding: 8px 16px;
    background: #27ae60;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: 0.3s;
}
.category-btn:hover {
    background: #2ecc71;
    transform: translateY(-2px);
}
.btn-delete {
    padding: 8px 14px;
    font-size: 14px;
    background: #e74c3c;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.2s;
}
.btn-delete:hover {
    background: #c0392b;
}
</style>
</head>
<body>

<h2>Categories</h2>

<form method="post" enctype="multipart/form-data">
    <input name="name" placeholder="Category name" required>
    <input name="image_url" placeholder="Image URL (optional)">
    <input type="file" name="image_file" accept="image/*">
    <button name="add_category" type="submit">Add Category</button>
    <a href="admin.php" class="btn-back">⬅ Back</a>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Image</th>
    <th>Actions</th>
</tr>
<?php while ($r = mysqli_fetch_assoc($res)): ?>
<tr>
    <td><?= $r['id'] ?></td>
    <td>
        <a class="category-btn" href="a_subcategories.php?category_id=<?= $r['id'] ?>">
            <?= htmlspecialchars($r['name']) ?>
        </a>
    </td>
    <td>
        <?php if (!empty($r['image'])): ?>
            <img src="<?= htmlspecialchars($r['image']) ?>" alt="Category Image">
        <?php else: ?>
            <img src="noimage.png" alt="No Image">
        <?php endif; ?>
    </td>
    <td>
        <a href="?delete=<?= $r['id'] ?>" class="btn-delete" onclick="return confirm('Delete this category?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>
<?php mysqli_close($con); ?>
