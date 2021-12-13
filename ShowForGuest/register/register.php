<!-- ket noi toi database -->
<?php 
require_once('../../database/dbhelper.php');
require_once('../../database/utility.php');
require_once ('process_register.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="../register/register.css"> 
    </head>

    <body>
        <img class="background_img" src="../../masterial/image/bgrAdminPage/bgrLogin.jpg" alt="" style="position: fixed;">
        <div class="screen" style="position: fixed;"></div>
        
        <a href="../homepage/homepage.php"><img class="logo" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="logo" style="margin-top: 60px;"></a>
        


        <form class="box" action="" method="post" style="height: fit-content; margin-top: 150px;" >
            <h2>REGISTER</h2>
            <input type="text" name="username-register" id ="username" placeholder="Username" required = "true" autofocus> 

            <input type="password" name="password-register" id ="password" placeholder="Password" required = "true" onblur="password_check()">
            <p id="password_check" style="color: red; font-size: small;"></p>

            <input type="password" name="password-confirm" id ="password-confirm" placeholder="Confirm_password" required = "true" onblur="mouseover()" >
            <p id="pass-inform" style="color: red; font-size: small;"></p>

            <input type="text" name="gmail" id ="gmail" placeholder="Gmail" required = "true" onblur="gmail_check()">
            <p id="gmail-inform" style="color: red; font-size: small;"></p>

            <input type="text" name="address-register" id ="username" placeholder="Address" required = "true">
            <p id="address-confirm" style="color: red; font-size: small;"></p>

            <input type="text" name="phonenumber-register" id ="phonenumber" placeholder="Phone number" required = "true" onblur="phone_check()">
            <p id="phonenumber-inform" style="color: red; font-size: small;"></p>

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

            function gmail_check(){
                var gmail_text = document.getElementById("gmail").value;
                var gmail_inform = document.getElementById("gmail-inform");
                var submit = document.getElementById("submit");
                var regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/ ;
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

            function phone_check(){
                var phone_text = document.getElementById("phonenumber").value;
                var phone_inform = document.getElementById("phonenumber-inform");
                var submit = document.getElementById("submit");
                var regex = /^-?[0-9][0-9,\.]+$/ ;
                var check = regex.test(phone_text);
                if(!check){
                    phone_inform.textContent = "Trường này phải là số điện thoại !";
                    submit.disabled = true;
                    
                }
               else{
                 submit.disabled = false;
                 phone_inform.textContent = "";
               }
            }

        </script>
        <!-- <script src="register.js"></script> -->
        
    </body>

</html>





