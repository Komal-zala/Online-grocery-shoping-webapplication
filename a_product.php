<?php
include_once("a_header.php");

// ✅ Database connection
$con = mysqli_connect("localhost","root","","client");
if(!$con) die("DB Failed: ".mysqli_connect_error());

// ✅ Get subcategory ID from URL
$subcat_id = intval($_GET['subcat_id'] ?? 0);
if($subcat_id <= 0){
    die("❌ Missing or invalid subcategory_id. Open this page like: a_product.php?subcat_id=1");
}

// ✅ Handle delete
if(isset($_GET['delete'])){
    $id = intval($_GET['delete']);
    mysqli_query($con,"DELETE FROM products WHERE id=$id AND subcategory_id=$subcat_id");
    exit;
}

// ✅ Handle add
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name  = mysqli_real_escape_string($con,$_POST['name']);
    $desc  = mysqli_real_escape_string($con,$_POST['description']);
    $image = mysqli_real_escape_string($con,$_POST['image']);
    if($image == '') $image = 'noimage.png';

    $q = "INSERT INTO products (subcategory_id,name,description,image) 
          VALUES ($subcat_id,'$name','$desc','$image')";
    if(!mysqli_query($con,$q)){
        die("Insert Error: ".mysqli_error($con));
    }
    exit;
}

// ✅ Fetch products
$products = mysqli_query($con,"SELECT * FROM products WHERE subcategory_id=$subcat_id ORDER BY id DESC");

// ✅ Fetch subcategory name
$subcat_res = mysqli_query($con,"SELECT name FROM subcategories WHERE id=$subcat_id");
$subcat_row = mysqli_fetch_assoc($subcat_res);
$subcat_name = $subcat_row['name'] ?? 'Unknown Subcategory';
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Products - <?= htmlspecialchars($subcat_name) ?></title>
<style>
    body { font-family: Arial, sans-serif; background:#f4f6f8; margin:0; padding:20px; }
    h2 { margin-bottom:20px; text-align:center; color:#2c3e50; }

    /* Form card */
    form {
        max-width:700px; margin:0 auto 30px auto;
        background:#fff; padding:20px;
        border-radius:10px;
        box-shadow:0 2px 6px rgba(0,0,0,0.15);
        position: relative;
    }
    input, textarea {
        margin:8px 0; padding:10px; width:100%;
        border:1px solid #ccc; border-radius:6px;
        font-size:14px;
    }
    textarea { min-height:70px; resize:vertical; }
    button {
        background:#27ae60; color:white;
        border:none; padding:10px 20px;
        border-radius:6px; cursor:pointer;
        font-size:15px;
    }
    button:hover { background:#219150; }

    /* Button styling */
    .btn {
        text-decoration:none; padding:8px 14px;
        border-radius:6px; font-size:14px;
        margin:4px; display:inline-block;
    }
    .back {
        background: #7f8c8d;
        color: white;
        font-weight: bold;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        transition: background 0.3s ease, transform 0.2s ease;
        font-size: 15px;
        border: none;
        cursor: pointer;
    }
    .back:hover {
        background: #636e72;
        transform: translateY(-2px);
        box-shadow: 0px 2px 6px rgba(0,0,0,0.2);
    }
    .main { background:#3498db; color:white; }
    .delete { background:#e74c3c; color:white; }
    .btn:hover { opacity:0.9; }

    /* Table styling */
    table {
        width:95%; margin:0 auto;
        border-collapse:collapse; background:#fff;
        box-shadow:0 2px 6px rgba(0,0,0,0.15);
        border-radius:10px; overflow:hidden;
    }
    th, td { padding:12px; border-bottom:1px solid #ddd; text-align:center; }
    th { background:#2c3e50; color:#fff; }
    tr:nth-child(even) { background:#f9f9f9; }
    tr:hover { background:#ecf0f1; }
    img { max-width:70px; height:auto; border-radius:6px; }

    /* Empty state */
    .empty {
        color:red; font-weight:bold; text-align:center; padding:20px;
    }

    /* Back button container */
    .back-container {
        text-align: left;
        margin-bottom: 15px;
    }
</style>
</head>
<body>

<h2>📦 Manage Products for <u><?= htmlspecialchars($subcat_name) ?></u></h2>

<div class="back-container">
    <a href="a_subcategories.php" class="btn back">⬅ Back to Subcategories</a>
</div>

<form method="POST">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="url" name="image" placeholder="Image URL (optional)">
    <textarea name="description" placeholder="Description"></textarea>
    <button type="submit">➕ Add Product</button>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Image</th>
    <th>Description</th>
    <th>Actions</th>
</tr>
<?php if(mysqli_num_rows($products) > 0){ ?>
    <?php while($row=mysqli_fetch_assoc($products)){ ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><img src="<?= htmlspecialchars($row['image']) ?>" alt=""></td>
        <td><?= htmlspecialchars($row['description']) ?></td>
        <td>
            <a href="a_product_types.php?product_id=<?= $row['id'] ?>" class="btn main">➡ Main Products</a>
            <a href="?subcat_id=<?= $subcat_id ?>&delete=<?= $row['id'] ?>" onclick="return confirm('Delete this product?');" class="btn delete">🗑 Delete</a>
        </td>
    </tr>
    <?php } ?>
<?php } else { ?>
    <tr><td colspan="5" class="empty">❌ No products found in this subcategory.</td></tr>
<?php } ?>
</table>

</body>
</html>

<?php mysqli_close($con); ?>
