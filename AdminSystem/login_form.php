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
        
        <img class="logo" src="../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="logo">


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

<!-- <!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <img class="background_img" src="../masterial/image/bgrAdminPage/bgrLogin.jpg" alt="">
        <div class="screen"></div>
        
        <img class="logo" src="../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="logo">

        
        <form class="box" action="" method="POST">
            <h2>LOGIN</h2>
            <input type="text" name="username" id ="username" placeholder="Tên đăng nhập" >       
            <input type="password" name="password" id ="password" placeholder="Password">
            <!-- <img type = "submit" src="../../masterial/image/iconAdminPage/login.svg" alt=""> -->
            <button class="btn btn-success">Đăng Nhập</button>
            
            
        </form>

    </body>
</html>  -->
