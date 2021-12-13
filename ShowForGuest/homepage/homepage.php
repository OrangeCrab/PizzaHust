<?php
    session_start();
    

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

    // $_SESSION['user_id'] = 1;
    if(isset($_SESSION['user_id'])) echo' 
    <script>
    alert("session is ok");
    </script>
    ';


    # Mỗi lần them sản phẩm vào giỏ hàng,  $_SESSION['giohang'] sẽ thêm một mảng các thuộc
    # tính của sản phẩm mình đang chọn vào biến đó (bảng product chưa hoàn thiện về giá nên cho giá mặc định nên không có biến $price)
    # sẽ thêm biến $price khi người dùng chọn s m l khác (lúc này lại phải truy cập sql để biết được giá)
    if(isset($_POST['addcart']) &&($_POST['addcart'])){
        $size=(string)$_POST['size'];
        $de=$_POST['de'];
        $topping=$_POST['topping'];
        $quantity=$_POST['quantity'];
        $name=$_POST['name'];
        $image=$_POST['image'];
        $loai = $_POST['category'];
        $price= $_POST['gia'] /1000;

        #Kiểm tra sản phẩm vừa đặt có trong giỏ hàng không
        $check = 0;
        for($i= 0; $i < sizeof($_SESSION['giohang']); $i++){
            if( ($name == $_SESSION['giohang'][$i][4])  && ($size == $_SESSION['giohang'][$i][0]) && ($de == $_SESSION['giohang'][$i][1]) && ($topping == $_SESSION['giohang'][$i][2]) ){
                $_SESSION['giohang'][$i][3] += $quantity;
                $check = 1;
                break;
            }
        }
        $sp=[$size,$de,$topping,$quantity,$name,$image,$loai,$price_S];
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
        $sp=[null,null,null,$quantity,$name,$image,$loai,$price_S];
        if($check == 0) {
            $_SESSION['giohang'][]=$sp;
        }
    }
    function popup(){
        if($_SESSION['giohang'] == null)
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
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>

<body>
    <header>
        <div class="top-bar">
            <img src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
            <a href="#launcher">Trang chủ</a>
            <a href="#menu">Thực đơn</a>
            <a href="../../cart/cart.php"><span>GIỎ HÀNG</span><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
            <a href="#contact">Liên hệ</a>
            <a href="../login/login_user.php"><i class="fa fa-user" aria-hidden="true"></i></a>
        </div>
    </header>

    <div class="header-page">
        <img id="launcher" src="../../masterial/image/bgrhomepage/headHomePage.jpg" alt="">
    </div>
    <br id="menu">

    <div class="body-page">
        <div class="left-bar">
            <?php
                foreach($category as $cate)
                    if ($cate['id'] < 8)
                    echo'<a href="#'.$cate['id'].'" ><i class="fas fa-pizza-slice"></i><span>'.$cate['title'].'</span></a>';
            ?>
        </div>  
        
        <div class="product-list">
            
                <?php
                foreach($category as $cate)
                    if ($cate['id'] < 8){
                    echo '<div class = "title" id="'.$cate['id'].'">
                            <br><br><br><br><h2>'.$cate['title'].'</h2>    
                        </div>';
                    $id = $cate['id'];
                    $sql = "select product.* from product";
                    $product = executeResult($sql);
                    echo 
                        '<div class="category">';
                        foreach($product as $item) {
                        if ($item['category_id'] == $id){
                            if($id == 1){
                            echo                                 
                            '<div class="product">
                                <img class="product_img" src="../../masterial/image/thuc_don/'.$item['image'].'"/>
                                <h2 class="name">'.$item['name'].'</h2>
                                <p class="description">'.$item['description'].'</p>
                                <span class="price">'.number_format($item['price_s']).' đ</span>
                                <a class="choose_btn">Chọn</a>
                            </div>
                            <form class="info_view" action="..\homepage\draft.php" method="post">
                                <div class="info_card">
                                    <a><i class="fa fa-times closeViewInfo_btn" aria-hidden="true"></i></a>
                                    <div class="info_img"><img src="../../masterial/image/thuc_don/'.$item['image'].'"></div>
                                    
                                    <input type="text" style="display: none;" name="image" value="'.$item['image'].'">
                                    <input type="text" style="display: none;" name="category" value="'.$item['category_id'].'">
                                    <input type="text" style="display: none;" name="gia" value="'.$item['price_s'].'">
                                                    
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
                                                    <input type="radio" id="S" name="size" value="S">
                                                    <label for="S">S</label>
                                                    <span>'.number_format($item['price_s']).'đ</span>
                                                    <br>
                                                    <input type="radio" id="M" name="size" value="M">
                                                    <label for="M">M</label>
                                                    <span>'.number_format($item['price_m'] + 10000).'đ</span>
                                                    <br>
                                                    <input type="radio" id="L" name="size" value="L">
                                                    <label for="L">L</label>
                                                    <span>'.number_format($item['price_l'] + 20000).'đ</span>
                                                </div>
                                            <hr>
                                        </div>

                                        <div class="part">
                                            <h3>Loại đế</h3>
                                            <div class = "form">
                                                <input type="radio" id="gion" name="de" value="Giòn">
                                                <label for="gion">Giòn</label><br>
                                                <input type="radio" id="men" name="de" value="Mềm truyền thống">
                                                <label for="mem">Mềm truyền thống</label><br>
                                                <input type="radio" id="men" name="de" value="Oregano">
                                                <label for="mem">Oregano</label><br>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="part">
                                            <h3>Topping</h3>
                                            <div class = "form">';
                                            foreach($product as $topping)
                                            if ($topping['category_id'] == 8)
                                            echo'
                                                <input type="checkbox" id="1" name="topping" value="1">
                                                <label for="1">'.$topping['name'].'</label>
                                                <span class="cost">'.$topping['price_free_size'].'đ</span>
                                                <br>';
                                            echo'
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="final">
                                            <span>SL:</span>
                                            <input type="number" id="quantity" name="quantity" min="1" max="5">
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

                            <form class="info_view" action="..\homepage\draft.php" method="post">
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
                                                <span>'.number_format($item['price_free_size']).'đ</span>
                                                <br>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="final">
                                            <span>SL:</span>
                                            <input type="number" id="quantity" name="quantity" min="1" max="10">
                                            <input type="submit" class="add-card-bt" name="addcart1" value="Thêm vào giỏ">
                                        </div>                          
                                    </div>
                                </div>
                            </form>';
                        }                
                        }
                    }
                    echo '</div>';
                }?>
            
                <!-- pop up hiện thông tin chi tiết sp -->
                <script text="text/javascript">
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
                </script>
        </div>
                        
                        <!-- nhận voucher cho khách hàng có tài khoản -->
        <div class="voucher"> 
            <?php
                foreach($coupon as $item) {
                    $sql = "select cp_id, user_id from cp_user where cp_id = '$item[id_cp]' and user_id = '$_SESSION[user_id]'";
                    $cpExist = executeResult($sql);
                    
                    if ($cpExist != null)
                        echo'<input type="submit" name="gotten" id="" value="Đã Nhận">';
                    else echo'
                        <form action="" method="POST">
                            <input type="text" style="display: none;" name="cp_id" value="'.$item['id_cp'].'">
                            <input type="submit" name="addcp" id="get'.$item['id_cp'].'" value="'.$item['code_cp'].'">
                        </form>';   
                }                
                if (isset($_POST['addcp']) && $_SESSION['user_id']){
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

        
    </div>

    <br><br><br><br><br><br><br>
    <div id="contact" class="foot-page">
            <img class="bgr" src="../../masterial/image/bgrhomepage/endHomepage.jpg" alt="">
            <div class="contact"></div>
            <img class="logo" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
            <p><i class="fa fa-phone" aria-hidden="true"></i><span> CONTACT: 0123 456 789</span>
            <br><br>
            <i class="fa fa-envelope" aria-hidden="true"></i><span> EMAIL: ABC@GMAIL.COM</span></p>
    </div>

    <!-- notice popup -->
    <!-- <?php popup(); ?> -->
        <script type="text/javascript">
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
