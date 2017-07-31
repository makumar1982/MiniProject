<?php
include'dbconnect.php';
if(isset($_POST['name'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['addr'];
    $gender = $_POST['gender'];
    $education = $_POST['edu'];
   if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
    echo("Email is not valid");
   } else {
    $email = $_POST['email'];
   }
 $uname = mysqli_real_escape_string($con,filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
 $pass = mysqli_real_escape_string($con,$password);
 $add = mysqli_real_escape_string($con,  htmlentities(addslashes($address)));
 $query = "INSERT INTO tbl_user(`name`, `email`, `password`, `address`, `gender`, `education`) VALUES ('$uname','$email',md5('$pass'),'$add','$gender','$education')";
 mysqli_query($con,$query);
}
?>

