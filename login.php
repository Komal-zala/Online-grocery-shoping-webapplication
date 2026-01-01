<?php
session_start();
include_once("header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = mysqli_connect("localhost", "root", "", "client");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // ✅ Admin login
    if ($name === "admin" && $password === "admin") {
        $_SESSION['admin'] = true;
        $_SESSION['user_name'] = "Admin";
        header("Location: admin.php");
        exit();
    }

    // ✅ Check if user exists
    $stmt = $con->prepare("SELECT * FROM login WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // ✅ User exists → check password (if you used password_hash)
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: main.php");
            exit();
        } else {
            echo "<script>alert('Wrong password!');</script>";
        }
    } else {
        // ✅ New user → insert
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $stmt2 = $con->prepare("INSERT INTO login (name, phone, email, password) VALUES (?, ?, ?, ?)");
        $stmt2->bind_param("ssss", $name, $phone, $email, $hashed_pass);
        if ($stmt2->execute()) {
            $_SESSION['user_id'] = $stmt2->insert_id;
            $_SESSION['user_name'] = $name;
            header("Location: main.php");
            exit();
        } else {
            echo "Error: " . $stmt2->error;
        }
        $stmt2->close();
    }

    $stmt->close();
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daily Delight</title>
    <style>
        * {margin: 0; padding: 0; box-sizing: border-box;}
        html, body {height: 100%; display: flex; flex-direction: column;}
        label {display: block; margin-top: 15px; color: #555;}
        input[type="text"], input[type="tel"], input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 6px;
        }
        input[type="submit"] {
            width: 100%; margin-top: 20px; padding: 10px; background-color: #4CAF50;
            color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px;
        }
        table {margin: auto; margin-bottom: 150px; background-color: #f2f2f2;}
        .login table {border: 3px solid #4CAF50;}
        .login {
            background-image: url('https://i.pinimg.com/1200x/04/f4/bc/04f4bc0d054cbac81e4e88aa66a49809.jpg');
            background-repeat: no-repeat;
            align-items: center;
            height: 500px;
            background-size: cover;
            background-position: center;
            justify-content: flex-end;
            padding-right: 500px;
            display: flex;
            padding-top: 150px;
        }
        footer {background: #333; color: white; padding: 15px; text-align: center; margin-top: auto;}
    </style>
</head>
<body>
<form method="POST" action="">
    <table width="100%">
        <tr class="login">
            <td>
                <div class="login-form">
                    <table>
                        <tr><td colspan="2" align="center"><img src="ddlogo.png" alt="Logo" width="80"></td></tr>
                        <tr>
                            <td><label><b>Name</b></label></td>
                            <td><input type="text" name="name" required></td>
                        </tr>
                        <tr>
                            <td><label><b>Contact Number</b></label></td>
                            <td><input type="tel" maxlength="10" pattern="[6-9]\d{9}" name="phone"></td>
                        </tr>
                        <tr>
                            <td><label><b>Email</b></label></td>
                            <td><input type="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td><label><b>Password</b></label></td>
                            <td><input type="password" name="password" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" value="Continue">
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
</form>

<footer>
    &copy; 2025 KJ General Store. All rights reserved.<br>
    Contact NO: 8220459201<br>
    Email: kjgeneral002@gmail.com<br>
    KJ General Store<br>
    Shop No. 12, Shree Krishna Complex<br>
    Near Kalavad Road, Mavdi Area<br>
    Rajkot, Gujarat - 360004<br>
    India
</footer>
</body>
</html>
