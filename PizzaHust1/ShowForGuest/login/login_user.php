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
            <label for="email" style="font-size: 14px;">Email</label>
            <input type="text" name="email" id ="email" placeholder="Email" required="true" autofocus onblur="email_check()">   
            <p id="gmail-confirm" style="color: red; font-size:small"></p>
            
            <label for="password" style="font-size: 14px;">Mật khẩu</label>
            <input type="password" name="password" id ="password" placeholder="Password" required="true" onblur="password_check()">
            <p id="password_check" style="color: red; font-size:small"></p>
            <input type="submit" name="" value="Login" id="submit">
            <!-- <a href="../AdminSystem/DashBoard/DashBoard.html" type="submit" class="button btn btn-primary active">LOGIN</a> -->
            <div class="link container">
                <a href="../forget/forget.php">Quên mật khẩu</a>
                <a href="../register/register.php">Đăng ký tài khoản</a>

            </div>
            
        </form>
        <script>
            function email_check(){
                var email = document.getElementById('email').value;
                var gmail_inform = document.getElementById('gmail-confirm');
                const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
                var check = regex.test(email);

                if(!check){
                   gmail_inform.textContent = "trường này phải là email !";
                   gmail_inform.style.color = "red";
                   gmail_inform.style.fontSize = "small";
                   document.getElementById('submit').disabled = true;
                }
                else{
                    gmail_inform.textContent = "";
                   document.getElementById('submit').disabled = false;
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


        </script>
      

    </body>

</html>




