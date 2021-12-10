<?php

session_start();
$_SESSION = array();
session_destroy();
header("location: login.php");

?>

<!-- <li class="nav-item">
                    <a class="nav-link navlink text-dark" href="#welcome"><i class="fas fa-user-tie" style="font-size: 20px;"></i><?php echo " Hi ".ucwords( $_SESSION['username']) ?></a>
                </li> -->