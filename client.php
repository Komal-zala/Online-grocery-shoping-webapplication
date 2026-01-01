<?php
session_start();
include_once("header.php");

$con = mysqli_connect("localhost", "root", "", "client");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // ✅ Admin login (no email/phone required)
    if (strtolower($name) === "admin" && $password === "admin") {
        $_SESSION['admin'] = true;
        $_SESSION['user_name'] = "Admin";
        header("Location: admin.php");
        exit();
    }

    // ✅ Validate required fields for normal user
    if (empty($email) || empty($phone)) {
       // $error = "Email and phone number are required for users!";
    } else {
        // ✅ Check if user exists
        $stmt = $con->prepare("SELECT * FROM login WHERE email=? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            // ✅ Existing user (login)
            if ($password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                header("Location: main.php");
                exit();
            } else {
                $error = "Incorrect password!";
            }
        } else {
            // ✅ New user (signup)
            $stmt2 = $con->prepare("INSERT INTO login (name, phone, email, password) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("ssss", $name, $phone, $email, $password);
            if ($stmt2->execute()) {
                $_SESSION['user_id'] = $stmt2->insert_id;
                $_SESSION['user_name'] = $name;
                header("Location: main.php");
                exit();
            } else {
                $error = "Signup failed!";
            }
            $stmt2->close();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daily Delight</title>
    <style>
        * {margin: 0; padding: 0; box-sizing: border-box;}
        html, body {
            height: 100%;
            display: flex;
            flex-direction: column;
            font-family: Arial, sans-serif;
        }

        .cover {
            background-image: url('cover1.1.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding-left: 40px;
        }
        .cover h2 {
            color: white;
            font-size: 50px;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
        }
        .cover p {
            font-size: 22px;
            margin-top: 10px;
            color: #f2f2f2;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
        }

        .login {
            background-image: url('https://i.pinimg.com/736x/93/8a/57/938a5712de02c7c21ec0dd798f6d7d71.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 500px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-right: 200px;
            margin-bottom: 100px;
        }

        .login table {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            border: 3px solid #4CAF50;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        label {
            display: block;
            margin-top: 15px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"], input[type="tel"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="submit"] {
            display: block;
            margin: 25px auto 0 auto;
            padding: 12px 30px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error { color: red; text-align: center; margin-top: 10px; }
    </style>
    <script>
    // ✅ Make email & phone required only if not admin
    function toggleRequired() {
        const name = document.querySelector('[name="name"]').value.trim().toLowerCase();
        const email = document.querySelector('[name="email"]');
        const phone = document.querySelector('[name="phone"]');

        if (name === "admin") {
            email.required = false;
            phone.required = false;
        } else {
            email.required = true;
            phone.required = true;
        }
    }
    </script>
</head>
<body>
<form method="POST" oninput="toggleRequired()">
    <table width="100%">
        <tr class="cover">
            <td>
                <h2>Welcome</h2>
                <p>Your trusted source for everyday essentials</p>
            </td>
        </tr>

        <tr class="login">
            <td>
                <div class="login-form">
                    <table>
                        <tr>
                            <td colspan="2" align="center">
                                <img src="ddlogo.png" alt="Logo" width="140">
                                <h3 style="color:#4CAF50; margin-top:10px;">Daily Delight</h3>
                                <?php if(!empty($error)) echo "<p class='error'>$error</p>"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Name</label></td>
                            <td><input type="text" name="name" required oninput="toggleRequired()"></td>
                        </tr>
                        <tr>
                            <td><label>Contact Number</label></td>
                            <td><input type="tel" maxlength="10" pattern="[6-9]\d{9}" name="phone" required></td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td><input type="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td><label>Password</label></td>
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
</footer>

</body>
</html>
