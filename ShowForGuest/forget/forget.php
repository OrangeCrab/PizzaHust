<?php
 require_once('../../database/define.php');
 require_once('../../database/dbhelper.php');
 require_once('../../database/utility.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quên mật khẩu</title>
        <link rel="stylesheet" href="forget.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    
    </head>
    <body>
        <img class="background_img" src="../../masterial/image/bgrAdminPage/bgrLogin.jpg" alt="">
        <div class="screen"></div>
        
        <div class="content"> 
          <a href="../homepage/homepage.php"><img class="logo" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="logo"></a>
        
          <form class="box" action="" method="post">
              <h2 class="container h2" >MẬT KHẨU SẼ ĐƯỢC GỬI VÀO EMAIL BẠN ĐÃ ĐĂNG KÝ TRƯỚC ĐÂY</h2>
              <!-- <h4 class="container h4">Vui lòng nhập email bạn đã đăng ký trước đây để lấy lại mật khẩu.</h4> -->
              <label for="username" class="label_for_email">Email</label>
              <input type="text" name="email" id ="email" placeholder="abc123@gmail.com" required = "true" onblur="gmail()" autofocus>       
              <p id="gmail-inform" ></p>
              <input type="submit" name="" id="submit" value="GỬI" >           
          </form>
        </div>
        <script>
            function gmail(){
                var gmail_inform = document.getElementById("gmail-inform");
                var gmail = document.getElementById("email").value;
                const regex = /^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/;
                var check = regex.test(gmail);

                if(!check){
                   gmail_inform.textContent = "trường này phải là email !";
                   document.getElementById('submit').disabled = true;
                }
                else{
                    gmail_inform.textContent = "";
                   document.getElementById('submit').disabled = false;
                }
            }

           
             
           

        </script>
       
    </body>
</html>
<?php
 require_once("process_forget.php");
?>



