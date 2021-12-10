<?php 

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
        $sql = "select username from user_acount where username = '$user_name_register'";
        $userExist = executeResult($sql);


        // neu khong co nguoi dung nao
        if(empty($userExist)){           
            $sql = "insert into user_acount (username, password,email,phonenumber,address) values ('$user_name_register','$password_register','$email','$phonenumber','$address')";
            execute($sql);

            header("location: ../homepage/homepage.php");
            die();           
        }
        else{
            echo '
                <script type="text/javascript">
                    alert("This user name did exist"); 
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