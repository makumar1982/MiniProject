<?php
session_start();
include'dbconnect.php';
if (isset($_POST['uname'])) {
    $name = $_POST['uname'];
    $pass = $_POST['upass'];
    if (!filter_input(INPUT_POST, "uname", FILTER_VALIDATE_EMAIL)) {
        echo("Email is not valid");
    } else {
        $uname = mysqli_real_escape_string($con,$name);
        $_SESSION['name'] = $uname;       
        $upass = mysqli_real_escape_string($con,$pass);
        $_SESSION['pass'] = $pass;
        $query = "select * from tbl_user where email='$uname' AND password=md5('$upass')";
        $res = mysqli_query($con, $query);
        if (mysqli_num_rows($res)>0) {
            //header('Access-Control-Allow-Origin', '*');
           // header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            //header('Location:userdetails.php');
            echo '<table border=1>';
            while($row = mysqli_fetch_assoc($res)){
                echo "<tr>";
                echo "<th>NAME</th>";
                echo "<th>EMAIL</th>";
                echo "<th>ADDRESS</th>";
                echo "<th>EDIT</th>";
                echo "<th>DELET</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>".$row['name']."</th>";
                echo "<th>".$row['email']."</th>";
                echo "<th>".$row['address']."</th>";
                echo "<th><a href='register.php'>EDIT</a></th>";
                echo "<th><a href=''>DELETE</a></th>";
                echo "</tr>";
            }
            echo '</table>';
        } else {
            echo 'Please provide valid username or password';
        }
    }
}

