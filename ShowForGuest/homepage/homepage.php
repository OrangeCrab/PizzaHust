<?php
    session_start();
    if( !isset($_SESSION['user_id'])) $_SESSION['user_id'] = 0;
    
    if(isset( $_SESSION['counter'] )){
        // Đếm mỗi lần truy cập
        $_SESSION['counter'] += 1;
    }
    else{
        // Lần đầu truy cập
        $_SESSION['counter'] = 1;
    }

    if(!isset($_SESSION['giohang'])) $_SESSION['giohang'] = [];
    require_once('../../database/dbhelper.php');
	$baseUrl = '../../';
    // chay cau lenh sql để lấy tên loại sản phẩm sử dụng lệnh join bảng
	$sql = "select product.*, category.title as category_name from product left join category on product.category_id = category.id";
	$data = executeResult($sql);
    $sql = "select * from coupon";
	$coupon = executeResult($sql);
    $sql = "select * from category";
    $category = executeResult($sql);
    $sql = "select * from plinth";
    $plinth = executeResult($sql);

    $sql = "select * from user_account";
    $user_info = executeResult($sql);
    $customer = '';  // Ten khach hang

    if (isset($_SESSION['user_id']))
        foreach ($user_info as $user){
            if ($user['id'] == $_SESSION['user_id'])
            $customer = $user['username'];
        }

    # Mỗi lần them sản phẩm vào giỏ hàng,  $_SESSION['giohang'] sẽ thêm một mảng các thuộc
    # tính của sản phẩm mình đang chọn vào biến đó (bảng product chưa hoàn thiện về giá nên cho giá mặc định nên không có biến $price)
    # sẽ thêm biến $price khi người dùng chọn s m l khác (lúc này lại phải truy cập sql để biết được giá)
    if(isset($_POST['addcart']) &&($_POST['addcart'])){
        $size=(string)$_POST['size']; //$_SESSION['giohang'][$i][0]
        $de=$_POST['de'];   //$_SESSION['giohang'][$i][1]
        //$_SESSION['giohang'][$i][2]
       if(isset($_POST['topping'])){
        $topping=$_POST['topping'];
       }else $topping =null;
        $quantity=$_POST['quantity'];//$_SESSION['giohang'][$i][3]
        $name=$_POST['name'];//$_SESSION['giohang'][$i][4]
        $image=$_POST['image'];//$_SESSION['giohang'][$i][5]
        $loai = $_POST['category'];//$_SESSION['giohang'][$i][6]
        $price= 0;//$_SESSION['giohang'][$i][7]
        $gia_s = $_POST['gia_s'];//$_SESSION['giohang'][$i][8]
        $gia_m = $_POST['gia_m'];//$_SESSION['giohang'][$i][9]
        $gia_l = $_POST['gia_l'];//$_SESSION['giohang'][$i][10]
        if($size == "S"){
            $price = $gia_s/1000;
        }elseif($size == "M"){
            $price = $gia_m/1000;
        }elseif($size == "L"){
            $price = $gia_l/1000;
        };
        $price_topping = 0;

        #Kiểm tra sản phẩm vừa đặt có trong giỏ hàng không
        $check = 0;
        for($i= 0; $i < sizeof($_SESSION['giohang']); $i++){
            if( ($name == $_SESSION['giohang'][$i][4])  && ($size == $_SESSION['giohang'][$i][0]) && ($de == $_SESSION['giohang'][$i][1]) && ($topping == $_SESSION['giohang'][$i][2]) ){
                $_SESSION['giohang'][$i][3] += $quantity;
                $check = 1;
                break;
            }
        }
        $sp=[$size,$de,$topping,$quantity,$name,$image,$loai,$price,$gia_s,$gia_m,$gia_l];
        if($check == 0) {
            $_SESSION['giohang'][]=$sp;
        }
    }
    if(isset($_POST['addcart1']) &&($_POST['addcart1'])){
        $quantity=$_POST['quantity'];
        $name=$_POST['name'];
        $image=$_POST['image'];
        $loai = $_POST['category'];
        $price = $_POST['gia'] /1000;
        
        #Kiểm tra sản phẩm vừa đặt có trong giỏ hàng không
        $check = 0;
        for($i= 0; $i < sizeof($_SESSION['giohang']); $i++){
            if( ($name == $_SESSION['giohang'][$i][4])){
                $_SESSION['giohang'][$i][3] += $quantity;
                $check = 1;
                break;
            }
        }
        $sp=[null,null,null,$quantity,$name,$image,$loai,$price];
        if($check == 0) {
            $_SESSION['giohang'][]=$sp;
        }
    }

    function popup(){
        if($_SESSION['counter'] == 1)
        echo'
        <div class="popup_screen">
            <div class="popup_box">
                <img src="../../masterial/image/bgrhomepage/popup.svg" alt="">
                <div>
                    <i class="fa fa-times close_btn" aria-hidden="true"></i>
                    <h2>PizzaHust xin chào</h2>
                    <br>
                    <p>Quý khách hàng thân mến, PizzaHust chỉ ship được đồ ăn trong nội thành Hà Nội thôi ạ, quý khách hàng thông cảm giúp PizzaHust nha!!!</p>
                </div>
            </div>
        </div>
        ';
    };
    $numCate = 7;
    $sql = "select product.* from product";
    $product = executeResult($sql);
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="homepage.css">
    <link rel="shortcut icon" href="../../masterial/image/iconHomePage/pieceOfPizzaLogo.svg">
    <title>PizzaHust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
