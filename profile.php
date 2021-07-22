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

// $get_user_id_test = $_GET['get_user_id'];
// echo '<hr>';
// echo $get_user_id_test;
// echo '</hr>';

echo "Zdravo ".$_SESSION["username"]."<br>";
echo "User id ".$_SESSION['id'];


$user_id = $_SESSION['id'];

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
<p>My profile info:</p>
<br>
<?php
                    echo $fname;
                    echo "<br>";
                    echo $lname;
                    echo "<br>";
                    echo $email;
?>
<br>
<br>
<?php if($_SESSION['id'] == 1) { ?> <a href="view_all_users.php">View All Users</a> <?php } ?>
<br>
<br>
<a href="delete_profile.php?get_user_id=<?php echo $user_id; ?>" style="color:red;">Delete my profile</a>
<br>
<br>
<a href="edit_profile.php">Edit Profile</a>
<br>
<br>
<p>Ova e pocetna strana</p>
<a href="logout.php">logout</a>



<?php

 include "includes/footer.php"; 
?>




