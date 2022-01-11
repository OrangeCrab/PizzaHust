<?php
session_start();
#Kết nối csdl
include("config.php");
require_once('../database/dbhelper.php');
$baseUrl = '../';
$con = mysqli_connect("localhost", "root", "", "quan_ly_cua_hang_pizza_hust");

#Lưu tên khách hàng
$sql = "select * from user_account";
$user_info = executeResult($sql);
$customer = '';
if (isset($_SESSION['user_id']))
foreach ($user_info as $user){
    if ($user['id'] == $_SESSION['user_id'])
    $customer = $user['username'];
}
#Biến $_SESSION['giam_gia'] để số tiền được giảm khi áp voucher
if( !isset($_SESSION['giam_gia'])) $_SESSION['giam_gia'] = 0;
#Xoá sản phẩm trong giỏ hàng( Pizza)
if (isset($_GET['delid']) && ($_GET['delid'] >= 0)) {
    array_splice($_SESSION['giohang'], $_GET['delid'], 1);
}
// var_dump($_SESSION['giohang']);

#Sửa sản phẩm trong giỏ hàng( Pizza)

if (isset($_POST['confirm_orther_product']) && ($_POST['confirm_orther_product'])) {
    $temp = $_POST['stt'];
    $_SESSION['giohang'][$temp][3] = $_POST['quantity'];
} elseif (isset($_POST['confirm']) && ($_POST['confirm'])) {
    $temp = $_POST['stt'];
    $_SESSION['giohang'][$temp][0] = $_POST['size'];
    $_SESSION['giohang'][$temp][1] = $_POST['de'];
    if($_POST['size'] =="S"){
        $_SESSION['giohang'][$temp][7]=$_SESSION['giohang'][$temp][8]/1000;
    } elseif($_POST['size'] =="M"){
        $_SESSION['giohang'][$temp][7]=$_SESSION['giohang'][$temp][9]/1000;
    } elseif ($_POST['size'] =="L"){
        $_SESSION['giohang'][$temp][7]=$_SESSION['giohang'][$temp][10]/1000;
    }
    if(isset($_POST['topping'])){
        $_SESSION['giohang'][$temp][2] = $_POST['topping'];
    } else $_SESSION['giohang'][$temp][2] = null;
    $_SESSION['giohang'][$temp][3] = $_POST['quantity'];
}


