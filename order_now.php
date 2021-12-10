<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FoodCourt</title>

    <!-- Bootstraps 5 +-->
    <?php include 'bootstraps/bootstraps.php' ?>
    <!-- CSS link +-->
    <link rel="stylesheet" type="text/css" href="css\\style.css">
    <!-- icon -->
    <?php include 'icons/icons.php' ?>
    <!-- Google font +-->
    <?php include 'font/font.php' ?>
    <!-- favicon +-->
    <?php include 'favicon.php' ?>

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="50">
    <!-- navigation bar -->
<nav class="navbar navbar-expand-md bg-light navbar-light fixed-top shadow-lg m-0 p-0">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand ps-1 shadow-lg" style="background-color: #E4EFE7; font-family: 'Merienda', cursive; text-decoration: none; color: black;" href="main.php">
            <h2>F<span style="color: #4E8D7C;">oo</span>dC<span style="color: #4E8D7C;">o</span>urt</h2>
        </a>

        <!-- Toogler button & icon -->
        <button class="navbar-toggler navbar-light" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Toogler links -->
        <div class="collapse navbar-collapse justify-content-end" id="mynavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link navlink" href="#welcome"><i class="fas fa-home" style="font-size:20px;"></i> Welcome</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navlink" href="#menu"><i class="fas fa-utensils" style="font-size:20px;"></i> Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navlink" href="#contact"><i class="fas fa-address-book"></i> Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navlink" href="#location"><i class="fas fa-map-marker-alt" style="font-size: 20px;"></i> Location</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link navlink" href="#about"><i class="fas fa-info-circle"></i> About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>



</body>

</html>