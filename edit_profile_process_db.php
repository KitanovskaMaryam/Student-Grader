<?php 
session_start();
require "config.php";
include "includes/header.php";

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true) {
          header('location:login.php');
          exit;
}

$user_id = $_SESSION['id'];

$fname_error = "";
$lname_error = "";
$email_error = "";

$fname = "";
$lname = "";
$email = "";



if($_SERVER['REQUEST_METHOD'] == "POST"){



          $fname = $_POST['fname'];
          $lname = $_POST['lname'];
          $email = $_POST['email'];


if (empty(trim($fname))){
          $fname_error = "Please enter your first name";
} else{
          $fname = trim ($_POST['fname']);
}

if (empty(trim($lname))){
          $lname_error = "Please enter your last name";
} else{
          $lname = trim ($_POST['lname']);
}

if (empty(trim($email))){
          $email_error = "Please enter your email";
} else{
          $email = trim ($_POST['email']);
} 

echo $fname;
echo "</br>";
echo $lname;
echo "</br>";
echo $email;




// ako nekoja od promenlivite za greski ima vrednost
// ako site promenlivi za greski se prazni znaci se e okej

if(empty($fname_error)&&empty($lname_error)&& empty($email_error)) {


          // $sql = "INSERT INTO users (fname, lname, email, username, password, created_at) VALUES (:fname, :lname, :email, :username, :passwordUser, :created_at)";

          $sql = "UPDATE users SET fname=:fname, lname=:lname, email=:email WHERE user_id=:id";

          if($stmt = $pdo -> prepare($sql)){
                    // bind na varijabli
                    $stmt->bindParam("fname",$param_fname);
                    $stmt->bindParam("lname",$param_lname);
                    $stmt->bindParam("email",$param_email);
                    $stmt->bindParam("id",$param_id);

                    // setiranje na parametri
                    $param_fname = $fname;
                    $param_lname = $lname;
                    $param_email = $email;
                    $param_id = $user_id;

                    // ke izvrsime stmt

                    if($stmt -> execute()){
                              echo "uspesno vneseni podatoci";
                    } else {
                              echo "nesto ne e vo red";
                    }
          }
}

}

?>