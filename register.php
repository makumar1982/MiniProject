<?php
session_start();
 include'dbconnect.php';
 $qry = "select * from course";
 $res = mysqli_query($con, $qry);
 if(isset($_SESSION['name']) && isset($_SESSION['pass'])){
 $uname = $_SESSION['name'];
 $upass = $_SESSION['pass'];
 $query = "select * from tbl_user where email='$uname' AND password=md5('$upass')"; 
 $res1 = mysqli_query($con, $query);
 $res1 = mysqli_query($con, $query);
        if (mysqli_num_rows($res1)>0) {
            $row = mysqli_fetch_assoc($res1);
            print_r($row); 
        }
 }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
    </head>
    <body>
        <div style="position: relative;"><a href="index.php">SignIn</a></div>
        <fieldset>
            <legend>REGISTRATION</legend>
            <form id="formdata">
            Name*:<input type="text" name="name" id="name" placeholder="NAME" required value="<?php echo !empty($row['name'])?$row['name']:'';?>"></br></br>
            Email*:<input type="email" name="email" id="email" placeholder="EMAIL(used as username)" required value="<?php echo !empty($row['email'])?$row['email']:'';?>"></br></br>
            Password*:<input type="password" id="password" name="password" value="" placeholder="PASSWORD" required></br></br>
            Password*:<input type="password" id="repassword" name="repassword" value="" placeholder="REENTER PASSWORD" required></br></br>
            ADDRESS:<textarea style="resize: none" name="addr" rows="10" cols="30"><?php echo !empty($row['address'])?$row['address']:'';?></textarea></br></br>
            Male:<input type="radio" name="gender" value="male" <?php if(!empty($row['gender']) && $row['gender'] == 'male') echo 'checked';?>>
            Female:<input type="radio" name="gender" value="female" <?php if(!empty($row['gender']) && $row['gender'] == 'female')echo 'checked'?>></br></br>
            Education*:<select name="edu" id="edu">
                <option value="0">Please Select Option</option>
                <?php
                while($row = mysqli_fetch_assoc($res)){?>
                <option value="<?php echo $row['coursename'];?>" selected><?php echo $row['coursename']; ?> </option>
<!--                <option value="<?php if($row1['coursename'] == $row['education']) echo 'selected';?>"><?php echo $row1['coursename']; ?> </option>-->
                <?php }
                ?>
            </select></br></br>
            <input type="button" value="submit" name="submit" id="submit"/>  
            </form>
        </fieldset>
        <div id="error_login"></div>
    </body>
</html>
<script src="jquery-3.2.1.js"></script>
<script>
    $(document).ready(function(){
        $("#submit").click(function(){
            var pass =$("#password").val();
            var rpass =$("#repassword").val();
            var edu =$("#edu").val();
            var name =$("#name").val();
            var email =$("#email").val();
            if(pass ==='' && name==="" && email===''){
            $("#error_login").html("Please fill all mandatory(*) fields");
            }
            else if(pass !== rpass){
                $("#error_login").html("Password and Repasword donot match");
            }
            else{
               $.ajax({
                  type:'POST',
                  url:'test.php',
                  data:$("#formdata").serialize(),
                  success:function(data){
                      $('form').trigger("reset");
                      $("#error_login").html(data);
                  }
               });
           }
        });

    });
</script>
    


