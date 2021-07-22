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

$get_user_id_test = $_GET['get_user_id'];
echo '<hr>';
echo $get_user_id_test;
echo '</hr>';

$sql = "DELETE FROM `users` WHERE `users`.`user_id` = :user_id";

if($stmt = $pdo->prepare($sql)){

          $stmt->bindParam(":user_id", $param_user_id);

          $param_user_id = $get_user_id_test;

          if($stmt->execute()){
                    // akauntot e izbrisan
                    header('location:logout.php');
                    exit;
          } else{
                    echo "Something went wrong, can't delete account!";
          }         
}

