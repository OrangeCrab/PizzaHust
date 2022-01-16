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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="login_user.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
    </head>

    <body > 
        <img class="background_img" src="../../masterial/image/bgrAdminPage/bgrLogin.jpg" alt="">
        <div class="screen"></div>
        
        <div class="box_content">
        <a href="../homepage/homepage.php"><img class="logo" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="logo"></a>
        
        <form class="box" action="" method="post">
            <h2 style="margin-top: 20px;">ĐĂNG NHẬP</h2>
            <label for="email" class="label_for_email">Email</label>
            <input type="text" name="email" id ="email" placeholder="Email" required="true" autofocus onblur="email_check()">   
            <p id="gmail-confirm"></p>
            
            <label for="password" class="label_for_password" >Mật khẩu</label>
            <input type="password" name="password" id ="password" placeholder="Password" required="true" onblur="password_check()">
            <p id="password_check" ></p>
            <input type="submit" name="" value="Đăng nhập" id="submit" style="width: fit-content;">
            <!-- <a href="../AdminSystem/DashBoard/DashBoard.html" type="submit" class="button btn btn-primary active">LOGIN</a> -->
            <div class="link">
                <a href="../forget/forget.php" class="forget">Quên mật khẩu</a>
                <a href="../register/register.php" class="register">Đăng ký tài khoản</a>

            </div>
            
        </form>
     </div>
        <script>
            function email_check(){
                var email = document.getElementById('email').value;
                var gmail_inform = document.getElementById('gmail-confirm');
                const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
                var check = regex.test(email);

                if(!check){
                   gmail_inform.textContent = "Trường này phải là email !";
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