# Tiến hành thanh toán, lưu đơn hàng vào bảng Order , order_detail
if (isset($_POST['thanhtoan'])) {
    $name = $_POST['name'];
    $sdt = $_POST['sdt'];
    $quanhuyen = $_POST['quanhuyen'];
    $diachi = $_POST['diachi'];
    $ghichu = $_POST['ghichu'];
    if($_SESSION['user_id'] != 0){
        $sql_giohang = mysqli_query($con, "insert into `order`(fullname, phonenumber, address,note,order_time,status, user_id) values('$name','$sdt','$diachi $quanhuyen','$ghichu',CURRENT_TIMESTAMP,N'Chờ xác nhận','{$_SESSION['user_id']}')");
    }else{
        $sql_giohang = mysqli_query($con, "insert into `order`(fullname, phonenumber, address,note,order_time,status) values('$name','$sdt','$diachi $quanhuyen','$ghichu',CURRENT_TIMESTAMP,N'Chờ xác nhận')");
    }
    $get_order = mysqli_query($con, "select max(id) from `order`");
    $res = mysqli_fetch_array($get_order);
    $get_order_id = (int)$res["max(id)"];
    $thanhtoan = 0;
    $giamgia = 0;
    if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
        $total = 0;
        for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
            $gia_topping = 0;
            $price = 0;
            $fulltopping = "";
            if($_SESSION['giohang'][$i][2] == null) {
                $fulltopping = "Không có";
                $gia_topping = 0;
            }else
            for ($j=0; $j < sizeof($_SESSION['giohang'][$i][2]) ; $j++) { 
                $fulltopping =$fulltopping.$_SESSION['giohang'][$i][2][$j]." ";
                $con = mysqli_connect("localhost", "root", "", "quan_ly_cua_hang_pizza_hust");
                $get_price = mysqli_query($con, "select price_free_size from `product` where name = '{$_SESSION['giohang'][$i][2][$j]}'");
                $res = mysqli_fetch_array($get_price);
                $get_topping_price = (int)$res["price_free_size"];
                $gia_topping+= $get_topping_price/1000;
            };
            $giatien = $_SESSION['giohang'][$i][7];
            if ($_SESSION['giohang'][$i][6] == 1) {
                $total += $_SESSION['giohang'][$i][3] * ($giatien + $gia_topping);
                $price = ($giatien + $gia_topping) * 1000;
            } else {
                $total += $_SESSION['giohang'][$i][3] *  $giatien;
                $price =  $giatien * 1000;
            }
            $total += $gia_topping;
            $thanhtoan = ($total + 22 - $_SESSION['giam_gia']) * 1000;
            $num = (int)$_SESSION['giohang'][$i][3];
            $get_id = mysqli_query($con, "select id from `product` where name = N'{$_SESSION['giohang'][$i][4]}' ");
            $res = mysqli_fetch_array($get_id);
            $get_product_id = (int)$res["id"];

           
            $sql_donhang = mysqli_query($con, "insert into `order_detail`(order_id, price, quatity,size,plinth, topping, product_name) values($get_order_id,$price,$num,'{$_SESSION['giohang'][$i][0]}','{$_SESSION['giohang'][$i][1]}','$fulltopping','{$_SESSION['giohang'][$i][4]}')");
        }
        // var_dump("insert into `order`(fullname, phonenumber, address,note,order_time,status, user_id) values('$name','$sdt','$diachi $quanhuyen','$ghichu',CURRENT_TIMESTAMP,N'Chờ xác nhận','{$_SESSION['user_id']}')");
    }
    $sql_giohang = mysqli_query($con, "update `order` set payment = $thanhtoan where id = $get_order_id");
    if($_SESSION['giam_gia'] !=0) {
        $coupon = $_SESSION['giam_gia'] * 1000;
        $sql_giohang = mysqli_query($con, "update `order` set coupon = $coupon where id = $get_order_id");
    }
    unset($_SESSION['giohang']);
    header('location: ../ShowForGuest/homepage/homepage.php');
    // $get_order_id = mysqli_query($con,"SELECT `id` FROM `order` where `fullname` ='$name' and `payment`");

}
#Hiển thị giỏ hàng
function showgiohang()
{
    if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
        if (!sizeof($_SESSION['giohang']))
            echo '
                <div class="null">
                    Bạn chưa có sản phẩm nào trong giỏ hàng!!
                </div>
            ';
        for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
            $total = 0;
            $full_topping =0;
            $alert = "'Bạn chắc chắn muốn xoá mặt hàng này?'";
            $price = (int)$_SESSION['giohang'][$i][7];
            $fulltopping = "";
            if($_SESSION['giohang'][$i][2] == null) {
                $fulltopping = "Không có";
            }else
            for ($j=0; $j < sizeof($_SESSION['giohang'][$i][2]) ; $j++) { 
                $fulltopping =$fulltopping.$_SESSION['giohang'][$i][2][$j]." ";
                $con = mysqli_connect("localhost", "root", "", "quan_ly_cua_hang_pizza_hust");
                $get_price = mysqli_query($con, "select price_free_size from `product` where name = '{$_SESSION['giohang'][$i][2][$j]}'");
                $res = mysqli_fetch_array($get_price);
                $get_topping_price = (int)$res["price_free_size"];
                $full_topping+= $get_topping_price/1000;
            };
            $total = ($price + $full_topping) * $_SESSION['giohang'][$i][3];
            if ($_SESSION['giohang'][$i][6] == 2)
                echo '
                    <div class="product">
                    <div class="img">
                        <img src="../masterial/image/thuc_don/' . $_SESSION['giohang'][$i][5] . '" alt="">
                    </div>
                    <div class="info">
                        <p class="field">' . $_SESSION['giohang'][$i][4] . '</p>
                        <div><span class="field">Size: </span><span class="size">' . $_SESSION['giohang'][$i][0] . '</span><span class="price">' . $_SESSION['giohang'][$i][7] . ' 000đ</span></div>
                        <div><span class="field">Loại đế: </span><span>' . $_SESSION['giohang'][$i][1] . '</span></div>
                        <div><span class="field">Topping: </span><span class="topping">'.$fulltopping.'</span><span class="price">'.$full_topping.' 000đ</span></div>
                    </div>
                    <div class="quantity">
                        <div class="">
                            <div><span class="field"><b> Số lượng:</b> </span></div>
                            <div class="noidung" style="margin: auto;">' . $_SESSION['giohang'][$i][3] . ' cái</div>
                        </div>
                    
                        <div class="tong" style="margin-top: 27px;">
                            
                            <div><span class="field"><b> Tổng:</b> </span></div>
                            <div class="price">
                                ' . $total . ' 000đ
                            </div>
                        </div>
                    </div>
                    <div class="bo_sung">
                        <div class="change">
                            <a href="change_product.php?fixid=' . $i . '"><button class="choose_btn">Sửa</button></a>        
                        </div>
                        <div class="delete">
                            <a href="cart.php?delid=' . $i . '" onclick="return confirm(' . $alert . ');"><button class="choose_btn1" >Xoá</button></a>
                        </div>
                    </div class = "null">
                    </div>
                    ';
            else {
                echo '
                    <div class="product">
                    <div class="img">
                        <img src="../masterial/image/thuc_don/' . $_SESSION['giohang'][$i][5] . '" alt="">
                    </div>
                    <div class="info">
                        <p class="field">' . $_SESSION['giohang'][$i][4] . '</p>
                        <div><span class="field">Giá: </span><span class="price">' . $_SESSION['giohang'][$i][7] . ' 000đ</span></div>
                        
                    </div>
                    <div class="quantity">
                        <div class="">
                            <div><span class="field"><b> Số lượng:</b> </span></div>
                            <div class="noidung" style="margin: auto;">' . $_SESSION['giohang'][$i][3] . '</div>
                        </div>
                    
                        <div class="tong" style="margin-top: 27px;">
                            
                            <div><span class="field"><b> Tổng:</b> </span></div>
                            <div class="price">
                                ' . $total . ' 000đ
                            </div>
                        </div>
                    </div>
                    <div class="bo_sung">
                        <div class="change">
                            <a href="change_product.php?fixid=' . $i . '"><button class="choose_btn">Sửa</button></a>        
                        </div>
                        <div class="delete">
                            <a href="cart.php?delid=' . $i . '" onclick="return confirm(' . $alert . ');"><button class="choose_btn1" >Xoá</button></a>
                        </div>
                    </div class = "null">
                    </div>
                    ';
            }
        }
    } else {
        echo '
                <div class="null">
                    Bạn chưa có sản phẩm nào trong giỏ hàng!!
                </div>
            ';
    }
}