<!--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>

<body>
    <header>        
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn"><i class="fas fa-bars"></i></label>            
        <img src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" class="top-logo" style="float: left;" alt="">
        <?php
            echo'
            <ul class="top-bar">
                <li><a href="#launcher">Trang chủ</a></li>
                <li><a href="#menu">Thực đơn</a></li>
                <li><a href="#contact">Liên hệ</a></li>
                <li><a href="../../cart/cart.php"><span>GIỎ HÀNG</span><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                ';
                if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != 0){
                echo '
                <li class="dropdown">
                    <a style="color: #F98607;" class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i></a>
                    <form class="dropdown-content" action="" method="POST">
                        <a href="ctm.php">'.$customer.'</a>
                        <input type="text" name="logout" id="logout" value="logout" style="display: none;">
                        <a><button class="out" type="submit"><span>Logout <i class="fas fa-sign-out-alt"></i></span></button> </a>
                    </form>
                </li>
                <li>
                    <form class="res-dropdown-content" action="" method="POST">
                        <a href="ctm.php">'.$customer.'</a>
                        <input type="text" name="logout" id="logout" value="logout" style="display: none;">
                        <a><button class="log_out" type="submit"><span>Logout <i class="fas fa-sign-out-alt"></i></span></button> </a>
                    </form>
                </li>
                ';
                }
                else
                echo '
                <li class="dropdown">
                    <a class="dropbtn"><i class="fa fa-user" aria-hidden="true"></i></a>
                    <form class="dropdown-content" action="" method="POST">
                        <a href="ctm.php">Khách hàng</a>
                        <a href="../../AdminSystem/login_form.php">Chủ quán</a>
                    </form>
                </li>
                <li>
                    <form class="res-dropdown-content" action="" method="POST">
                        <a href="ctm.php">Khách hàng</a>
                        <a href="../../AdminSystem/login_form.php">Chủ quán</a>
                    </form>
                </li>                    
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

    <div class="slider" id="launcher">
            <div class="slides">
                <!--radio buttons start-->
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">
                <!--radio buttons end-->
                <!--slide images start-->
                <div class="slide first">
                    <img src="../../masterial/image/bgrhomepage/head0.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="../../masterial/image/bgrhomepage/head1.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="../../masterial/image/bgrhomepage/head2.jpg" alt="">
                </div>
                <div class="slide">
                    <img src="../../masterial/image/bgrhomepage/head3.jpg" alt="">
                </div>
                <!--slide images end-->

            </div>
            <!--manual navigation start-->
            <div class="navigation-manual">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>
            <!--manual navigation end-->
    </div>  
        <?php popup()?>
    <!-- nhận voucher cho khách hàng có tài khoản -->
    <br>
    <div class="voucher" id="menu"> 
            <?php
                foreach($coupon as $item) {
                    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0){
                        $sql = "select cp_id, user_id from cp_user where cp_id = '$item[id_cp]' and user_id = '$_SESSION[user_id]'";
                        $cpExist = executeResult($sql);

                        echo '
                        <div class="ticket">
                            <div class="body-ticket">
                                <span class="cp-description">'.$item['description'].'</span>
                            </div>';

                            if ($cpExist != null)
                                echo'
                            <div class="stubs">
                                <input type="submit" name="gotten" id="" value="Đã Nhận">
                            </div>';
                            else echo'
                            <div class="stubs"> 
                                <form action="" method="POST">
                                    <input type="text" style="display: none;" name="cp_id" value="'.$item['id_cp'].'">
                                    <input type="submit" name="addcp" id="get'.$item['id_cp'].'" value="Nhận">
                                </form>
                            </div>';
                        echo'
                        </div>';
                    }
                    else if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0){
                        echo'
                        <div class="ticket">
                            <div class="body-ticket">
                                <span class="cp-description">'.$item['description'].'</span>
                            </div>
                            <div class="stubs">
                                <a href="../login/login_user.php" class="get">Nhận</a>
                            </div>
                        </div>';
                    } 
                }            
                
                if (isset($_POST['addcp']))
                    if ($_SESSION['user_id']){
                        $cp_id = $_POST['cp_id'];
                        $user_id = $_SESSION['user_id'];
                        execute("insert into cp_user(cp_id, user_id, used) values('$cp_id','$user_id','0')");   
                        echo '
                        <script type="text/javascript">
                            document.getElementById("get'.$cp_id.'").value = "Đã Nhận";
                            document.getElementById("get'.$cp_id.'").name = "done";
                        </script> '; 
                    }    
            ?>
    </div>

    <div class="tab-btn"> 
        <?php 
            foreach($category as $cate)
                if ($cate['id'] <= $numCate){
                    if ($cate['title'] == "Pizza")
                    echo'
                    <button class="tablink" onclick="openPage('.$cate['id'].', this)" id="defaultOpen">'.$cate['title'].'</button>';
                    else echo'<button class="tablink" onclick="openPage('.$cate['id'].', this)">'.$cate['title'].'</button>';
                }
        ?>
    </div>
        <?php 
            $dem = 0;
            foreach($product as $item){
                if ($item['category_id'] == 1)
                    $dem ++;
            }
            if ($dem > 0) 
            echo'<span><img class="click-me" src="../../masterial/image/iconHomePage/click.svg" alt=""></span>';
        ?>  
        <span class="quote">Chúc quý khách ngon miệng! - PizzaHust</span>  
    <br><br><br><br><br>
    
    <div>
        <?php 
        foreach($category as $cate)
            if ($cate['id'] <= $numCate){
                $id = $cate['id'];
                echo'
                <div id="'.$id.'" class="tabcontent">
                    <div class="category">';  
                    foreach($product as $item) {
                    if ($item['category_id'] == $id){
                        if($id == 2){
                        echo                                 
                        '<div class="product">
                            <img class="product_img" src="../../masterial/image/thuc_don/'.$item['image'].'"/>
                            <h2 class="name">'.$item['name'].'</h2>
                            <p class="description">'.$item['description'].'</p>
                            <span class="price">'.number_format($item['price_s']).' đ</span>
                            <a class="choose_btn">Chọn</a>
                        </div>
                        <form class="info_view" action="..\homepage\homepage.php#1" method="post">
                            <div class="info_card">
                                <a><i class="fa fa-times closeViewInfo_btn" aria-hidden="true"></i></a>
                                <div class="info_img"><img src="../../masterial/image/thuc_don/'.$item['image'].'"></div>
                                
                                <input type="text" style="display: none;" name="image" value="'.$item['image'].'">
                                <input type="text" style="display: none;" name="category" value="'.$item['category_id'].'">
                                <input type="text" style="display: none;" name="gia_s" value="'.$item['price_s'].'">
                                <input type="text" style="display: none;" name="gia_m" value="'.$item['price_m'].'">
                                <input type="text" style="display: none;" name="gia_l" value="'.$item['price_l'].'">
                                                
                                <div class="info">
                                    <div class="part">
                                        <h2>'.$item['name'].'</h2>
                                        <input type="text" style="display: none;" name="name" value="'.$item['name'].'">
                                        <p>'.$item['description']. '</p>
                                        <hr>
                                    </div>
                                                    
                                    <div class="part">
                                            <h3>Size</h3>
                                            <div class = "form">
                                                <input type="radio" checked = "checked" id="S" name="size" value="S">
                                                <label for="S">S</label>
                                                <span>'.number_format($item['price_s']).'đ</span>
                                                <br>
                                                <input type="radio" id="M" name="size" value="M">
                                                <label for="M">M</label>
                                                <span>'.number_format($item['price_m']).'đ</span>
                                                <br>
                                                <input type="radio" id="L" name="size" value="L">
                                                <label for="L">L</label>
                                                <span>'.number_format($item['price_l']).'đ</span>
                                            </div>
                                        <hr>
                                    </div>

                                    <div class="part">
                                        <h3>Loại đế</h3>
                                        <div class = "form">';
                                            foreach ($plinth as $base)
                                            echo'
                                            <input type="radio" id="de'.$base['id'].'" checked = "checked" name="de" value="'.$base['name'].'">
                                            <label for="de'.$base['id'].'">'.$base['name'].'</label><br>';
                                            echo'
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="part">
                                        <h3>Topping</h3>
                                        <div class = "form">';
                                        foreach($product as $topping)
                                        if ($topping['category_id'] == 8)
                                        echo'
                                            <input type="checkbox" id="1" name="topping[]" value="'.$topping['name'].'">
                                            <label for="1">'.$topping['name'].'</label>
                                            <!-- <span class="cost">'.number_format(10000).'đ</span> -->
                                            <span class="cost">'.$topping['price_free_size'].'đ</span>
                                            <br>';
                                        echo'
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="final">
                                        <label for="quantity">Số lượng: </label>
                                        <input type="number" id="quantity" value = "1"name="quantity" min="1" max="10">
                                        <input type="submit" class="add-card-bt" name="addcart" value="Thêm vào giỏ">
                                    </div>                          
                                </div>
                            </div>
                        </form>';}
                    else{
                        echo                                 
                        '<div class="product">
                            <img class="product_img" src="../../masterial/image/thuc_don/'.$item['image'].'"/>
                            <h2 class="name">'.$item['name'].'</h2>
                            <p class="description">'.$item['description'].'</p>
                            <span class="price">'.number_format($item['price_free_size']).' đ</span>
                            <a class="choose_btn">Chọn</a>
                        </div>

                        <form class="info_view" action="..\homepage\homepage.php" method="post">
                            <div class="info_card">
                                <a><i class="fa fa-times closeViewInfo_btn" aria-hidden="true"></i></a>
                                <div class="info_img"><img src="../../masterial/image/thuc_don/'.$item['image'].'"></div>

                                <input type="text" style="display: none;" name="image" value="'.$item['image'].'">
                                <input type="text" style="display: none;" name="category" value="'.$item['category_id'].'">
                                <input type="text" style="display: none;" name="gia" value="'.$item['price_free_size'].'">
                                
                                <div class="info">
                                    <div class="part">
                                        <h2>'.$item['name'].'</h2>
                                        <input type="text" style="display: none;" name="name" value="'.$item['name'].'">
                                        <p>'.$item['description']. '</p>
                                        <hr>
                                    </div>
                                    
                                    <div class="part">
                                        <div class = "form">
                                            <label>Giá:</label>
                                            <span>'.number_format($item['price_free_size']).'đ</span>
                                            <br>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="final">
                                        <label for="quantity">Số lượng: </label>
                                        <input type="number" id="quantity" value = "1"name="quantity" min="1" max="10">
                                        <input type="submit" class="add-card-bt" name="addcart1" value="Thêm vào giỏ">
                                    </div>                          
                                </div>
                            </div>
                        </form>';
                        }                
                    }
                }
                echo '
                    </div>
                </div>';
            }
        ?>
    </div>

    <br><br><br><br><br><br><br>
    <div id="contact" class="foot-page">
            <img class="bgr" src="../../masterial/image/bgrhomepage/endHomepage.jpg" alt="">
            <div class="contact">
                <img class="logo" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
                <p><i class="fa fa-phone" aria-hidden="true"></i><span> CONTACT: 0123 456 789</span>
                <br><br>
                <i class="fa fa-envelope" aria-hidden="true"></i><span> EMAIL: ABC@GMAIL.COM</span></p>                
            </div>

    </div>

    <!-- notice popup -->
        <script>
            var counter = 1;
            setInterval(function(){
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if(counter > 4){
                counter = 1;
            }
            }, 5000);

            var infoView = document.querySelectorAll('.info_view');
            var chooseBtn = document.querySelectorAll('.choose_btn');
            var closeViewInfoBtn = document.querySelectorAll('.closeViewInfo_btn');
                
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
            // tab
            var tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.width = 100/tablinks.length + '%';
            }

            function openPage(pageName,elmnt) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].style.backgroundColor = "";
                    tablinks[i].style.color = "";
                }
                document.getElementById(pageName).style.display = "block";
                elmnt.style.backgroundColor = "#F98607";
                elmnt.style.color = "#A80000";

            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();

            // hien popup thong bao
            const popupScreen = document.querySelector(".popup_screen");
            const popupBox = document.querySelector(".popup_box");
            const closeBtn = document.querySelector(".close_btn");

            window.addEventListener("load", ()=>{
                setTimeout(() => {
                    popupScreen.classList.add("active");
                }, 1000);   //Popup the screen in 01 seconds after the page loaded
            })

            closeBtn.addEventListener("click", ()=>{
                popupScreen.classList.remove("active"); //Close the popup screen on click the x button
            });
        </script>

</body>
</html>
