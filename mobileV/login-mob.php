<?php

@include '../inc/config.php';

session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = md5($_POST['password']);
    $select = "SELECT uf.*, m.status as manager_status 
               FROM user_form uf
               LEFT JOIN manager m ON uf.email = m.email 
               WHERE uf.email = '$email' AND uf.password = '$pass'";
    $result = mysqli_query($con, $select);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);

        if ($row['user_type'] == 'admin') {

            $_SESSION['user_name'] = $row['email'];
            $_SESSION['admin_name'] = $row['name'];
            $insertQuery = "INSERT INTO loggedin (empemail, loggedtime,device) VALUES ('$email', NOW(), 'mobileapp')";
            mysqli_query($con, $insertQuery);
            header('location:index.php');
            exit;

        }elseif ($row['manager_status'] == 1) {
          $_SESSION['user_name'] = $row['email'];
          $_SESSION['admin_name'] = $row['name'];
          $insertQuery = "INSERT INTO loggedin (empemail, loggedtime,device) VALUES ('$email', NOW(), 'mobileapp')";
          mysqli_query($con, $insertQuery);
          header('location:index_mgr.php');
          exit;

      } elseif ($row['user_type'] == 'user') {

            $_SESSION['user_name'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $insertQuery = "INSERT INTO loggedin (empemail, loggedtime,device) VALUES ('$email', NOW(), 'mobileapp')";
            mysqli_query($con, $insertQuery);
            header('location:emp-dashboard-mob.php');
            exit;
        }  else {
            header('location:emp-dashboard-mob.php');
            exit;
        }
    } else {
        echo '<script>alert("Incorrect Email or Password!");</script>';
        echo "<script>window.location.href = 'https://hrms.anikasterilis.com/loginpage.php';</script>";
    }
    $select_email = "SELECT * FROM user_form WHERE email = '$email'";
    $result_email = mysqli_query($con, $select_email);

    if (mysqli_num_rows($result_email) === 0) {
        echo '<script>alert("Email does not exist!");</script>';
        echo "<script>window.location.href = 'https://hrms.anikasterilis.com/loginpage.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./empmobcss/globalop.css" />
    <link rel="stylesheet" href="./empmobcss/login-mob.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap"
    />
  </head>
  <body>
    <div class="loginmob"style="height: 100svh;">
      <div class="frame-div">
        <img class="logo-1-icon3" alt="" style="filter:contrast(200%);" src="./public/logo-1@2x3.png" />

        <h1 class="anika-hrm3">
          <span>Anika</span>
          <span class="span3"> </span>
          <span class="hrm3">HRM</span>
        </h1>
        <div class="frame-child5"></div>
        <img class="pngfind-1-icon3" alt="" src="./public/pngfind-1@2x.png" />

        <img class="image-1-icon1" alt="" src="./public/image-1@2x.png" />

        <div class="login-to-your">Login to your account</div>
        <div class="email-id1">Email ID:</div>
        <div class="password1">Password:</div>
        <form action="" method="POST">
        <?php
            if (isset($error)) {
              foreach ($error as $error) {
                echo '<span style="color:white;">' . $error . '</span>';
              };
            };
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email'])) {
              $prefilledEmail = $_GET['email'];
              echo "<input class='frame-child6' style='font-size: 30px;' id='email' value='$prefilledEmail' name='email' type='email' readonly required />";
            } else {
              echo "<input class='frame-child6' style='font-size: 30px;' id='email' name='email' type='email' required />";
            }
          ?>
        <input style='color: white;' class='frame-child7' name="password" type="password" required>
        <button type="submit" name="submit" class="frame-child8"><span style="color:white; font-size:15px; margin-left:10px">Login</span></button>
</form>
        <img
          class="tablerlogout-icon1"
          alt=""
          src="./public/tablerlogout.svg"
        />
      </div>
    </div>
  </body>
</html>