$thanhtoan = 0;
function tinhtien()
{
    $code_voucher = "Mã voucher";

    $giamgia = 0;
    if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang'])) && sizeof($_SESSION['giohang']) > 0) {
        $total = 0;
        for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
            $gia_topping = 0;
            if($_SESSION['giohang'][$i][2] == null) {
                $gia_topping = 0;
            }else
            for ($j=0; $j < sizeof($_SESSION['giohang'][$i][2]) ; $j++) { 
                $con = mysqli_connect("localhost", "root", "", "quan_ly_cua_hang_pizza_hust");
                $get_price = mysqli_query($con, "select price_free_size from `product` where name = '{$_SESSION['giohang'][$i][2][$j]}'");
                $res = mysqli_fetch_array($get_price);
                $get_topping_price = (int)$res["price_free_size"];
                $gia_topping += $get_topping_price/1000;
            };
            $giatien =  $_SESSION['giohang'][$i][7];
            if ($_SESSION['giohang'][$i][6] == 1) {
                $total += $_SESSION['giohang'][$i][3] * ($giatien + $gia_topping);
            } else   $total += $_SESSION['giohang'][$i][3] *  $giatien;
            $total += $gia_topping;
            $thanhtoan = $total + 22;
        }
        
        $type = 2;
        $phan_tram = 0;
        $toi_da = 0;
        if (isset($_POST['apdung'])) {
            if(isset($_POST['apvoucher'])){
                $code_voucher = $_POST['apvoucher'];
    
                $con = mysqli_connect("localhost", "root", "", "quan_ly_cua_hang_pizza_hust");
                $get_price = mysqli_query($con, "SELECT * from coupon where code_cp = '$code_voucher'");
                $res = mysqli_fetch_array($get_price);
                
                if((int)$res["type_cp"] ==1 ){
                    $giamgia = (int)$res["max__order_amount"]/1000;
                    $type = 1;
                }
                if((int)$res["type_cp"] ==0 ){
                    if($thanhtoan * (int)$res["value_cp"] /100 > (int)$res["max__order_amount"]/1000){
                        $giamgia =(int)$res["max__order_amount"]/1000;
                    }
                    else $giamgia = (int)($thanhtoan * $res["value_cp"] /100);
                    $phan_tram = (int)$res["value_cp"];
                    $type = 0;
                    $toi_da = (int)$res["max__order_amount"]/1000;
                }
                
            }
            $thanhtoan -= $giamgia;
            $_SESSION['giam_gia']= $giamgia; 
        }
        // var_dump($thanhtoan);
        echo '
            <div class="pay">
                <div class="field"><span>Tổng:</span><span class="price">' . $total . ' 000đ</span></div>
                <div class="field"><span>Phí giao hàng:</span><span class="price">22 000đ</span></div>
                ';
                // if($type ==2){}
                // echo'
                // <div class="field"><span>Giảm giá :</span><span class="price">-' . $giamgia . ' 000đ</span></div>
                // ';
                if($type ==2){
                    echo'
                    <div class="field"><span>Giảm giá :</span><span class="price">0đ</span></div>
                    ';
                }
                if($type ==1){
                    echo'
                    <div class="field"><span>Giảm giá :</span><span class="price">-' . $giamgia . ' 000đ</span></div>
                    ';
                }
                if($type ==0){
                    echo'
                    <div class="field"><span>Giảm giá '.$phan_tram.'% (Tối đa '.$toi_da.'k):</span><span class="price"> -' . $giamgia . ' 000đ</span></div>
                    ';
                }
                echo'
                <div class="form__row">
                <form class="" action="cart.php" method="post">
                    <label class="form__label" for="name"> <b>Voucher:</b></label>
                    <select name="apvoucher" id="">
                        <option value="'.$code_voucher.'">   '.$code_voucher.'   </option>
                    ';
                    $sql = "SELECT coupon.* from coupon,cp_user where coupon.id_cp = cp_user.cp_id and cp_user.user_id = '{$_SESSION['user_id']}'";
                    $voucher = executeResult($sql);
                    foreach($voucher as $item){
                        if($total*1000 >= (int)$item['min_order_value'] && $item['code_cp'] != $code_voucher){
                            echo'
                                <option value="'.$item['code_cp'].'">'.$item['code_cp'].'</option>
                            ';
                        }
                    }
                echo'
                    </select>
                    <div class="apdung"><input type="submit"  value="Áp dụng" name="apdung"></div>
                </form>
            </div>

            
                <hr>
                <!-- <div class="buy"><a href="#">Đặt hàng: <span>478 000đ</span></a></div> -->
                <div >
                    <div class="field"><span>Thanh toán:</span><span class="price">' . $thanhtoan . ' 000đ</span></div>
                    <input type="submit" onclick=" return send()" class="buy" value="Đặt hàng" name="thanhtoan">
                </div>
        
            </div>
                ';
    } else {
        echo '
            <div class="pay">
                <div class="field"><span>Tổng:</span><span class="price">0đ</span></div>
                <div class="field"><span>Phí giao hàng:</span><span class="price">0đ</span></div>
                <div class="field"><span>Giảm giá 0%:</span><span class="price">0đ</span></div>
            
                <hr>
                <div >
                    <div class="field"><span>Thanh toán:</span><span class="price">0đ</span></div>
                    <input onclick="send()" class="buy" value="Đặt hàng" name="thanhtoan">
                </div>
        
            </div>
            
                ';
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <script src="cart.js"></script>
    <meta charset="UTF-8">
    <title>PizzaHust</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>

<body>
    <header>
        <?php
            echo'
            <ul class="top-bar">
                <img src="../masterial/image/iconHomePage/PizzaHustLogo.svg" style="float: left;" alt="">
                <li><a href="../ShowForGuest/homepage/homepage.php">Trang chủ</a></li>
                <li><a href="../ShowForGuest/homepage/homepage.php">Thực đơn</a></li>
                <li><a href="../ShowForGuest/homepage/homepage.php">Liên hệ</a></li>
                <li><a href=""><span>GIỎ HÀNG</span><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                ';

                if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != 0){
                echo '
                
                <li class="dropdown">
                    <a style="color: #F98607;" href="ctm.php" class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i></a>
                    <form class="dropdown-content" action="" method="POST">
                        <a href="../ShowForGuest/homepage/ctm.php">'.$customer.'</a>
                        <input type="text" name="logout" id="logout" value="logout" style="display: none;">
                        <button type="submit"><span>Logout <i class="fas fa-sign-out-alt"></i></span></button> 
                    </form>
                </li>
                ';
                }
                else
                echo '
                    <li class="dropdown">
                        <a class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i></a>
                        <form class="dropdown-content" action="" method="POST">
                            <a href="../ShowForGuest/homepage/ctm.php">Khách hàng</a>
                            <a href="../AdminSystem/login_form.php">Chủ quán</a>
                        </form>
                    </li>
                </ul>
                ';
            echo'
            </ul>
            ';
            if (isset($_POST['logout'])){
                $_SESSION['user_id'] = 0;
                echo("<meta http-equiv='refresh' content='0'>");
            }
        ?>   
    </header>
    <div class="cart">
        <div class="blank"></div>
        <h2><u><i>Giỏ hàng của bạn: </i></u></h2>
        <div class="guess_cart">
            <?php showgiohang(); ?>
        </div>

        <div class="suggest">
            <h3 style="font-size: 15px;">Có thể bạn sẽ thích</h3>
            <div class="suggest-product">
                <a href="../ShowForGuest/homepage/homepage.php#1">
                    <img src="../masterial/image/thuc_don/coca.png" alt="">
                </a>
                <a href="../ShowForGuest/homepage/homepage.php#1">
                    <img src="../masterial/image/thuc_don/nuoc_cam.png" alt="">
                </a>
                <a href="../ShowForGuest/homepage/homepage.php#1">
                    <img src="../masterial/image/thuc_don/mi_y.jpg" alt="">
                </a>
                <a href="../ShowForGuest/homepage/homepage.php#1">
                    <img src="../masterial/image/thuc_don/bbq.jpg" alt="">
                </a>
                <a href="../ShowForGuest/homepage/homepage.php#1">
                    <img style="height: 60px;" src="../masterial/image/thuc_don/ga_BBQ.jpg" alt="">
                </a>
            </div>
        </div>
        <form action="" class="form" method="post">
            <div class="info_pay">

                <div class="guess_info">
                    <div class="form__row">
                        <label class="form__label" for="name"><b>Tên: </b></label>
                        <input class="form__input" type="text" id="name" name="name">
                    </div>
                    <div class="form__row">
                        <label class="form__label" for="name"><b>Sđt: </b></label>
                        <input class="form__input" type="text" id="sdt" name="sdt">
                    </div>
                    <div class="form__row">
                        <label class="form__label" for="name"> <b>Quận/huyện:</b></label>
                        <select name="quanhuyen" id="quan_huyen">
                            <option value="Nhận tại quán"> Nhận tại quán </option>
                            <option value="Quận Ba Đình">Quận Ba Đình</option>
                            <option value="Quận Bắc Từ Liêm">Quận Bắc Từ Liêm</option>
                            <option value="Quận Cầu Giấy">Quận Cầu Giấy</option>
                            <option value="Quận Đống Đa">Quận Đống Đa</option>
                            <option value="Quận Hà Đông">Quận Hà Đông</option>
                            <option value="Quận Hai Bà Trưng">Quận Hai Bà Trưng</option>
                            <option value="Quận Hoàn Kiếm">Quận Hoàn Kiếm</option>
                            <option value="	Quận Hoàng Mai">Quận Hoàng Mai</option>
                            <option value="Quận Long Biên">Quận Long Biên</option>
                            <option value="Quận Nam Từ Liêm">Quận Nam Từ Liêm</option>
                            <option value="Quận Tây Hồ">Quận Tây Hồ</option>
                            <option value="Quận Thanh Xuân">Quận Thanh Xuân</option>

                        </select>
                    </div>
                    <div class="form__row">
                        <label class="form__label" for="name"><b>Địa chỉ:</b></label>
                        <input class="form__input" id="diachi" type="text" name="diachi">
                    </div>
                    <div class="form__row">
                        <label class="form__label" for="name"><b>Ghi chú:</b></label>
                        <input class="form__input" type="text" name="ghichu">
                        <input type="text" style="display: none;" name="gia" id ="thanhtoan" value="<?php $size = sizeof($_SESSION['giohang']);echo ''.$size.''; ?>">
                    </div>
        </form>
    </div>
    <?php tinhtien(); ?>
    </div>
    </form>
    </div>
    
</body>

</html>
