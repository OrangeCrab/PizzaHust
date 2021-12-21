<!-- ket noi toi database -->
<?php 
require_once('../../database/dbhelper.php');
require_once('../../database/utility.php');
require_once ('process_user_login.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="login_user.css">
    </head>

    <body>
        <img class="background_img" src="../../masterial/image/bgrAdminPage/bgrLogin.jpg" alt="">
        <div class="screen"></div>
        
        <a href="../homepage/homepage.php"><img class="logo" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="logo"></a>
        


        <form class="box" action="" method="post">
            <h2>LOGIN</h2>
            <input type="text" name="username" id ="username" placeholder="Username" required="true" autofocus>       
            <input type="password" name="password" id ="password" placeholder="Password" required="true">
            <!-- <img type = "submit" src="../../masterial/image/iconAdminPage/login.svg" alt=""> -->
            <input type="submit" name="" value="Login">
            <!-- <a href="../AdminSystem/DashBoard/DashBoard.html" type="submit" class="button btn btn-primary active">LOGIN</a> -->
            <div class="link container">
                <a href="../forget/forget.php">Quên mật khẩu</a>
                <a href="../register/register.php">Đăng ký tài khoản</a>

            </div>
            
        </form>
      

    </body>

</html>




