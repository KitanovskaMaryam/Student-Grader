<?php 
session_start();
include "config.php";
include "includes/header.php";

if($_SESSION['id'] == 1) {
 


$sql = "SELECT `user_id`,`fname`,`lname`,`email` FROM `users`";

$result = $pdo->prepare($sql);

$result->execute();

if($result->rowCount() > 0){

          echo "<table style='border: 1px solid black;padding: 5px;'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>";
          echo "User ID";
          echo "</th>";
          echo "<th>";
          echo "Name";
          echo "</th>";
          echo "<th>";
          echo "Last Name";
          echo "</th>";
          echo "<th>";
          echo "Email";
          echo "</th>";
          echo "<th>";
          echo "Action";
          echo "</th>";
          echo "</tr>";
          echo "</thead>";
          while($row = $result->fetch()){
                    echo "<tr>";
                    echo "<td style='border: 1px solid black; padding= 5px;'>";
                    echo " ".$row['user_id'];
                    echo "</td>";
                    
                    echo "<td style='border: 1px solid black;  padding= 5px;'>";
                    echo " ".$row['fname'];
                    echo "</td>";

                    echo "<td style='border: 1px solid black;  padding= 5px;''>";
                    echo " ".$row['lname'];
                    echo "</td>";

                    echo "<td style='border: 1px solid black;  padding= 5px;''>";
                    echo " ".$row['email'];
                    echo "</td>";

                    echo "<td style='border: 1px solid black;  padding= 5px;''>";
                    if($_SESSION['id'] == 1) {?> <a href="delete_profile.php?get_user_id=<?php echo $user_id; ?>" style="color:red;">Delete my profile</a> <?php};
                    echo "</td>";

                    
                    echo "</tr>";
          }
                    echo "</table>";

}
}else{
          header('location:logout.php');
          exit;
}
?>