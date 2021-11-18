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
        


        <form class="box" action="" method="post" style="height: fit-content;" >
            <h2>REGISTER</h2>
            <input type="text" name="username-register" id ="username" placeholder="Username" required = "true">       
            <input type="password" name="password-register" id ="password" placeholder="Password" required = "true">
            <input type="password" name="password-confirm" id ="password-confirm" placeholder="Confirm_password" required = "true" onblur="mouseover()" >
            <p id="pass-inform" style="color: red; font-size: small;"></p>
            <input type="text" name="gmail" id ="gmail" placeholder="Gmail" required = "true" onblur="gmail_check()">
            <p id="gmail-inform" style="color: red; font-size: small;"></p>
            <!-- <img type = "submit" src="../../masterial/image/iconAdminPage/login.svg" alt=""> -->
            <input type="submit" id="submit" name="" value="Register" style="width: fit-content;" >
            <!-- <a href="../AdminSystem/DashBoard/DashBoard.html" type="submit" class="button btn btn-primary active">LOGIN</a> -->
            
            
        </form>

        <script>
            function mouseover(){
                var password = document.getElementById("password").value;
                var password_confirm = document.getElementById("password-confirm").value;
                var password_inform = document.getElementById("pass-inform");
                var submit = document.getElementById("submit");
               if(password !== password_confirm){
                    password_inform.textContent = "Mật khẩu không khớp !";
                    submit.disabled = true;
                }
                else{
                    submit.disabled = false;
                    password_inform.textContent = "";
                }
                
            }

            function gmail_check(){
                var gmail_text = document.getElementById("gmail").value;
                var gmail_inform = document.getElementById("gmail-inform");
                var submit = document.getElementById("submit");
                const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/ ;
                var check = regex.test(gmail_text);
                if(!check){
                    gmail_inform.textContent = "Trường này phải là gmail !";
                    submit.disabled = true;
                    
                }
               else{
                submit.disabled = false;
                 gmail_inform.textContent = "";
               }
            }

        </script>
        <!-- <script src="register.js"></script> -->
        
    </body>

</html>





