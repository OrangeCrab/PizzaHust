<?php
    require_once('../database/dbhelper.php');
	$baseUrl = '../';
    // chay cau lenh sql để lấy tên loại sản phẩm sử dụng lệnh join bảng
	$sql = "select product.*, category.name as category_name from product left join category on product.category_id = category.id ";
	$data = executeResult($sql);
?> 

<!DOCTYPE html>
<html>
    <head>
        <title>PizzaHust</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="homepageDraft.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    </head>

    <body>
        
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
                    popupScreen.classList.add("active");
                }, 1000);   //Popup the screen in 01 seconds after the page loaded
            })

            closeBtn.addEventListener("click", ()=>{
                popupScreen.classList.remove("active"); //Close the popup screen on click the x button
            });
        </script>

        <div class="page">
            <div class="laucher" id="launcher">
                <img class="launcher_img" src="../masterial/image/bgrhomepage/headHomePage.jpg" alt="">
                <img class="launcher_logo" src="../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
            </div>
            


            <div class="menu" id="menu"> 
                <br><br><br><br>
                <div class="container">

                    <div class="product">
<!-- ---------------------------------------------- -->

                        <?php
                        // $index = 0;
                        foreach($data as $item) {
                            echo 
                            '<div class="product_card">
                                <h2 class="name">'.$item['title'].'</h2>
                                <p class="info">'.$item['description'].'</p>
                                <span class="price">'.number_format($item['price']).' đ</span>
                                <a class="choose_btn">Chọn</a>
                                <img class="product_img" src="'.$item['thumbnail'].'"/>
                            </div>
                            
                            <div class="info_view">
                                <div class="info_card">
                                    <a><i class="fa fa-times closeViewInfo_btn" aria-hidden="true"></i></a>
                                    <div class="info_img"><img src="'.$item['thumbnail'].'"></div>
                                    
                                    
                                    <div class="info">
                                        <div class="part">
                                            <h2>'.$item['title'].'</h2>
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
                                                <span>9 000đ</span>
                                                <br>
                                                <input type="checkbox" id="2" name="topping" value="2">
                                                <label for="2">Phô mai viền</label>
                                                <span>9 000đ</span>
                                                <br>
                                                <input type="checkbox" id="3" name="topping" value="3">
                                                <label for="3">Double sốt</label>
                                                <span>9 000đ</span>
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
                            </div> ';
                        }
                        ?>                   
                    </div>
                </div>
        
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
            
            <div id="contact" class="contact">
                <img class="contact_img" src="../masterial/image/bgrhomepage/endHomepage.jpg" alt="">
                <div class="contact_layer"></div>
                <img class="contact_logo" src="../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
                <p><i class="fa fa-phone" aria-hidden="true"></i><span> CONTACT: 0123 456 789</span><br><br>
                    <i class="fa fa-envelope" aria-hidden="true"></i><span> EMAIL: ABC@GMAIL.COM</span></p>
            </div>

        </div> 

        <header>
                <ul class="top_bar">
                    <li><a href="login_user.php" class="login"><i class="fa fa-user" aria-hidden="true"></i></a></li>    
                    <li><a href="#contact">LIÊN HỆ</a></li>
                    <li><a href="../cart/cart.html"><span>GIỎ HÀNG</span><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                    <li><a href="#menu">THỰC ĐƠN</a></li>
                    <li><a href="#launcher" class="active">TRANG CHỦ</a></li>
                </ul>
        </header>

        
    </body>
</html>