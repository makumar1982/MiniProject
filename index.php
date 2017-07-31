<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>UserDashboard</title>
    </head>
    <body>
        <div style="position: relative;"><a href="index.php">SignIn</a></div>
        <div style="position: relative;"><a href="register.php">SignUp</a></div>
        <fieldset>
            <legend>LOGIN FORM</legend>
            <form id="formlogin">
                Username:<input type="email" name="email" id="name" placeholder="PLEASE ENTER YOUR EMAIL HERE ONLY AS USERNAME" value=""></br></br>
                Password:<input type="password" id="password" name="password" value=""></br></br>
                <input type="button" value="submit" name="submit" id="submit"/> 
            </form>
        </fieldset>
        <div id="error_login"></div>
    </body>
</html>
<script src="jquery-3.2.1.js"></script>
<script>
    $(document).ready(function () {
        $("#submit").click(function () {
            var name = $("#name").val();
            var pass = $("#password").val();
            if (name == '' || pass == '') {
                $("#error_login").html("Username or Password cannot be blank.");
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'Logreg.php',
                    cache: false,
                    data: {'uname': name, 'upass': pass},
                    success: function (data) {
                        //$('form').trigger("reset");
                        $('fieldset').hide();
                        if (data !== null && data === 'success') {
                            window.location.href = "userdetails.php";
                        } else {
                            $("#error_login").html(data);
                        }
                    }
                });
            }
        });

    });
</script>

