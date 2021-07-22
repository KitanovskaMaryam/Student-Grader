<?php 

require "config.php";
include "includes/header.php";

$fname_error = "";
$lname_error = "";
$username_error = "";
$email_error = "";
$passwordUser_error = "";
$created_at = "";
$fname = "";
$lname = "";
$username = "";
$email = "";
$passwordUser = "";
$created_at = "";


if($_SERVER['REQUEST_METHOD'] == "POST"){



          $fname = $_POST['fname'];
          $lname = $_POST['lname'];
          $email = $_POST['email'];
          $username = $_POST['username'];
          $passwordUser = $_POST['password'];
          $created_at = time();

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

// strlen();

if (empty(trim($passwordUser))){
          $passwordUser_error = "Please enter your password";
}else if(strlen(trim($passwordUser)) < 4 ){
          $passwordUser_error = "Password must have at least 4 characters";
}  
else{
          $passwordUser = trim ($_POST['password']);
}

if(empty(trim($username))){
          $username_error = "Please enter your username";
} else{



// PREPARE Select

$sql = "SELECT user_id FROM users WHERE username = :username";

if($stmt = $pdo->prepare($sql)) {
          $stmt->bindParam(":username",$param_username);

          $param_username = trim($_POST['username']);

}
if($stmt->execute()){
          if($stmt->rowCount() >= 1){
                    $username_error = "This username is taken. Please ...";
          } else{
                    $username = trim($_POST['username']);
          }
} else{
          echo "Something is wrong";
}
unset($stmt);
}

// ako nekoja od promenlivite za greski ima vrednost
// ako site promenlivi za greski se prazni znaci se e okej

if(empty($fname_error)&&empty($lname_error)&&empty($username_error) && empty($email_error) &&empty($passwordUser_error)) {


          $sql = "INSERT INTO users (fname, lname, email, username, password, created_at) VALUES (:fname, :lname, :email, :username, :passwordUser, :created_at)";

          if($stmt = $pdo -> prepare($sql)){
                    // bind na varijabli
                    $stmt->bindParam("fname",$param_fname);
                    $stmt->bindParam("lname",$param_lname);
                    $stmt->bindParam("email",$param_email);
                    $stmt->bindParam("username",$param_username);
                    $stmt->bindParam("passwordUser",$param_passwordUser);
                    $stmt->bindParam("created_at",$param_created_at);

                    // setiranje na parametri
                    $param_fname = $fname;
                    $param_lname = $lname;
                    $param_email = $email;
                    $param_username = $username;
                    $param_passwordUser = $passwordUser;
                    $param_created_at = $created_at;

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
<div class="container">
          <h2 class="title">Register</h2>
          <p>Please fill this form to create an account.</p>
          <div class="content">
          <form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" id="registerForm">
          <div class="user-details">
          <div class="input-box">
                    <label for="fname" class="details">First Name</label>
                    <input type="text" id="fname" name="fname" placeholder="Enter First Name">
                    <span><?php echo $fname_error ?></span>
          </div>
          <div class="input-box">
                    <label for="lname" class="details">Last Name</label>
                    <input type="text" id="lname" name="lname" placeholder=" Enter Last Name">
                    <span><?php echo $lname_error ?></span>
          </div>
          <div class="input-box">
                    <label for="email" class="details">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email">
                    <span><?php echo $email_error ?></span>
          </div>
          <div class="input-box">
                    <label for="username" class="details">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter Username">
                    <span><?php echo $username_error ?></span>
          </div>
          <div class="input-box">
                    <label for="password" class="details">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password">
                    <span><?php echo $passwordUser_error ?></span>
          </div>
          </div>
          <div class="button-flex">
                    <input type="submit" value="Submit" id = "submit" class="buttonSubmit">
                    <button class="button" onclick="resetFunction()">Reset</button>

          </div>
          </form>   
          <p>Already have an account? <a href="#" class="login-here"> Login here</a>.</p>
          </div>
</div>
<?php
include "includes/footer.php";
?>