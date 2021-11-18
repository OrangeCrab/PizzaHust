<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="menu.css">        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <style>
              @font-face {
              font-family: Montserrat;
              src: url("../masterial/font/Montserrat-Medium.ttf");
            }

            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");

            * {
              margin: 0;
              padding: 0;
              /* font-family: 'Poppins',sans-serif; */
              font-family: Montserrat;
            }

            body {
              background-color: cadetblue;
              display: flex;
              justify-content: center;
              align-items: center;
            }

            .container {
              position: relative;
              display: flex;
              justify-content: center;
              align-items: center;
              width: 100%;
              height: 100%;
            }

            .product .product_card {
              z-index: 1;
              background: #f2f2f2;
              position: relative;
              width: 270px;
              height: 400px;
              margin: 40px;
              border-radius: 10px;
            }

            .product .product_card .product_img {
              z-index: 1;
              position: absolute;
              width: 270px;
              height: 180px;
              margin-top: 30%;
              left: 50%;
              transform: translate(-50%, -50%);
              border-top-left-radius: 10px;
              border-top-right-radius: 10px;
            }

            .product .product_card .name {
              z-index: 2;
              color: #404040;
              position: absolute;
              width: 100%;
              text-align: center;
              bottom: 180px;
              font-size: 20px;
            }

            .product .product_card .info {
              z-index: 2;
              color: #404040;
              position: absolute;
              width: 90%;
              margin-left: 5%;
              text-align: center;
              bottom: 120px;
              font-size: 10px;
            }

            .product .product_card .price {
              z-index: 2;
              color: #a80000;
              position: absolute;
              width: 100%;
              text-align: center;
              bottom: 80px;
              font-size: 20px;
              font-weight: bolder;
            }

            .product .product_card .choose_btn {
              z-index: 2;
              color: #f2f2f2;
              background: #a80000;
              position: absolute;
              bottom: 20px;
              left: 50%;
              font-size: 14px;
              text-transform: uppercase;
              text-decoration: none;
              transform: translate(-50%);
              padding: 10px 15px;
              border-radius: 20px;
              cursor: pointer;
            }

            /* style for popup view */
            .product .info_view {
              z-index: 2;
              position: fixed;
              background-color: rgba(0, 0, 0, 0.9);
              top: 0;
              right: 0;
              bottom: 0;
              left: 0;
              display: flex;
              justify-self: center;
              align-items: center;
              opacity: 0;
              visibility: hidden;
              transition: 0.5s;
            }
            .product .info_view.active {
              opacity: 1;
              visibility: visible;
            }
            hr {
              width: 368px;
              border-color: #a80000;
            }
            .product .info_card {
              position: relative;
              display: flex;
              width: 700px;
              height: 600px;
              margin: 300px;
            }
            .product .info_card .closeViewInfo_btn {
              color: hsl(0, 100%, 33%);
              z-index: 3;
              position: absolute;
              right: 0;
              font-size: 20px;
              margin: 20px;
              cursor: pointer;
            }
            .product .info_card img {
              z-index: 2;
              position: relative;
              width: 270px;
              height: 100%;
              border-bottom-left-radius: 5px;
              border-top-left-radius: 5px;
            }
            .product .info_card .info {
              z-index: 2;
              background: #f2f2f2;
              display: inline-block;
              width: 430px;
              height: 100%;
              box-sizing: border-box;
              padding: 30px;
              border-bottom-right-radius: 5px;
              border-top-right-radius: 5px;
            }
            .product .info_card .info h2 {
              font-size: 20px;
              color: #404040;
              padding-bottom: 10px;
            }
            .product .info_card .info p {
              font-size: 10px;
              color: #404040;
              padding-bottom: 10px;
            }

            .product .info_card .info .part {
              padding-bottom: 10px;
            }
            .product .info_card .info .part form {
              line-height: 40px;
              padding-left: 50px;
              font-size: 14px;
            }
            .product .info_card .info .part h3 {
              color: #404040;
              font-size: 16px;
              text-align: center;
            }
            .product .info_card .info .part span {
              float: right;
            }

            .product .info_card .info .final {
              padding-top: 20px;
            }
            .product .info_card .info .final input {
              padding: 2px 2px;
            }
            .product .info_card .info .final a {
              font-size: 14px;
              float: right;
              font-weight: 900;
              color: #a80000;
            }
            .product .info_card .info .final .price {
              font-size: 16px;
              color: #f2f2f2;
              background-color: #a80000;
              padding: 2px 45px;
              margin: 10px;
              border-radius: 5px;
            }
            .form{
              line-height: 40px;
              padding-left: 50px;
              font-size: 14px;
            }
            .add-card-bt {
              font-size: 14px;
              float: right;
              font-weight: 900;
            }


        </style>
    </head>

    <body>
        
    <!-- <?php
        $index = 0;
        foreach($data as $item) {
            echo '<div calss="prodcut_card">
                '.(++$index).'
                <h2 class="name">'.$item['title'].'</h2>
                <p class="info">'.$item['description'].'</p>
                <span class="price">'.number_format($item['price']).' đ</span>
                <a class="choose_btn">Chọn</a>
                <img class="product_img" src="'.$item['thumbnail'].'"/>
            </div>';
        }
    ?> -->

        <div class="container">
        <div class="product">

            <form action="..\cart\cart.php" method="post">
            
                <div class="product_card">
                    <h2 class="name">Pizza thập cẩm</h2>
                    <p class="info">Xốt Cà Chua, Phô Mai Mozzarella, Xúc Xích Pepperoni, Thịt Dăm Bông, Xúc Xich Ý, Thịt Bò Viên, Ớt Chuông Xanh, Nấm Mỡ, Hành Tây, Ô-liu</p>
                    <span class="price">99 000đ</span>
                    <a class="choose_btn">Chọn</a>
                    <img class="product_img" src="../masterial/image/thuc_don/thap_cam.jpg" alt="">
                </div>
                <div class="info_view">
                    <div class="info_card">
                        <a><i class="fa fa-times closeViewInfo_btn" aria-hidden="true"></i></a>
                        <img src="../masterial/image/bgrhomepage/profile_pizza_thap_cam.jpg" alt="">
                        
                        <div class="info">
                            <div class="part">
                                <h2>Pizza thập cẩm</h2>
                                <p>Xốt Cà Chua, Phô Mai Mozzarella, Xúc Xích Pepperoni, Thịt Dăm Bông,Xúc Xich Ý, Thịt Bò Viên, Ớt Chuông Xanh, Nấm Mỡ, Hành Tây, Ô-liu</p>
                                <hr>
                            </div>
                            
                            <div class="part">
                                <h3>Size</h3>
                                <div class="form">
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
                                    <!-- <input type="submit" class="add-card-bt" name="addcart" value="Thêm vào giỏ"> -->
                                </div>
                                <hr>
                            </div>
                            <div class="part">
                                <h3>Loại đế</h3>
                                <div class="form">
                                    <input type="radio" id="gion" name="de" value="Giòn">
                                    <label for="gion">Giòn</label><br>
                                    <input type="radio" id="men" name="de" value="Mềm truyền thống">
                                    <label for="mem">Mềm truyền thống</label><br>
                                </div>
                                <hr>
                            </div>
                            <div class="part">
                                <h3>Size</h3>
                                <div class="form">
                                <input type="radio" id="1" name="topping" value="Phô mai phủ">
                                    <label for="1">Phô mai phủ</label>
                                    <span>9 000đ</span>
                                    <br>
                                    <input type="radio" id="2" name="topping" value="Phô mai viền">
                                    <label for="2">Phô mai viền</label>
                                    <span>9 000đ</span>
                                    <br>
                                    <input type="radio" id="3" name="topping" value="Double sốt">
                                    <label for="3">Double sốt</label>
                                    <span>9 000đ</span>
                                </div>
                                <hr>
                            </div>
                            <div class="final">
                                <!-- <div class="form"> -->
                                    <span>SL:</span>
                                    <input type="number" id="quantity" name="quantity" min="1" max="100">
                                    <!-- <input type="number" id="gia" name="quantity" min="1" max="100"> -->
                                    <span class="price">99 000đ</span>
                                   
                                    <!-- <a href="#" class="add-card-btn">Thêm vào giỏ</a>  -->
                                    <input type="submit" class="add-card-bt" name="addcart" style="font-size: 14px; float: right;  font-weight: 900;color: #a80000;" value="Thêm vào giỏ">
                                <!-- </div> -->
                            </div>                          
                        </div>
                    </div>
                    
                </div>
               
            </form>
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
    </body>
</html>