<?php 
session_start();
$_SESSION['admin_id'] = 0;
$password = $user_name= $msg = '';
    // kiem tra xem nguoi dung co nhap du lieu khong
    // bằng cách kiem tra xem co qua trinh POST len server khong
   
    if(!empty($_POST)){
        //Neu co
        $user_name = getPost('username');
        $password = getPost('password');
        
        // chay cau lenh sql de lay ra gia tri trong database co gia tri bang gia tri nguoi dung nhap vao
        $sql_username  = "select username from admin";
        $sql_password = "select password from admin";

        $check_username = array(executeResult($sql_username));
        $check_password = array(executeResult($sql_password));
       


        // neu khong co nguoi dung nao
        if(empty($check_password) || empty($check_username)){
            $msg = "Đăng nhập không thành công, vui lòng kiểm tra lại tên đăng nhập hoặc mật khẩu";
           // dang nhap khong thanh cong 
        }
        else{
            // dang nhap thanh cong
            //echo"thành công";
            if ($user_name ==  $check_username[0][0]['username'] && $password == $check_password[0][0]['password']) {
                $_SESSION['admin_id'] = 1;
                header("location: DashBoard/dashboard.php");
                die();
            }else{
                $msg = "Đăng nhập không thành công, vui lòng kiểm tra lại tên đăng nhập hoặc mật khẩu";
            }
        }   
     }
?>