<?php 

$password = $username= $msg = '';
    // kiem tra xem nguoi dung co nhap du lieu khong
    // bằng cách kiem tra xem co qua trinh POST len server khong
   
    if(!empty($_POST)){
        //Neu co
        $username = getPost('username');
        $password = getPost('password');
        
        // chay cau lenh sql de lay ra gia tri trong database co gia tri bang gia tri nguoi dung nhap vao
        $sql = "select * from admin where username = '$username' and password = '$password'";
        $userExist = executeResult($sql);


        // neu khong co nguoi dung nao
        if($userExist == null){
            $msg = "Đăng nhập không thành công, vui lòng kiểm tra lại tên đăng nhập hoặc mật khẩu";
           // dang nhap khong thanh cong 
        }
        else{
            // dang nhap thanh cong
            //echo"thành công";
            header('location: Dashboard/DashBoard.html');
            die();
        }   
    }