<?php 
session_start();
$password = $user_name= $msg = '';
    // kiem tra xem nguoi dung co nhap du lieu khong
    // bằng cách kiem tra xem co qua trinh POST len server khong
   
    if(!empty($_POST)){
        //Neu co
        $user_name = getPost('username');
        $password = getPost('password');
        
        // chay cau lenh sql de lay ra gia tri trong database co gia tri bang gia tri nguoi dung nhap vao
        $sql = "select id from user_account where username = '$user_name' and password = '$password'";
        $userExist = executeResult($sql);

        // neu khong co nguoi dung nao
        if($userExist == null){
            header('location: ../forget/forget.php');
            die();
           // dang nhap khong thanh cong 
        }
        else{
            // dang nhap thanh cong
            $user_id = array($userExist);
            $_SESSION['user_id'] = $user_id[0][0]['id'];
            $_SESSION['count_for_login'] = 0;
            header('location: ../homepage/homepage.php');
            die();
        }

       
     }
?>