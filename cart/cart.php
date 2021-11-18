
<?php
    session_start();
    include("config.php");
    $con = mysqli_connect("localhost","root","","quan_ly_cua_hang_pizza_hust");
    if( !isset($_SESSION['giohang'])) $_session['giohang']=[];
    if(isset($_POST['addcart']) &&($_POST['addcart'])){
       $size=$_POST['size'];
       $de=$_POST['de'];
       $topping=$_POST['topping'];
       $quantity=$_POST['quantity'];
    // $gia=$_POST['gia'];
       $sp=[$size,$de,$topping,$quantity];
       $_SESSION['giohang'][]=$sp;
    //    var_dump($_SESSION['giohang']);

   }elseif(isset($_POST['thanhtoan'])){
       $thanhtoan=0;
        if(isset($_SESSION['giohang'])&&(is_array($_SESSION['giohang']))){
        $total = 0;
            for($i= 0; $i < sizeof($_SESSION['giohang']); $i++){
                $gia_topping = 0;
                if ( $_SESSION['giohang'][$i][2] != null) $gia_topping=1; //nếu đặt thêm topping $gia_topping = 1
                if ($_SESSION['giohang'][$i][0] =='S') {
                    $giatien =99;
                } elseif($_SESSION['giohang'][$i][0] =='M') {
                    $giatien = 109;
                } elseif($_SESSION['giohang'][$i][0] =='L'){
                $giatien = 119;
                }
                $total +=$_SESSION['giohang'][$i][3] * ( $giatien + 9 * $gia_topping);
                $giamgia = (int)($total * 0.05);
                $thanhtoan = ($total + 22 - $giamgia) *1000;  
                $num = $_SESSION['giohang'][$i][3];
                $price = ( $giatien + 9 * $gia_topping) *1000;
                $total_money = $num * $price;
                $sql_donhang = mysqli_query($con,"insert into `order_detail`(price, num,total_money) values($price,$num,$total_money)");
            } 
        }
        $name = $_POST['name'];
        $sdt = $_POST['sdt'];
        $quanhuyen = $_POST['quanhuyen'];
        $diachi = $_POST['diachi'];

        $sql_giohang = mysqli_query($con,"insert into `order`(fullname, phone_number, address,total_money) values('$name','$sdt','$diachi $quanhuyen','$thanhtoan')");
        // var_dump($name);

   }
   function tinhtien(){
    if(isset($_SESSION['giohang'])&&(is_array($_SESSION['giohang']))){
        $total = 0;
        for($i= 0; $i < sizeof($_SESSION['giohang']); $i++){
            $gia_topping = 0;
            if ( $_SESSION['giohang'][$i][2] != null) $gia_topping=1; //nếu đặt thêm topping $gia_topping = 1
            if ($_SESSION['giohang'][$i][0] =='S') {
                $giatien =99;
            } elseif($_SESSION['giohang'][$i][0] =='M') {
                 $giatien = 109;
            } elseif($_SESSION['giohang'][$i][0] =='L'){
             $giatien = 119;
            }
            $total +=$_SESSION['giohang'][$i][3] * ( $giatien + 9 * $gia_topping);
            $giamgia = (int)($total * 0.05);
            $thanhtoan = $total + 22 - $giamgia;
            
            
            
        }
        echo'
        <div class="pay">
            <div class="field"><span>Tổng:</span><span class="price">'.$total.' 000đ</span></div>
            <div class="field"><span>Phí giao hàng:</span><span class="price">22 000đ</span></div>
            <div class="field"><span>Giảm giá 5%:</span><span class="price">'.$giamgia.' 000đ</span></div>
        
            <hr>
            <!-- <div class="buy"><a href="#">Đặt hàng: <span>478 000đ</span></a></div> -->
            <div >
                <div class="field"><span>Thanh toán:</span><span class="price">'.$thanhtoan.' 000đ</span></div>
                <input type="submit" class="buy" value="Đặt hàng" name="thanhtoan">
            </div>
       
        </div>
            ';        
        // $total1 = (int)($total / 1000);
        // $total2 = $total % 1000;
        // if ($total < 1000) {
        //     echo'
        //     '.$total.'
        //     ';
        // } else {
        //     echo''.$total1.' '.$total2.'';
        // }
        
        
    }
   }
   function showgiohang(){
       if(isset($_SESSION['giohang'])&&(is_array($_SESSION['giohang']))){
           for($i= 0; $i < sizeof($_SESSION['giohang']); $i++){
               if ($_SESSION['giohang'][$i][0] =='S') {
                   $giatien = '99 000đ';
               } elseif($_SESSION['giohang'][$i][0] =='M') {
                    $giatien = '109 000đ';
               } elseif($_SESSION['giohang'][$i][0] =='L'){
                $giatien = '119 000đ';
               }
               
                echo'
                <div class="product">
                <div class="img">
                    <img src="../masterial/image/thuc_don/thap_cam.jpg" alt="">
                </div>
                <div class="info">
                    <p class="field">Pizza thập cẩm</p>
                    <div><span class="field">Size: </span><span class="size">'.$_SESSION['giohang'][$i][0].'</span><span class="price">'.$giatien.'</span></div>
                    <div><span class="field">Loại đế: </span><span>'.$_SESSION['giohang'][$i][1].'</span></div>
                    <div><span class="field">Topping: </span><span class="topping">'.$_SESSION['giohang'][$i][2].'</span><span class="price">9 000đ</span></div>
                </div>
                <div class="so_luong">
                    <div style="margin: top 0px;">Số lượng</div>
                    <div class="noidung" style="margin: auto;">'.$_SESSION['giohang'][$i][3].' cái</div>
                </div>
               
            </div>
                ';
                 // <div class="delete">
                //     xoá
                // </div>
           }
       }
   }




