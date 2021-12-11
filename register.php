<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST["username"]))) {
    $username_err = "Username cannot be blank";
  } else {
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Set the value of param username
      $param_username = trim($_POST['username']);

      // Try to execute this statement
      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
          $username_err = "This username is already taken";
        } else {
          $username = trim($_POST['username']);
        }
      } else {
        echo "Something went wrong";
      }
    }
  }

  mysqli_stmt_close($stmt);


  // Check for password
  if (empty(trim($_POST['password']))) {
    $password_err = "Password cannot be blank";
  } elseif (strlen(trim($_POST['password'])) < 5) {
    $password_err = "Password cannot be less than 5 characters";
  } else {
    $password = trim($_POST['password']);
  }

  // Check for confirm password field
  if (trim($_POST['password']) !=  trim($_POST['confirm_password'])) {
    $password_err = "Passwords should match";
  }


  // If there were no errors, go ahead and insert into the database
  if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

      // Set these parameters
      $param_username = $username;
      $param_password = password_hash($password, PASSWORD_DEFAULT);

      // Try to execute the query
      if (mysqli_stmt_execute($stmt)) {
        header("location: login.php");
      } else {
        echo "Something went wrong... cannot redirect!";
      }
    }
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}

?>


<!-- html code -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Food Court | Sign Up</title>
    <!-- Bootstraps 5 +-->
    <?php include 'bootstraps/bootstraps.php' ?>
    <!-- CSS link +-->
    <link rel="stylesheet" type="text/css" href="css\\style.css">
    <!-- icon -->
    <?php include 'icons/icons.php' ?>
    <!-- Google font +-->
    <?php include 'font/font.php' ?>
    <!-- favicon -->
    <?php include "favicon.php" ?>
</head>

<body style="font-family: 'Merienda', cursive;">

    <!-- logo -->
    <div class="text-center text-light p-4 mx-auto" style="background-color: #2E4C6D;">
        <h1 class="" style="text-decoration: none; color: white;">FoodCourt</h1>
    </div>
    <!-- login -->
    <div class="text-center pt-5">
        <h3>Sign Up</h3>
        <hr>

        <form action="" method="post" class="container pt-5 mt-5">
            <!-- username -->
            <div class="input-group mb-3 mx-auto" style="width: 50%;">
                <span class="input-group-text"><i class="far fa-user-circle" style="font-size: 20px;"></i></span>
                <input type="text" class="form-control" placeholder="Username" name="username">
            </div>
            <!-- password -->
            <div class="input-group mb-3 mx-auto" style="width: 50%;">
                <span class="input-group-text"><i class="fas fa-key" style="font-size: 20px;"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <!-- confirm password -->
            <div class="input-group mb-3 mx-auto" style="width: 50%;">
                <span class="input-group-text"><i class="fas fa-unlock-alt" style="font-size: 20px;"></i></span>
                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
            </div>
            <!-- sign in -->
            <button type="submit" class="btn btn-primary">Sign Up</button><br>
            <div class="p-3">Already have an account? <span><a href="login.php">sign in</a></span></div>

        </form>

    </div>
</body>

</html>