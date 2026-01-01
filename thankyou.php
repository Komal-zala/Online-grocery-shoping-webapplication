<?php
include_once("header.php");

?>
<!DOCTYPE html>
<html>
<head>
  <title>Thank You</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f9;
      text-align: center;
      padding: 100px;
    }
    .box {
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
      display: inline-block;
    }
    h1 {
      color: #4CAF50;
      margin-bottom: 20px;
    }
    p {
      font-size: 18px;
      margin-bottom: 30px;
    }
    .btn {
      display: inline-block;
      padding: 12px 25px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: 0.3s;
    }
    .btn:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="box">
    <h1>🎉 Thank You!</h1>
    <p>Your order has been placed successfully.</p>
    <a href="main.php" class="btn">Continue Shopping</a>
  </div>
</body>
</html>
