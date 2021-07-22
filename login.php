<?php 

require "config.php";
include "includes/header.php";

$passwordUser = "";
$username = "";
$passwordUser_error = "";
$username_error = "";
$wrng_psw = "";
$wrng_usern = "";

          if($_SERVER['REQUEST_METHOD'] == "POST"){

          $username = $_POST['username'];
          $passwordUser = $_POST['password'];

          if (empty(trim($username))){
                    $username_error = "Please enter username";
          } else{
                    $username = trim ($_POST['username']);
          }

          if (empty(trim($passwordUser))){
                    $passwordUser_error = "Please enter password";
          } else{
                    $passwordUser = trim ($_POST['password']);
          }

          $sql = 'SELECT user_id, username, password FROM users WHERE username = :username ';

          if($stmt = $pdo -> prepare($sql)){
                    $stmt->bindParam(":username",$param_username);
                    
                    $param_username = $username;

                    if($stmt->execute()){
                              if($stmt->rowCount() == 1) {
                                        if($row = $stmt->fetch()){
                                                  $username = $row['username'];
                                                  $password = $row['password'];
                                                  $id = $row['user_id'];
                                                            if($password == $passwordUser){
                                                                      session_start();
                                                                      $_SESSION['loggedin'] = true;
                                                                      $_SESSION['username'] = $username;
                                                                      $_SESSION['id'] = $id;
                                                                      header("location:index.php");
                                                            } else{
                                                                      $wrng_psw = "Wrong password";
                                                            }
                                        }
                              } else {
                                        $wrng_usern = 'Username ne e tocen';
                              }
                    }
          }

}
?>
<div class="container container-login">
<h2 class="title">Login</h2>
<p>Please fill in your credentials to login.</p>
<div class="content">
          <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" id="registerForm">
          <div class="user-details login-form-user-details">
          <div class="input-box">
                    <label for="username" class="details">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter Username">
                    <span><?php echo $username_error ?></span>
                    <span><?php echo $wrng_usern ?></span>
          </div>
          <div class="input-box">
                    <label for="password" class="details">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password">
                    <span><?php echo $passwordUser_error ?></span>
                    <span><?php echo $wrng_psw ?></span>
          </div>
          </div>
          <div class="button-flex button-flex-login">
                    <input type="submit" value="Submit" id = "submit" class="buttonSubmit">
                    <button class="button" onclick="resetFunction()">Reset</button>

          </div>
          </form>   
          <p>Don't have an account? <a href="#" class="login-here"> Register here</a>.</p>
</div>
</div>


<?php

include "includes/footer.php";
?>