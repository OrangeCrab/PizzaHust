<?php 
session_start();
$_SESSION['admin_id'] = 0;
require_once('../database/dbhelper.php');
require_once('../database/utility.php');
$password = $user_name= $msg = '';
    // kiem tra xem nguoi dung co nhap du lieu khong
    // bằng cách kiem tra xem co qua trinh POST len server khong
   
    if(!empty($_POST)){
        //Neu co
        $user_name = getPost('username');
        $password = getPost('password');
        
        // chay cau lenh sql de lay ra gia tri trong database co gia tri bang gia tri nguoi dung nhap vao
        $sql = "select * from admin";
        $userExist = getArrResult($sql);


        // neu khong co nguoi dung nao
        if($userExist == null){
            $msg = "Đăng nhập không thành công, vui lòng kiểm tra lại tên đăng nhập hoặc mật khẩu";
           // dang nhap khong thanh cong 
        }
        else{
            // dang nhap thanh cong
            //echo"thành công";
            if ($user_name == $userExist['username'] && $password == $userExist['password']) {
                $_SESSION['admin_id'] = $userExist['id'];
                header('location: ./DashBoard/dashboard.php');
                die();
            }else{
                $msg = "Đăng nhập không thành công, vui lòng kiểm tra lại tên đăng nhập hoặc mật khẩu";
            }
        }   
     }
?>