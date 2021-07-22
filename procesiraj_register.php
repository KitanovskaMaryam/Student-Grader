<?php
$server = "localhost";
$user = "root";
$password = "";
$fname = $_POST['fname'];
$lname = $_POST['fname'];
$email = $_POST['email'];
$username = $_POST['username'];
$passwordUser = $_POST['password'];

try{
          $conn = new PDO ("mysql:host=$server; dbname=student-grader", $user,$password);
          $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $insert_table= "INSERT INTO users VALUES (
          '',
          '$fname', 
          '$lname', 
          '$email',
          '$username',
          '$passwordUser',
          ''
          )";

          $conn->exec($insert_table);
          echo "vnesovme vo  tabela";


}catch(PDOException $e){

          echo $insert_table . "</br>". $e->getMessage();
}
?>