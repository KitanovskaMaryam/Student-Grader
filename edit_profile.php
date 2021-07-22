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



// echo "Zdravo 1".$_SESSION["username"]."<br>";
// echo "User id ".$_SESSION['id'];


$user_id = $_SESSION['id'];
echo "User ID: ".$user_id;
$sql = "SELECT fname, lname, email FROM users WHERE user_id = :user_id";

if($stmt = $pdo->prepare($sql)){

          $stmt->bindParam(":user_id", $param_user_id);

          $param_user_id = $user_id;

          if($stmt ->execute()){
          if($row = $stmt->fetch()){
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $email = $row['email'];


          }
}
};

?>
<div class="container">
          <h2 class="title">Edit my profile info:</h2>
          <p>Please fill this form to update profile info.</p>
          <div class="content">
          <form action ="edit_profile_process_db.php" method="POST" id="registerForm">
          <div class="user-details">
          <div class="input-box">
                    <label for="fname" class="details">First Name</label>
                    <input type="text" id="fname" name="fname" value ="<?php echo $fname?>">
          </div>
          <div class="input-box">
                    <label for="lname" class="details">Last Name</label>
                    <input type="text" id="lname" name="lname" value ="<?php echo $lname?>">
          </div>
          <div class="input-box">
                    <label for="email" class="details">Email</label>
                    <input type="email" id="email" name="email" value ="<?php echo $email?>">
          </div>
          </div>
          <div class="button-flex">
                    <input type="submit" value="Update" id = "submit" class="buttonSubmit">
                    <button class="button" onclick="resetFunction()">Reset</button>

          </div>
          </form>   
          <p>Already have an account? <a href="#" class="login-here"> Login here</a>.</p>
          </div>
</div>

<a href="logout.php">logout</a>



<?php

 include "includes/footer.php"; 
?>