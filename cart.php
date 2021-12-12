<?php
if (session_id() == '') {
    session_start();
}

include "config.php";


if (isset($_POST["add"])) {
    if (isset($_SESSION["cart"])) {
        $item_array_id = array_column($_SESSION["cart"], "product_id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["cart"]);
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION["cart"][$count] = $item_array;
            echo '<script>window.location="Cart.php"</script>';
        } else {
            echo '<script>alert("Product is already Added to Cart")</script>';
            echo '<script>window.location="Cart.php"</script>';
        }
    } else {
        $item_array = array(
            'product_id' => $_GET["id"],
            'item_name' => $_POST["hidden_name"],
            'product_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"],
        );
        $_SESSION["cart"][0] = $item_array;
    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["cart"] as $keys => $value) {
            if ($value["product_id"] == $_GET["id"]) {
                unset($_SESSION["cart"][$keys]);
                echo '<script>alert("Product has been Removed...!")</script>';
                echo '<script>window.location="Cart.php"</script>';
            }
        }
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FoodCourt | Cart</title>

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

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web');

        * {
            font-family: 'Merienda', cursive;
            text-decoration: none;
        }

        .product {
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px -1px;
            padding: 10px;
            text-align: center;
            background-color: #efefef;
        }

        table,
        th,
        tr {
            text-align: center;
        }

        .title2 {
            text-align: center;
            color: black;
            background-color: #efefef;
            padding: 2%;
        }

        h2 {
            text-align: center;
            color: black;
            background-color: #efefef;
            padding: 2%;
        }

        table th {
            background-color: #efefef;
        }
    </style>
</head>

<body>


    <!-- navigation bar -->
    <nav class="navbar navbar-expand-md bg-light navbar-light fixed-top shadow-lg m-0 p-0">
        <div class="container">

            <!-- Logo -->
            <a class="navbar shadow-lg me-5" style="background-color: #E4EFE7; font-family: 'Merienda', cursive; text-decoration: none; color: black;" href="main.php">
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
                        <a class="nav-link navlink" href="main.php"><i class="fas fa-long-arrow-alt-left" style="font-size: 20px;"></i> Back</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlink" href="logout.php"><i class="fas fa-sign-out-alt" style="font-size: 20px;"></i> Log Out</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navlink text-dark" href="#welcome"><i class="fas fa-user-tie" style="font-size: 20px;"></i><?php echo " Hi " . ucwords($_SESSION['username']) ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar end -->


    <!-- cart -->
    <div class="container" style="width: 65%">
        <h2>Shopping Cart</h2>
        <?php
        $query = "SELECT * FROM product ORDER BY id ASC ";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_array($result)) {

        ?>
                <div class="col-md-3">

                    <form method="post" action="Cart.php?action=add&id=<?php echo $row["id"]; ?>">

                        <div class="product">
                            <img src="<?php echo $row["image"]; ?>" class="img-responsive">
                            <h5 class="text-info"><?php echo $row["pname"]; ?></h5>
                            <h5 class="text-danger"><?php echo $row["price"]; ?></h5>
                            <input type="text" name="quantity" class="form-control" value="1">
                            <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                            <input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Add to Cart">
                        </div>
                    </form>
                </div>
        <?php
            }
        }
        ?>

        <div style="clear: both"></div>
        <h3 class="title2">Shopping Cart Details</h3>
        <div class="table table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Product Name</th>
                    <th width="10%">Quantity</th>
                    <th width="13%">Price Details</th>
                    <th width="10%">Total Price</th>
                    <th width="17%">Remove Item</th>
                </tr>

                <?php
                if (!empty($_SESSION["cart"])) {

                    $total = 0;
                    foreach ($_SESSION["cart"] as $key => $value) {
                ?>
                        <tr>
                            <td><?php echo $value["item_name"]; ?></td>
                            <td><?php echo $value["item_quantity"]; ?></td>
                            <td>$ <?php echo $value["product_price"]; ?></td>
                            <td>
                                $ <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?></td>
                            <td><a href="Cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Remove Item</span></a></td>

                        </tr>
                    <?php

                        $total = $total + ($value["item_quantity"] * $value["product_price"]);
                    }
                    ?>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <th align="right">$ <?php echo number_format($total, 2); ?></th>
                        <td></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <!-- cart ends -->





        <div id="contact" class="container text-center pt-5 pb-5" style="font-family: 'Merienda', cursive; color: black; background-color: white;">

            <div class="text-dark text-center " style="background-color: white;">
                <!--  form  -->
                <form action="" method="post" class="container pt-1 mt-1">
                    <!-- fname -->
                    <div class="input-group mb-3 mx-auto" style="width: 50%;">
                        <span class="input-group-text"><i class="far fa-user" style="font-size: 20px;"></i></span>
                        <input type="text" class="form-control" placeholder="First Name" name="fname">
                    </div>
                    <!-- lname -->
                    <div class="input-group mb-3 mx-auto" style="width: 50%;">
                        <span class="input-group-text"><i class="far fa-user-circle" style="font-size: 20px;"></i></span>
                        <input type="text" class="form-control" placeholder="Last Name" name="lname">
                    </div>
                    <!-- email -->
                    <div class="input-group mb-3 mx-auto" style="width: 50%;">
                        <span class="input-group-text"><i class="far fa-envelope" style="font-size: 20px;"></i></span>
                        <input type="email" class="form-control" placeholder="Email Id" name="email">
                    </div>
                    <!-- contact -->
                    <div class="input-group mb-3 mx-auto" style="width: 50%;">
                        <span class="input-group-text"><i class="fas fa-phone" style="font-size: 20px;"></i></span>
                        <input type="text" class="form-control" placeholder="Contact No" name="contact">
                    </div>
                    <!-- add comments -->
                    <div class="input-group mb-3 mx-auto" style="width: 50%;">
                        <span class="input-group-text"><i class="fas fa-map-marked-alt" style="font-size: 20px;"></i></span>
                        <textarea class="form-control" placeholder="Address" name="address"></textarea>
                    </div>
                    <!-- submit -->
                    <button type="submit" class="btn btn-dark">Place Order</button>
                </form>
                <!-- php -->

                <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") {


                    //connecting to db
                    include_once 'config.php';

                    //submit this to db

                    if (empty(trim($_POST['fname'])) || empty(trim($_POST['lname'])) || empty(trim($_POST['lname'])) || empty(trim($_POST['lname'])) || empty(trim($_POST['lname'])) || empty(trim($_POST['lname'])) || $total == 0) {
                        $err = "Please, fill the form completely!";
                    } else {
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $email = $_POST['email'];
                        $contact = $_POST['contact'];
                        $address = $_POST['address'];
                        $amount = $total;
                    }
                    if (empty($err)) {
                        //my sql query to be executed
                        $sql = "INSERT INTO `orders` (`fname`, `lname`, `email`, `contact`, `address`, `amount`, `created_at`) VALUES ('$fname', '$lname', '$email', '$contact', '$address', $amount, current_timestamp())";
                    }
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        echo '<h1>Your order has been placed!</h1>';
                    } else {
                        echo "Not inserted succesfully!";
                        mysqli_errno($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>