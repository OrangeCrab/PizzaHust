<?php
    $title = 'Sửa Sản Phẩm';
	$baseUrl = '../';

	$id = $msg = $name = $price =  $status_product_id = $category_id  = $image = $description = $price_free_size = $price_s= $price_m = $price_l ='';

    require_once('../../database/utility.php');
    require_once('../../database/define.php');
    require_once('../../database/dbhelper.php');
    require_once('form_save.php');

	$id = getGet('id');

    $sql = "select * from product where id = '$id' ";

    $category_id = getArrResult($sql)['category_id'];
    $price = getArrResult($sql)['price'];
    $name = getArrResult($sql)['name'];
    $status_product_id = getArrResult($sql)['status_product_id'];
    $description = getArrResult($sql)['description'];
    $image = getArrResult($sql)['image'];
    $price_free_size = getArrResult($sql)['price_free_size'];
    $price_s = getArrResult($sql)['price_s'];
    $price_m = getArrResult($sql)['price_m'];
    $price_l = getArrResult($sql)['price_l'];

	$sql = "select * from category";
	$categoryItems = executeResult($sql);
	$sql = " select *from status_product ";
	$statusList = executeResult($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="https://t004.gokisoft.com/uploads/2021/07/1-s-1637-ico-web.jpg">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css"> -->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <title>Sửa sản Phẩm</title>
        <style>
            @font-face {
                font-family: Monsterrat;
                src: url("../../masterial/font/Montserrat-Medium.ttf");
            }
            body{
                font-family: Monsterrat;
            }
            .product_popup{
                width: 100%;
                height: 100%;
                position: fixed;
                background-color: rgba(0, 0, 0, 0.9);
                display: flex;
                justify-self: center;
                align-items: center;
                transition: 0.5s;
            }
            .product_popup .info_card{
    position: fixed;
    width: 70%;
    height: 80%;
    left: 15%;
    top: 10%;
    background: #f2f2f2;
    border-radius: 5px;
}
    .product_popup .info_card .close_btn{
        color: #404040;
        z-index: 3;
        position: absolute;
        right: 0;
        font-size: 20px;
        margin: 20px;
        cursor: pointer;
    }
    .product_popup .info_card h3{
        position: absolute;
        top: 5%;
        left: 35%;
        height: 5%;
    }
    .panel-body{
        position: absolute;
        width: 100%;
        height: 90%;
        top: 10%;
    }
        form{
            position: absolute;
            width: 100%;
            height: 100%;
        }
            .left_div{
                position: absolute;
                width: 50%;
                height: 90%;
            }
                .form_group{
                    position: absolute;
                    width: 100%;
                    height: 8%;
                }
                    .form_group label{
                        height: 60%;
                        width: 35%;
                        text-align: right;
                        clear: both;
                        float:left;
                        margin-right:5%;
                        margin-top: 0.5%;
                    }
                    .form_group input{
                        position: absolute;
                        width: 50%;
                        height: 100%;
                        left: 40%;
                    }
                
                    .product_type label{
                        position: absolute;
                        width: 40%;
                        height: 70%;
                        top: 15%;
                    }

                    .product_type select{
                        position: absolute;
                        width: 60%;
                        left: 40%;
                    }
                .size_div_wrap{
                    position: absolute;
                    width: 100%;
                    height: 50%;
                    top: 30%;
                }
                    .size_div_wrap label{
                        position: absolute;
                        width: 20%;
                        height: fit-content;
                        left: 10%;
                    }
                        .size_div label{
                            position: absolute;
                            width: 30%;
                            height: 70%;
                            left: 0;
                        }

                        .size_div input{
                            position: absolute;
                            width: 55%;
                            left: 30%;
                            height: 70%;
                        }
                .description_div{
                    position: absolute;
                    width: 100%;
                    height: 8%;
                    top: 80%;
                }
                    .description_div input{
                        position:absolute; 
                        width:60%; 
                        left:30%;
                        height: 100%;
                    }
                .meal_div_wrap{
                    position: absolute;
                    width: 100%;
                    height: 8%;
                    top: 90%;
                }
                    .meal_div label{
                        position: absolute;
                        width: 70%;
                        height: 100%;
                        left: 15%;
                        top: 3%;
                    }
            .right_div{
                position: absolute;
                width: 50%;
                height: 80%;
                top: 5%;
                left: 50%;
            }
                .select_menu{
                    position: absolute;
                    width: 100%;
                    height: 25%;
                }

                .select_menu label{
                    position: absolute;
                    width: 20%;
                    left: 8%;
                }
                    .menu_div label{
                        position: absolute;
                        width: 80%;
                        top: 4%;
                    }
                .title_of_img_card{
                    position: absolute;
                    width: 100%;
                    height: 5%;
                    top: 25%;
                    text-align: center;
                    font-style: italic;
                }
                .img_card{
                    position: absolute;
                    width: 80%;
                    height: 10%;
                    top: 30%;
                    left: 10%;
                    text-align: center;
                    border: 1px  solid  #000000;
                }
                .img_card input{
                    position: absolute;
                    width: 100%;
                    height: auto;
                    left: 20%;
                    top: 15%;
                }
                .img_container{
                    position: absolute;
                    width: 80%;
                    height: 60%;
                    top: 40%;
                    left: 10%;
                    text-align: center;
                    border: 1px  solid  #000000;
                }
                    .img_container img{
                        margin: 5px;
                        width: 80%;
                        max-height: 100%;
                    }
            .bottom_div{
                position: absolute;
                width: 100%;
                height: 10%;
                top: 90%;
            }
                .bottom_div button{
                    position: absolute;
                    left: 45%;
                }
        </style>
    </head>
    <body>
        <div class="product_popup" id="editProduct_popup">
            <div class="info_card">
                <a href="ProductManagementPage.php"><i class="fa fa-times close_btn" aria-hidden="true"></i></a>
                <h3>Sửa thông tin sản phẩm</h3>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="left_div">
                            <div class="form_group" style="top: 5%">
                                <label for="usr">Tên sản phẩm:</label>
                                <input required="true" type="text" id="usr" name="name" value="<?=$name?>">
                                <input type="text" name="id" value="<?=$id?>" hidden="true">
                            </div>
                            
                            <div class="product_type" style="position: absolute; width: 50%; height: 8%; top: 17%; left:10%">
                                <label for="status">Loại SP:</label>
                                <select class="form-control" name="category_id" id="category_id" required="true">
                                    <?php
                                        foreach($categoryItems as $category) {
                                            if($category['id'] == $category_id) {
                                                echo '<option selected value="'.$category['id'].'">'.$category['title'].'</option>';
                                            } else {
                                                echo '<option value="'.$category['id'].'">'.$category['title'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="product_status" style="position: absolute; width: 25%; height: 8%; top: 17%; left:65%">
                                <select class="form-control" name="status_product_id" id="status_product_id" required="true">
                                    <?php
                                        foreach($statusList as $status) {
                                            if($status['id'] == $status_product_id) {
                                                echo '<option selected value="'.$status['id'].'">'.$status['status'].'</option>';
                                            } else {
                                                echo '<option value="'.$status['id'].'">'.$status['status'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="size_div_wrap">

                                <label> Giá: </label>

                                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top: 0;">
                                    <label>Free-size</label>
                                    <input type="number" name="price_free_size" <?php if ($price_free_size > 0) {
                                        echo ' value ="'.$price_free_size.'"';
                                    }?>>
                                </div>

                                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top:25%;">
                                    <label>Lớn</label>
                                    <input type="number"  name="price_l" <?php if ($price_l > 0) {
                                        echo ' value ="'.$price_l.'"';
                                    }?>>
                                </div>

                                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top:50%;">
                                    <label >Vừa</label>
                                    <input type="number"   name="price_m" <?php if ($price_m > 0) {
                                        echo ' value ="'.$price_m.'"';
                                    }?>>
                                </div>

                                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top: 75%;">
                                    <label>Nhỏ</label>
                                    <input type="number"   name="price_s" <?php if ($price_s > 0) {
                                        echo  ' value ="'.$price_s.'"';
                                    }?>>
                                </div>
                            </div>
                            <div class="description_div">
                                <label for="description" style="position:absolute; width:20%; left:10%">Mô tả:</label>
                                <input required="true" type="text" id="description" name="description" value="<?=$description?>">
                            </div>
                            <div class="meal_div_wrap">
                                <div class="meal_div" style="position: absolute; width: 25%; height: 100%; left:10%;">
                                    <label >Bữa sáng</label>
                                    <input type="checkbox" name="meal[]" value = "1" <?php 
                                        $sql = 'SELECT COUNT(*) as "count" FROM meal_detail WHERE product_id = '.$id.' AND meal_id = 1';
                                        $result = getArrResult($sql)['count'];
                                        if ($result > 0) {
                                            echo 'checked';
                                        }
                                    ?>>
                                </div>
                                <div class="meal_div"style="position: absolute; width: 25%; height: 100%; left:40%;">
                                    <label >Bữa trưa</label>
                                    <input type="checkbox" name="meal[]" value = "2" <?php 
                                        $sql = 'SELECT COUNT(*) as "count" FROM meal_detail WHERE product_id = '.$id.' AND meal_id = 2';
                                        $result = getArrResult($sql)['count'];
                                        if ($result > 0) {
                                            echo 'checked';
                                        }
                                    ?>>
                                </div>
                                <div class="meal_div" style="position: absolute; width: 25%; height: 100%; left:70%;">
                                    <label >Bữa tối</label>
                                    <input type="checkbox" name="meal[]" value = "3" <?php 
                                        $sql = 'SELECT COUNT(*) as "count" FROM meal_detail WHERE product_id = '.$id.' AND meal_id = 3';
                                        $result = getArrResult($sql)['count'];
                                        if ($result > 0) {
                                            echo 'checked';
                                        }
                                    ?>>
                                </div>
                            </div>
                        </div>
                        <div class="right_div">
                            <div class = "select_menu">

                                <label for="" >Menu:</label>
                                <div class="menu_div" style="position: absolute;width: 40%; height: 25%; left:20%">
                                    <label >Khai vị</label>
                                    <input type="checkbox" name="menu[]" value = "1" <?php 
                                        $sql = 'SELECT COUNT(*) as "count" FROM menu_detail WHERE product_id = '.$id.' AND menu_id = 1';
                                        $result = getArrResult($sql)['count'];
                                        if ($result > 0) {
                                            echo 'checked';
                                        }
                                    ?>>
                                </div>
                                
                                <div class="menu_div" style="position: absolute;width: 40%; height: 25%; left:60%">
                                    <label >Món chính</label>
                                    <input type="checkbox" name="menu[]" value = "2" <?php 
                                        $sql = 'SELECT COUNT(*) as "count" FROM menu_detail WHERE product_id = '.$id.' AND menu_id = 2';
                                        $result = getArrResult($sql)['count'];
                                        if ($result > 0) {
                                            echo 'checked';
                                        }
                                    ?>>
                                </div>   
                                
                                <div class="menu_div" style="position: absolute;width: 40%; height: 25%; left:20%; top: 30%">
                                    <label >Tráng miệng</label>
                                    <input type="checkbox" name="menu[]" value = "3" <?php 
                                        $sql = 'SELECT COUNT(*) as "count" FROM menu_detail WHERE product_id = '.$id.' AND menu_id = 3';
                                        $result = getArrResult($sql)['count'];
                                        if ($result > 0) {
                                            echo 'checked';
                                        }
                                    ?>>
                                </div>
                                
                                <br>
                                <div class="menu_div" style="position: absolute;width: 40%; height: 25%; left:60%; top: 30%">
                                    <label >Món chay</label>
                                    <input type="checkbox" name="menu[]" value = "4" <?php 
                                        $sql = 'SELECT COUNT(*) as "count" FROM menu_detail WHERE product_id = '.$id.' AND menu_id = 4';
                                        $result = getArrResult($sql)['count'];
                                        if ($result > 0) {
                                            echo 'checked';
                                        }
                                    ?>>
                                </div>
                                
                                <div class="menu_div" style="position: absolute;width: 40%; height: 25%; left:20%; top: 60%">
                                    <label >Dành cho trẻ em</label>
                                    <input type="checkbox" name="menu[]" value = "5" <?php 
                                        $sql = 'SELECT COUNT(*) as "count" FROM menu_detail WHERE product_id = '.$id.' AND menu_id = 5';
                                        $result = getArrResult($sql)['count'];
                                        if ($result > 0) {
                                            echo 'checked';
                                        }
                                    ?>>
                                </div>
                                
                            </div>
                            <div class="title_of_img_card">
                                <label for="image">Hình ảnh sản phẩm:</label>
                            </div>
                            <div class="img_card">
                                <input name="image" id="image" type="file" accept="image/*" onchange="loadFile(event)">
                            </div>
                            <div class="img_container">
                                <?php 
                                    echo '<img id="output"  src="../../masterial/image/thuc_don/'.$image.'"/>';
                                ?>
                                <script>
                                    var loadFile = function(event) {
                                        var output = document.getElementById('output');
                                        output.src = URL.createObjectURL(event.target.files[0]);
                                        output.onload = function() {
                                        URL.revokeObjectURL(output.src) // free memory
                                        }
                                    };
                                </script>
                            </div>
                            
                        </div>
                        <div class="bottom_div">
                            <button class="btn btn-success" name="confirm">Xác Nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