?>
<!DOCTYPE html>
<html>
    <head>
        <title>PizzaHust</title>
        <link rel="stylesheet" href="cart.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <style>
            .so_luong{
            padding-left: 4%;
            margin-top: 0px;
            margin-right: 10px;
            }
            .noidung{
            height: 50px;
            text-align: center;
            }
        </style>
    </head>

    <body>
        <header>
                <ul class="top_bar">
                    <li><a href="../AdminSystem/login.html" class="login"><i class="fa fa-user" aria-hidden="true"></i></a></li>    
                    <li><a href="../homepage/homepageDraft.html">LIÊN HỆ</a></li>
                    <li><a href="#" class="active"><span>GIỎ HÀNG</span><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                    <li><a href="../homepage/homepageDraft.html">THỰC ĐƠN</a></li>
                    <li><a href="../homepage/homepageDraft.html" target="_self">TRANG CHỦ</a></li>
                </ul>
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
                   <a href="..\homepage\homepageDraft.html">
                        <img src="../masterial/image/thuc_don/coca.png" alt="">
                    </a>
                   <a href="..\homepage\homepageDraft.html">
                        <img src="../masterial/image/thuc_don/nuoc_cam.png" alt="">
                    </a>
                   <a href="..\homepage\homepageDraft.html">
                        <img src="../masterial/image/thuc_don/mi_y.jpg" alt="">
                    </a>
                   <a href="..\homepage\homepageDraft.html">
                        <img src="../masterial/image/thuc_don/khoai_tay_chien.webp" alt="">
                    </a>
                   <a href="..\homepage\homepageDraft.html">
                        <img style ="height: 60px;"src="../masterial/image/thuc_don/ga_BBQ.jpg" alt="">
                    </a>
                </div>
            </div>
            <form action="" class="form" method="post">
            <div class="info_pay">
           
                <div class="guess_info">
                        <div class="form__row">
                            <label class="form__label" for="name"><b>Tên: </b></label>
                            <input class="form__input" type="text" name="name">
                        </div>
                        <div class="form__row">
                            <label class="form__label" for="name"><b>Sđt: </b></label>
                            <input class="form__input" type="text" name="sdt">
                        </div>
                        <div class="form__row">
                            <label class="form__label" for="name"> <b>Quận/huyện:</b></label>
                            <select name="quanhuyen" id="">
                                <option value="Nhận tại quán">   Nhận tại quán   </option>
                                <option value="Quận Ba Đình">Quận Ba Đình</option>
                                <option value="Quận Bắc Từ Liêm">Quận Bắc Từ Liêm</option>
                                <option value="Quận Cầu Giấy">Quận Cầu Giấy</option>
                                <option value="Quận Đống Đa">Quận Đống Đa</option>
                                <option value="Quận Hà Đông">Quận Hà Đông</option>
                                <option value="Quận Hai Bà Trưng">Quận Hai Bà Trưng</option>
                                <option value="Quận Hoàn Kiếm">Quận Hoàn Kiếm</option>
                                <option value="	Quận Hoàng Mai">Quận Hoàng Mai</option>
                                <option value="Quận Long Biên">Quận Long Biên</option>
                                <option value="Quận Nam Từ Liêmy">Quận Nam Từ Liêm</option>
                                <option value="Quận Tây Hồ">Quận Tây Hồ</option>
                                <option value="Quận Thanh Xuân">Quận Thanh Xuân</option>

                            </select>
                        </div>
                        <div class="form__row">
                            <label class="form__label" for="name"><b>Địa chỉ:</b></label>
                            <input class="form__input" type="text" name="diachi">
                        </div>
                    </form>
                </div>
                <?php tinhtien(); ?>  
            </div>
            </form>
        </div>
    </body>
</html> 