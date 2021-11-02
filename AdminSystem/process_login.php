<?php 

$password = $user_name= $msg = '';
    if(!empty($_POST)){
        $user_name = getPost('username');
        $password = getPost('password');

        $sql = "select * from admin where user_name = '$user_name' and password = '$password'";
        $userExist = executeResult($sql);
        if($userExist == null){
            $msg = "Đăng nhập không thành công, vui lòng kiểm tra lại tên đăng nhập hoặc mật khẩu";
           // dang nhap khong thanh cong 
        }
        else{
            // dang nhap thanh cong
            header('location: DashBoard/DashBoard.html');
            die();
        }   
     }