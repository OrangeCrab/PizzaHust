<?php
    require_once('../../database/dbhelper.php');
    $baseUrl = '../../';
    // $_SESSION['user_id'] = 0;
    if (!(isset($_SESSION['user_id']) && $_SESSION['user_id'])){
        header('location: ../login/login_user.php');
        die();
    }
    $info = executeResult("select * from user_account");
    $customer = '';
    foreach($info as $ctminfo){
        if ($ctminfo['id'] == $_SESSION['user_id']){
            $customer = $ctminfo;
            break;
        }
    }
    
    $sql = "select * from coupon, cp_user 
            WHERE coupon.id_cp = cp_user.cp_id
            AND cp_user.user_id = '$customer[id]'";
    $user_coupon = executeResult($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="ctm.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">        
    </head>
    <body>
        <header>
                <ul class="top-bar">
                    <img src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" style="float: left;" alt="">
                    <li><a href="homepage.php">Trang chủ</a></li>
                    <li><a href="homepage.php">Thực đơn</a></li>
                    <li><a href="homepage.php">Liên hệ</a></li>
                    <li><a href="../../cart/cart.php"><span>GIỎ HÀNG</span><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                    <li class="dropdown">
                        <a href="ctm.php" class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i></a>
                        <form class="dropdown-content" action="" method="POST">
                            <?php
                            echo '<a href="ctm.php">'.$customer['username'].'</a>'; ?>
                            <input type="text" name="logout" id="logout" value="logout" style="display: none;">
                            <button class="out" type="submit"><span>Logout <i class="fas fa-sign-out-alt"></i></span></button> 
                        </form>
                    </li>
                </ul> 

                <?php 
                    if (isset($_POST['logout'])){
                        $_SESSION['user_id'] = 0;
                        header('location: homepage.php');
                        die();
                    }
                ?>
        </header>

        <div class="body-page">
            <div class="blank"></div>
            <div class="customer-info">

                <?php 
                    echo '
                    <div class="personal-information">
                        <h2>Thông tin khách hàng:</h2>
                        <span>USERNAME:  </span><span>'.$customer['username'].'</span><br>
                        <span>PHONENUMBER:  </span><span>'.$customer['phonenumber'].'</span><br>
                        <span>ADDRESS:  </span><span>'.$customer['address'].'</span><br>
                        <span>EMAIL:  </span><span>'.$customer['email'].'</span><br>      
                    ';
                    echo'
                    </div>';
                ?>

                <br>
                <button class="updateInfo_btn">Cập nhật thông tin</button>
                <button class="changePassword_btn">Đổi mật khẩu</button>
                <hr>
                    <?php 
                        echo '                
                        <div class="voucher-collection">
                            <h3>Voucher của bạn:</h3>
                        ';

                        foreach ($user_coupon as $item)
                        echo'
                            <a class="choose_btn">'.$item['code_cp'].'</a>
                        ';
                        echo'
                        </div> 
                        ';
                    ?>
            </div>

            <div class="history-order">
                <h1>Lịch sử đơn hàng:</h1>

                <div class="sidenav">
                    <?php 
                        $sql = "SELECT * FROM `order` where `order`.user_id = '$customer[id]'";
                        $order = executeResult($sql);
                        foreach ($order as $or){
                            echo '
                            <button class="dropdown-btn">Mã đơn: '.$or['id'].' | Thời điểm đặt: '.$or['order_time'].' | Thanh toán: '.$or['payment'].'đ 
                                <i class="fa fa-caret-down"></i>
                            </button>';
                            $sql = "SELECT * FROM `order_detail` WHERE order_id = '$or[id]'";
                            $detail = executeResult($sql);
                            echo '<div class="dropdown-container">';
                            foreach($detail as $item){
                                $product_name = $item['product_name'];
                                $price = $item['price'];
                                $quantity = $item['quantity'];
                                $size = '';
                                $plinth = '';
                                $topping_ = '';
                                if ($item['size'] != null) $size = $item['size'];
                                if ($item['plinth'] != null) $plinth = $item['plinth'];
                                if ($item['topping'] != null) $topping_ = $item['topping'];
                                echo '<span>- '.$product_name.' | Giá: '.$price.'đ | Số lượng: '.$quantity.'| Size: '.$size.' | Loại đế: '.$plinth.' | Topping: '.$topping_.'</span><br>';
                            }
                            echo '</div>';
                        }
                    ?>
                </div>
                <br><br><br><br><br><br><br>
            </div>
            <div class="blank"></div>
        </div>
        <!-- ------------------------ -->
        <div class="changePasswordScreen">
            <div class="popup_box">
            <div class="bill">
                </div>
                <div class="div">
                    <h2>Đổi mật khẩu</h2>
                    <i class="fa fa-times close_btn" aria-hidden="true"></i>
                    <br>
                    <form action="" method="POST">
                        <span>Mật khẩu hiện tại: <input type="password" name="password" value=""> </span><br>
                        <span>Mật khẩu mới: <input type="password" name="newpw" value=""></span><br>
                        <span>Xác nhận mật khẩu mới: </span><input type="password" name="cfnewpw" value=""><br>
                        <input type="submit" name="changePassword" value="Cập nhật">
                    </form>
                </div>
            </div>
        </div>

        <div class="updateInfoScreen">
            <div class="popup_box">
                <div class="bill">
                </div>
                <div class="div">
                    <h2>cập nhật thông tin</h2>
                    <i class="fa fa-times close_btn" aria-hidden="true"></i>
                    <br>
                    <form action="" method="POST">
                    <?php 
                        echo '
                        <span>Phone Number: <input type="text" name="phonenumber" value="'.$customer['phonenumber'].'"></span><br>
                        <span>Address: </span><input type="text" name="address" value="'.$customer['address'].'"><br>
                        <span>Email: </span><input type="text" name="email" value="'.$customer['email'].'"><br>
                        ';
                    ?>
                        <input type="submit" name="updateInfo" value="Cập nhật">
                    </form>
                </div>
            </div>
        </div>
        
        <?php 
            if (isset($_POST['changePassword']) && $_POST['changePassword']){
                if ($customer['password'] == $_POST['password']){
                    if ($_POST['newpw'] == $_POST['cfnewpw'] && $_POST['newpw']){
                        $newpw = $_POST['cfnewpw'];
                        execute("update user_account
                                 set password = '$newpw'
                                 where id = '$customer[id]'");
                        echo '<script type="text/javascript">alert("Đổi mật khẩu thành công");</script>';
                    }
                    else{
                        echo '<script type="text/javascript">alert("Mật khẩu mới không khớp");</script>';
                    }
                }
                else{
                    echo '<script type="text/javascript">alert("Mật khẩu không chính xác");</script>';
                }
            }

            if (isset($_POST['updateInfo']) && $_POST['updateInfo']){
                if ($_POST['address'] && $_POST['phonenumber'] && $_POST['email']){
                    $address = $_POST['address'];
                    $phonenumber = $_POST['phonenumber'];
                    $email = $_POST['email'];
                    execute("update user_account
                             set address = '$address', phonenumber = '$phonenumber', email = '$email'
                             where id = '$customer[id]'");
                    echo("<meta http-equiv='refresh' content='0.1'>");
                    echo '<script type="text/javascript">alert("Cập nhật thành công");</script>';
                }
                else{
                    echo '<script type="text/javascript">alert("Cập nhật thất bại! Nhập thiếu trường thông tin");</script>';
                }
            }
            
        ?>
        <!-- --------------voucher-------------- -->
        <?php                           
            foreach ($user_coupon as $item)
            echo'
                <div class="info">
                        <div class="popup_box">
                            <div class="bill">
                            </div>
                            <div class="div">
                                <h2>'.$item['cp_id'].'</h2>
                                <i class="fa fa-times close_btn" aria-hidden="true"></i>
                                <br>
                                <p>description</p>
                                <p>Hiệu lực: date to date</p>
                            </div>
                        </div>
                </div>
            ';
        ?>
        
        <!-- script -->
        <script text="text/javascript">

            var updateInfoView = document.querySelectorAll('.updateInfoScreen');
            var updateInfoBtn = document.querySelectorAll('.updateInfo_btn');
            var closeViewUpdateInfoBtn = document.querySelectorAll('.close_btn');

            var UIpopup = function(viewClick){
                updateInfoView[viewClick].classList.add('active');
            }

            updateInfoBtn.forEach((updateInfoBtn,i) => {
                updateInfoBtn.addEventListener("click" ,()=>{
                    UIpopup(i);
                });
            });

            closeViewUpdateInfoBtn.forEach((closeViewUpdateInfoBtn) =>{
                closeViewUpdateInfoBtn.addEventListener("click", () =>{
                    updateInfoView.forEach((updateInfoView) =>{
                        updateInfoView.classList.remove('active');
                    });
                });
            });
            var changePasswordView = document.querySelectorAll('.changePasswordScreen');
            var changePasswordBtn = document.querySelectorAll('.changePassword_btn');
            var closeViewChangePasswordBtn = document.querySelectorAll('.close_btn');

            var CPpopup = function(viewClick){
                changePasswordView[viewClick].classList.add('active');
            }

            changePasswordBtn.forEach((changePasswordBtn,i) => {
                changePasswordBtn.addEventListener("click" ,()=>{
                    CPpopup(i);
                });
            });

            closeViewChangePasswordBtn.forEach((closeViewChangePasswordBtn) =>{
                closeViewChangePasswordBtn.addEventListener("click", () =>{
                    changePasswordView.forEach((changePasswordView) =>{
                        changePasswordView.classList.remove('active');
                    });
                });
            });

                        // detail voucher
                        var infoView = document.querySelectorAll('.info');
                        var chooseBtn = document.querySelectorAll('.choose_btn');
                        var closeViewInfoBtn = document.querySelectorAll('.close_btn');
            
                        var popup = function(viewClick){
                            infoView[viewClick].classList.add('active');
                        }
            
                        chooseBtn.forEach((chooseBtn,i) => {
                            chooseBtn.addEventListener("click" ,()=>{
                                popup(i);
                            });
                        });
            
                        closeViewInfoBtn.forEach((closeViewInfoBtn) =>{
                            closeViewInfoBtn.addEventListener("click", () =>{
                                infoView.forEach((infoView) =>{
                                    infoView.classList.remove('active');
                                });
                            });
                        });
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>

    </body>
</html> 