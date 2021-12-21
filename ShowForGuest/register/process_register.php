<?php 
session_start();
$password_register = $user_name_register= $gmail =$msg  = $phonenumber = $address ='';
$gmail_check = false;
    // kiem tra xem nguoi dung co nhap du lieu khong
    // bằng cách kiem tra xem co qua trinh POST len server khong
   
    if(!empty($_POST)){
        //Neu co
        $user_name_register = getPost('username-register');
        $email = getPost('gmail');
        $password_register = getPost('password-register');
        $phonenumber = getPost('phonenumber-register');
        $address = getPost('address-register');
        
        // chay cau lenh sql de lay ra gia tri trong database co gia tri bang gia tri nguoi dung nhap vao
        $sql = "select email from user_account where email = '$email'";
        $userExist = executeResult($sql);


        // neu khong co nguoi dung nao
        if(empty($userExist)){           
            $sql = "insert into user_account (username, password,email,phonenumber,address) values ('$user_name_register','$password_register','$email','$phonenumber','$address')";
            execute($sql);
            
            $sql_id = "select id from user_account where email = '$email'";
            $userExist_id = executeResult($sql_id);
            $user_id = array($userExist_id);
            $_SESSION['user_id'] = $user_id[0][0]['id'];
            $_SESSION['count_for_login'] = 0;

            header("location: ../homepage/homepage.php");
            die();           
        }
        else{
            echo '
                <script type="text/javascript">
                    alert("Email này đã đăng ký tài khoản khác !"); 
                </script>
              
            ';
        }   
     }
     function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
?>
