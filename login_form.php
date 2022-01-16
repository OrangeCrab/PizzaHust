<!-- ket noi toi database -->
<?php 
require_once('../database/dbhelper.php');
require_once('../database/utility.php');
require_once ('process_login.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="login.css">
    </head>

    <body>
        <img class="background_img" src="../masterial/image/bgrAdminPage/bgrLogin.jpg" alt="">
        <div class="screen"></div>
        
        <a href="../ShowForGuest/homepage/homepage.php"><img class="logo" src="../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="logo"></a>
        
        <form class="box" action="" method="post">
            <h2>ĐĂNG NHẬP</h2>
            <input type="text" name="username" id ="username" placeholder="Username"  required="true" autofocus>  

            <input type="password" name="password" id ="password" placeholder="Password" onblur="password_check()">
            <p id="password_check"></p>
            <input type="submit" id="submit" name="" value="Đăng nhập">
        </form>
        <script>
            function password_check(){
                var password = document.getElementById("password").value;
                var password_inform = document.getElementById("password_check");
                var submit = document.getElementById("submit");
                var size = password.length;
               if(size < 6){
                    password_inform.textContent = "Mật khẩu phải có ít nhất 6 ký tự !";
                    submit.disabled = true;
                }
                else{
                    submit.disabled = false;
                    password_inform.textContent = "";
                }
                
            }
        </script>


    </body>

</html>