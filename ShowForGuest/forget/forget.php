<?php
 require_once('../../database/define.php');
 require_once('../../database/dbhelper.php');
 require_once('../../database/utility.php');
 require_once("process_forget.php");
?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quên mật khẩu</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
        <link rel="stylesheet" href="forget.css">
    </head>
    <body>
        <img class="background_img" src="../../masterial/image/bgrAdminPage/bgrLogin.jpg" alt="">
        <div class="screen"></div>
        
        <a href="../homepage/homepage.php"><img class="logo" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="logo"></a>
        


        <form class="box" action="" method="post">
            <h2 class="container h2" style="color: orange ;">MẬT KHẨU SẼ ĐƯỢC GỬI VÀO GMAIL BẠN ĐÃ ĐĂNG KÝ TRƯỚC ĐÂY</h2>
            <p style="color: blue;font-family: Monsterrat;">Vui lòng nhập gmail bạn đã đăng ký trước đây để lấy lại mật khẩu.</p>
            <label for="username1" style="font-size: 14px;">Tên đăng nhập</label>
            <input type="text" name="username" id ="username1" placeholder="pizzahust" required = "true" autofocus>       
            <p id="username-inform" ></p>
            <label for="username" style="font-size: 14px;">Email</label>
            <input type="text" name="email" id ="email" placeholder="abc123@gmail.com" required = "true" onblur="gmail()">       
            <p id="gmail-inform" ></p>
            <input type="submit" name="" id="submit" value="GỬI" >
           
            
        </form>
        <script>

            var gmail_inform = document.getElementById("gmail-inform");
            function gmail(){
                var gmail = document.getElementById("username").value;
                const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
                var check = regex.test(gmail);

                if(!check){
                   gmail_inform.textContent = "trường này phải là gmail !";
                   gmail_inform.style.color = "red";
                   gmail_inform.style.fontSize = "small";
                   document.getElementById('submit').disabled = true;
                }
                else{
                    gmail_inform.textContent = "";
                   document.getElementById('submit').disabled = false;
                }
            }

            // function click(){
            //     gmail_inform.addEventListener('click', function (){
            //         gmail_inform.innerHTML = null ;
            //     });
            // }
             
           

        </script>
       
    </body>
</html>



