<!-- ket noi toi database -->
<?php 
require_once('../../database/dbhelper.php');
require_once('../../database/utility.php');
require_once ('process_register.php');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link rel="stylesheet" href="../register/register.css"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
    </head>

    <body>
        <img class="background_img" src="../../masterial/image/bgrAdminPage/bgrLogin.jpg" alt="" style="position: fixed;">
        <div class="screen" style="position: fixed;"></div>
        <div class="box_content">
        <a href="../homepage/homepage.php"><img class="logo" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="logo" style="margin-top: 60px;"></a>
        


        <form class="box" action="" method="post" >
            <h2 class="h2">ĐĂNG KÝ TÀI KHOẢN</h2>
            
            <!-- <label for="username" class="label_for_email" >Tên đăng nhập</label> -->
            <input type="text" name="username-register" id ="username" placeholder="Tên của bạn" required = "true" autofocus> 

            <!-- <label for="password" class="label_for_email" >Mật khẩu</label> -->
            <input type="password" name="password-register" id ="password" placeholder="Mật khẩu" required = "true" onblur="password_check()">
            <p id="password_check" ></p>

            <!-- <label for="password-confirm" class="label_for_email" >Xác nhận mật khẩu</label> -->
            <input type="password" name="password-confirm" id ="password-confirm" placeholder="Xác nhận mật khẩu" required = "true" onblur="mouseover()" >
            <p id="pass-inform" ></p>

            <!-- <label for="gmail" class="label_for_email">Email</label> -->
            <input type="text" name="gmail" id ="gmail" placeholder="Email" required = "true" onblur="gmail_check()">
            <p id="gmail-inform"></p>

            <!-- <label for="address" class="label_for_email">Địa chỉ</label> -->
            <input type="text" name="address-register" id ="address" placeholder="Địa chỉ" required = "true">
            <p id="address-confirm" ></p>

            <!-- <label for="phonenumber" class="label_for_email">Số điện thoại</label> -->
            <input type="text" name="phonenumber-register" id ="phonenumber" placeholder="Số điện thoại" required = "true" onblur="phone_check()">
            <p id="phonenumber-inform" ></p>

            <!-- <img type = "submit" src="../../masterial/image/iconAdminPage/login.svg" alt=""> -->
            <input type="submit" id="submit" name="" value="Đăng ký" style="width: fit-content;" >
            <!-- <a href="../AdminSystem/DashBoard/DashBoard.html" type="submit" class="button btn btn-primary active">LOGIN</a> -->
            
            
        </form>
        </div>

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
        <!-- <scripĐăng ký.js"></script> -->
        
    </body>

</html>





