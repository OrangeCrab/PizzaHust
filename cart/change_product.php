
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="cart.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $i = 0;
    session_start();
    require_once('../database/dbhelper.php');
	$baseUrl = '../';
    // chay cau lenh sql để lấy tên loại sản phẩm sử dụng lệnh join bảng
	$sql = "select product.*, category.title as category_name from product left join category on product.category_id = category.id";
	$data = executeResult($sql);
    if(isset($_GET['fixid']) && ($_GET['fixid'] >= 0)){
        $i =$_GET['fixid'];
    }
    if($_SESSION['giohang'][$i][6] == 2){
    echo'
    <form class="info_view" action="cart.php" method="post">
        <div class="info_card">
                <a href = "cart.php" class="fa fa-times closeViewInfo_btn">X</a>
                <div class="info_img"><img src="../masterial/image/thuc_don/'.$_SESSION['giohang'][$i][5].'"></div>
                <input type="text" style="display: none;" name="stt" value="'.$i.'">
                <div class="info">
                    <div class="part">
                        <h2>'.$_SESSION['giohang'][$i][4].'</h2>
                        <hr>
                    </div>
                    
                    <div class="part">
                    <h3>Size</h3>
                    <div class = "form">
                        <input type="radio" checked="checked" id="S" name="size" value="S">
                        <label for="S">S</label>
                        <span>'.number_format($_SESSION['giohang'][$i][8]).'đ</span>
                        <br>
                        <input type="radio" id="M" name="size" value="M">
                        <label for="M">M</label>
                        <span>'.number_format($_SESSION['giohang'][$i][9]).'đ</span>
                        <br>
                        <input type="radio" id="L" name="size" value="L">
                        <label for="L">L</label>
                        <span>'.number_format($_SESSION['giohang'][$i][10]).'đ</span>
                    </div>
                    <hr>
                </div>
    
                <div class="part">
                    <h3>Loại đế</h3>
                    <div class = "form">
                        <input type="radio" checked="checked" id="gion" name="de" value="Giòn">
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
                    $sql = "select product.* from product";
                    $product = executeResult($sql);
                    foreach($product as $topping){
                        if ($topping['category_id'] == 8)
                        echo'
                            <input type="checkbox" id="1" name="topping[]" value="'.$topping['name'].'">
                            <label for="1">'.$topping['name'].'</label>
                            <!-- <span class="cost">'.number_format(10000).'đ</span> -->
                            <span class="cost">'.$topping['price_free_size'].'đ</span>
                            <br>';
                        }
                    echo'
                    </div>
                    <hr>
                </div>

                
                
                <div class="final">
                    <span>SL:</span>
                    <input type="number" value = "'.$_SESSION['giohang'][$i][3].'" id="quantity" name="quantity" min="1" max="5">
                    <input type="submit" class="add-card-bt" name="confirm" value="Xác nhận">
                </div>                          
            </div>
            </form>';}
        else
         echo'
    <form class="info_view" action="cart.php" method="post">
        <div class="info_card">
                <a href = "cart.php" class="fa fa-times closeViewInfo_btn">X</a>
                <div class="info_img"><img src="../masterial/image/thuc_don/'.$_SESSION['giohang'][$i][5].'"></div>
                <input type="text" style="display: none;" name="stt" value="'.$i.'">
                
                <div class="info">
                    <div class="part">
                        <h2>'.$_SESSION['giohang'][$i][4].'</h2>
                        <hr>
                    </div>
                    
                    <div class="part">
    
                        <div class = "form">
                            <span>'.number_format($_SESSION['giohang'][$i][7]*1000).'đ</span>
                           
                        </div>
                        <hr>
                    </div>

                   
                    <div class="final">
                        <span>SL:</span>
                        <input type="number" value = "'.$_SESSION['giohang'][$i][3].'" id="quantity" name="quantity" min="1" max="5">
                        <input type="submit" class="add-card-bt" name="confirm_orther_product" value="Xác nhận">
                    </div>                          
                </div>
        </form>';
        ?>
     
</body>
</html>