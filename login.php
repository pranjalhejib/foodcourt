<?php
//This script will handle login
session_start();

// check if the user is already logged in
if (isset($_SESSION['username'])) {
    header("location: main.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['username'])) || empty(trim($_POST['password']))) {
        $err = "Please enter username + password";
    } else {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


    if (empty($err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;


        // Try to execute this statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        // this means the password is corrct. Allow user to login
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

                        //Redirect user to main page
                        header("location: main.php");
                    }
                }
            }
        }
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Food Court | Log In</title>
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
        <h3>Login</h3>
        <hr>

        <form action="" method="post" class="container pt-5 mt-5">
            <!-- username -->
            <div class="input-group mb-3 mx-auto" style="width: 50%;">
                <span class="input-group-text"><i class="far fa-user-circle" style="font-size: 20px;"></i></span>
                <input type="text" class="form-control" placeholder="Username" name="username" required>
            </div>
            <!-- password -->
            <div class="input-group mb-3 mx-auto" style="width: 50%;">
                <span class="input-group-text"><i class="fas fa-key" style="font-size: 20px;"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
            <!-- sign in -->
            <button type="submit" class="btn btn-primary">Sign In</button><br>
            <div class="p-3">Don't have an account? <span><a href="register.php">create account</a></span></div>

        </form>

    </div>
</body>

</html>