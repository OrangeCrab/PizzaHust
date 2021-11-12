<!-- ket noi toi database -->
<?php 
require_once('../database/dbhelper.php');
require_once('../database/utility.php');
require_once ('process_register.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="register.css"> 
    </head>

    <body>
        <img class="background_img" src="../masterial/image/bgrAdminPage/bgrLogin.jpg" alt="">
        <div class="screen"></div>
        
        <a href="../homepage/homepageDraft.php"><img class="logo" src="../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="logo"></a>
        


        <form class="box" action="" method="post" style="height: fit-content;" onsubmit="register()" >
            <h2>LOGIN</h2>
            <input type="text" name="username-register" id ="username" placeholder="Username" required = "true">       
            <input type="password" name="password-register" id ="password" placeholder="Password" required = "true">
            <input type="password" name="password-confirm" id ="password-confirm" placeholder="Confirm_password" required = "true" onblur="mouseover()">
            <input type="text" name="gmail" id ="gmail" placeholder="Gmail" required = "true" onblur="gmail()">
            <p id="gmail-inform" style="color: red;"></p>
            <!-- <img type = "submit" src="../../masterial/image/iconAdminPage/login.svg" alt=""> -->
            <input type="submit" name="" value="Register" style="width: fit-content;">
            <!-- <a href="../AdminSystem/DashBoard/DashBoard.html" type="submit" class="button btn btn-primary active">LOGIN</a> -->
            
            
        </form>
       
        
        <!-- <script>
            function mouseover(){
                var password = document.getElementById("password").value;
                var password_confirm = document.getElementById("password-confirm");
                var gmail = document.getElementById("gmail").value;
                if(password !== password_confirm){
                    alert("Mật khẩu nhập không khớp !!!");
                    password_confirm.textContent = null;
                }
            }
            function gmail(){
                var gmail = document.getElementById("gmail").value;
                var gmail_inform = document.getElementById("gmail-inform");
                const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
                var check = regex.test(gmail);

                if(!check){
                    gmail_inform.textContent = "Trường này phải là gmail !";
                }
            }
        </script> -->
    </body>

</html>




