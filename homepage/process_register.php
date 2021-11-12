<?php 

$password_register = $user_name_register= $gmail =$msg  = '';
$gmail_check = false;
    // kiem tra xem nguoi dung co nhap du lieu khong
    // bằng cách kiem tra xem co qua trinh POST len server khong
   
    if(!empty($_POST)){
        //Neu co
        $user_name_register = getPost('username-register');
        $password_register = getPost('password-register');
        $password_confirm = getPost("password-confirm");
        $gmail = getPost('gmail');
        
        // chay cau lenh sql de lay ra gia tri trong database co gia tri bang gia tri nguoi dung nhap vao
        $sql = "select user_name from user_account where user_name = '$user_name_register'";
        $userExist = executeResult($sql);


        // neu khong co nguoi dung nao
        if(empty($userExist)){
            if($password_register == $password_confirm){
                $email = test_input($gmail);
                // check if e-mail address is well-formed
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $sql = "insert into user_account (user_name, password,gmail) values ('$user_name_register','$password_register','$gmail')";
                    execute($sql);

                    header("location: homepageDraft.php");
                    die();
                }
                else{
                    echo "sai roi";
                }

            }
            else{
                echo '
                   <script>
                        alert("Passwords are not same !");
                   </script>
              
            ';
            }
            
        }
        else{
            echo '
                <script>
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