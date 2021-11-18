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
        
        <a href="../homepage/homepage.php"><img class="logo" src="../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="logo"></a>
        


        <form class="box" action="" method="post">
            <h2>LOGIN</h2>
            <input type="text" name="username" id ="username" placeholder="Username">       
            <input type="password" name="password" id ="password" placeholder="Password">
            <!-- <img type = "submit" src="../../masterial/image/iconAdminPage/login.svg" alt=""> -->
            <input type="submit" name="" value="Login">
            <a href="#">Quên mật khẩu</a>
            
        </form>

    </body>
</html>

