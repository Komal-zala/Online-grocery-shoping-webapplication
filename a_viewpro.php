<?php
include_once("a_header.php");

$con = mysqli_connect("localhost","root","","client");
if (!$con) die("DB Failed: " . mysqli_connect_error());

// ✅ Fetch all products
$res = mysqli_query($con, "SELECT * FROM products ORDER BY id DESC");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>All Products</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 90%; margin: 20px auto; }
        th, td { border: 1px solid #999; padding: 8px; text-align: center; }
        th { background: #f4f4f4; }
        img { max-width: 80px; }
    </style>
</head>
<body>

<h2 style="text-align:center;">All Products</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        
        <th>Image</th>
        <th>Created</th>
    </tr>
    <?php while ($r = mysqli_fetch_assoc($res)): ?>
    <tr>
        <td><?= $r['id'] ?></td>
        <td><?= htmlspecialchars($r['name']) ?></td>
      
        <td>
            <?php if (!empty($r['image'])): ?>
                <img src="<?= htmlspecialchars($r['image']) ?>" alt="">
            <?php endif; ?>
        </td>
        <td><?= $r['created_at'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
<?php mysqli_close($con); ?>
