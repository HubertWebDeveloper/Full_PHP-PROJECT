<?php include_once '../includes/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Don't Miss</title>
   <link href="../images/myLogo.png" rel="icon">
   <link href="../images/myLogo.png" rel="apple-touch-icon">
   <link rel="stylesheet" href="../css/login.css">
</head>
<body style="background: url(../images/image.jpg);background-size: cover;">
   <?php

   $msg = "";

   if(isset($_POST['btn'])){
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $pass = mysqli_real_escape_string($con, $_POST['password']);

      $sel = mysqli_query($con, "SELECT * FROM user WHERE email='{$email}' AND password='{$pass}'");

      if (mysqli_num_rows($sel) == 1) {
         $row = mysqli_fetch_assoc($sel);
         if ($row['type']=="admin") {
               $_SESSION['email'] = $email;
               $_SESSION['type'] = 'admin';
               echo "<script>window.open('home.php','_self')</script>";
         }else{
               // $_SESSION['email'] = $email;
               // $_SESSION['type'] = 'staff';
               // echo "<script>window.open('home.php','_self')</script>";
               echo "<script>window.open('index.php','_self')</script>";
         }
              
      }else{
         $msg = "<label style='font-size:14px;background:red;color:white;box-shadow: 0px 0px 10px 10px rgba(0, 0, 0, 0.5);padding:10px 10px;border-radius:10px'>Password OR Email does not match.</label>";
      }
   }
   ?>
   <div class="login-box">
      <img src="../images/myLogo.png" class="avatar">
      <?php echo $msg; ?>
      <h1>WELCOME BACK LOGIN</h1>
      <form action="" method="POST">
      <p>Email</p>
      <input type="email" name="email" placeholder="Enter email">
      <p>Password</p>
      <input type="password" name="password" placeholder="Enter Password">
      <button type="submit" name="btn">Login</button>
      </form>
   </div>
</body>
</html>