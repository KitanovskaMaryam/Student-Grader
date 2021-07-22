<?php 
session_start();
include "config.php";
include "includes/header.php";

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true) {
    header('location:login.php');
    exit;
}


// $_SESSION['loggedin'] = true;
// $_SESSION['username'] = $uname;



echo "Zdravo ".$_SESSION["username"];
echo "User id ".$_SESSION['id'];
?>


<p>Ova e pocetna strana</p>

<a href="logout.php">logout</a>



<?php

 include "includes/footer.php"; 
?>

