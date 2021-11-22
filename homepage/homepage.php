<?php
    require_once('../database/dbhelper.php');
	$baseUrl = '../';
    // chay cau lenh sql để lấy tên loại sản phẩm sử dụng lệnh join bảng
	$sql = "select product.*, category.title as category_name from product left join category on product.category_id = category.id";
	$data = executeResult($sql);
    $sql = "select * from voucher";
	$voucher = executeResult($sql);
    // $sql = "select * from product";
	// $product = executeResult($sql);
    $sql = "select * from category";
    $category = executeResult($sql);

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
            <img src="../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
            <a href="#launcher">Trang chủ</a>
            <a href="#menu">Thực đơn</a>
            <a href="../cart/cart.html"><span>GIỎ HÀNG</span><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
            <a href="#contact">Liên hệ</a>
            <a href="../AdminSystem/login_form.php"><i class="fa fa-user" aria-hidden="true"></i></a>
        </div>
    </header>

    <div class="header-page">
        <img id="launcher" src="../masterial/image/bgrhomepage/headHomePage.jpg" alt="">
    </div>
    <br id="menu">

    <div class="body-page">
        <div class="left-bar">
            <?php
                foreach($category as $cate)
                    echo'<a href="#'.$cate['id'].'" ><i class="fas fa-pizza-slice"></i><span>'.$cate['title'].'</span></a>';
            ?>
        </div>  
        <!-- <div class="gap"></div> -->
        
        <div class="product-list">
            
                <?php
                foreach($category as $cate){
                    echo '<div class = "title" id="'.$cate['id'].'">
                            <h2><br><br><br><br>'.$cate['title'].'</h2>
                            <span><br><br><br><br><br><br><br><hr></span>
                        </div>';
                    $id = $cate['id'];
                    $sql = "select product.* from product";
                    $product = executeResult($sql);
                    echo '<div class="category">';
                    foreach($product as $item) {
                        if ($item['category_id'] == $id)
                        echo                                 
                            '<div class="product">
                                <img class="product_img" src="'.$item['image'].'"/>
                                <h2 class="name">'.$item['name'].'</h2>
                                <p class="description">'.$item['description'].'</p>
                                <span class="price">'.number_format($item['price']).' đ</span>
                                <a class="choose_btn">Chọn</a>
                            </div>';
                        }
                    echo '</div>';
                }?>
            
                <?php
                    foreach($category as $cate){
                        $id = $cate['id'];
                        $sql = "select product.* from product";
                        $product = executeResult($sql);   
                            foreach($product as $item) {
                                if ($item['category_id'] == $id)
                                        echo                                 
                                        '<div class="info_view">
                                            <div class="info_card">
                                                <a><i class="fa fa-times closeViewInfo_btn" aria-hidden="true"></i></a>
                                                <div class="info_img"><img src="'.$item['image'].'"></div>
                                                
                                                <div class="info">
                                                    <div class="part">
                                                        <h2>'.$item['name'].'</h2>
                                                        <p>'.$item['description'].'</p>
                                                        <hr>
                                                    </div>
                                                    
                                                    <div class="part">
                                                        <h3>Size</h3>
                                                        <form>
                                                            <input type="radio" id="S" name="size" value="S">
                                                            <label for="S">S</label>
                                                            <span>99 000đ</span>
                                                            <br>
                                                            <input type="radio" id="M" name="size" value="M">
                                                            <label for="M">M</label>
                                                            <span>109 000đ</span>
                                                            <br>
                                                            <input type="radio" id="L" name="size" value="L">
                                                            <label for="L">L</label>
                                                            <span>119 000đ</span>
                                                        </form>
                                                        <hr>
                                                    </div>

                                                    <div class="part">
                                                        <h3>Loại đế</h3>
                                                        <form>
                                                            <input type="radio" id="gion" name="de" value="Gion">
                                                            <label for="gion">Giòn</label><br>
                                                            <input type="radio" id="men" name="de" value="mem">
                                                            <label for="mem">Mềm truyền thống</label><br>
                                                        </form>
                                                        <hr>
                                                    </div>
                                                    <div class="part">
                                                        <h3>Size</h3>
                                                        <form>
                                                            <input type="checkbox" id="1" name="topping" value="1">
                                                            <label for="1">Phô mai phủ</label>
                                                            <span class="cost">9 000đ</span>
                                                            <br>
                                                            <input type="checkbox" id="2" name="topping" value="2">
                                                            <label for="2">Phô mai viền</label>
                                                            <span class="cost">9 000đ</span>
                                                            <br>
                                                            <input type="checkbox" id="3" name="topping" value="3">
                                                            <label for="3">Double sốt</label>
                                                            <span class="cost">9 000đ</span>
                                                        </form>
                                                        <hr>
                                                    </div>
                                                    <div class="final">
                                                        <span>SL:</span>
                                                        <input type="number" id="quantity" name="quantity" min="1" max="5">
                                                        <span class="price">'.number_format($item['price']).'</span>
                                                        <a href="#" class="add-card-btn">Thêm vào giỏ</a> 
                                                    </div>                          
                                                </div>
                                            </div>
                                        </div>';
                                    }  
                    }
                ?>
 

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
                        
        <div class="voucher">
            <?php
                foreach($voucher as $item) {
                echo'  
                    <a href="../AdminSystem/login_form.php"><img src="'.$item['picture'].'" alt=""></a>';
                }// '.$item['code'].'
            ?>
        </div>
    </div>


    <br><br><br><br><br><br><br>
    <div id="contact" class="foot-page">
            <img class="bgr" src="../masterial/image/bgrhomepage/endHomepage.jpg" alt="">
            <div class="contact"></div>
            <img class="logo" src="../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
            <p><i class="fa fa-phone" aria-hidden="true"></i><span> CONTACT: 0123 456 789</span>
            <br><br>
            <i class="fa fa-envelope" aria-hidden="true"></i><span> EMAIL: ABC@GMAIL.COM</span></p>
    </div>

    <!-- notice popup -->
    <div class="popup_screen">
            <div class="popup_box">
                <img src="../masterial/image/bgrhomepage/popup.svg" alt="">
                <div>
                    <i class="fa fa-times close_btn" aria-hidden="true"></i>
                    <h2>PizzaHust xin chào</h2>
                    <br>
                    <p>Quý khách hàng thân mến, PizzaHust chỉ ship được đồ ăn trong nội thành Hà Nội thôi ạ, quý khách hàng thông cảm giúp PizzaHust nha!!!</p>
                </div>
                
            </div>
        </div>

        <script type="text/javascript">
            const popupScreen = document.querySelector(".popup_screen");
            const popupBox = document.querySelector(".popup_box");
            const closeBtn = document.querySelector(".close_btn");

            window.addEventListener("load", ()=>{
                setTimeout(() => {
                    // popupScreen.classList.add("active");
                }, 1000);   //Popup the screen in 01 seconds after the page loaded
            })

            closeBtn.addEventListener("click", ()=>{
                popupScreen.classList.remove("active"); //Close the popup screen on click the x button
            });
        </script>

</body>
</html>
