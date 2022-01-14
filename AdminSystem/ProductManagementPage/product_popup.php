<?php
    session_start();
    if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == 0) {
        header('location: ../login_form.php');
        die();
    }
    require_once('../../database/utility.php');
    require_once('../../database/dbhelper.php');
    $id = getGet('id');
    if ($id != 0 && $id != '') {
        $sql = "select * from product where id = '$id' ";

        $category_id = getArrResult($sql)['category_id'];
        $name = getArrResult($sql)['name'];
        $status_product_id = getArrResult($sql)['status_product_id'];
        $description = getArrResult($sql)['description'];
        $image = getArrResult($sql)['image'];
        $price_free_size = getArrResult($sql)['price_free_size'];
        $price_s = getArrResult($sql)['price_s'];
        $price_m = getArrResult($sql)['price_m'];
        $price_l = getArrResult($sql)['price_l'];
    }else {
        $id = $name = $price  = $category_id = $image = $description = $price_free_size = $price_s= $price_m = $price_l = '';
    }
    $sql = "select * from category";
	$categoryItems = executeResult($sql);
    $sql = " select * from status_product ";
	$statusList = executeResult($sql);
?>
<div class="popup_close" onclick="closePopup()">&times;</div>
<?php 
    if ($id == '' || $id == 0) {
        echo '<h3 style="position: absolute; top: 5%; left: 35%; height: 5%;">Thêm sản phẩm</h3>';
    }else {
        echo '<h3 style="position: absolute; top: 5%; left: 30%; height: 5%;">Sửa thông tin sản phẩm</h3>';
    }
?>
<div class="panel-body">
    <form action="form_save.php" method="post" method="post" enctype="multipart/form-data">
        <div class="left_div">
            <div class="form_group" style="top: 3%">
                <label for="usr">Tên sản phẩm:</label>
                <input type="text" class="name" name="name" value="<?=$name?>">
                <input type="text" name="id" class="id" value="<?=$id?>" hidden="true">
            </div>
            <?php
                if ($id != '' && $id != 0) {
                    echo '
                    <div class="product_type" style="position: absolute; width: 50%; height: 8%; top: 20%; left:10%">
                        <label for="status">Loại SP:</label>
                        <select class="form-control" name="category_id" class="category_id">
                    ';
                    foreach($categoryItems as $category) {
                        if($category['id'] == $category_id) {
                            echo '<option selected value="'.$category['id'].'">'.$category['title'].'</option>';
                        } else {
                            echo '<option value="'.$category['id'].'">'.$category['title'].'</option>';
                        }
                    }
                    echo '
                        </select>
                    </div>
                    ';
                    echo '
                    <div class="product_status" style="position: absolute; width: 25%; height: 8%; top: 20%; left:65%">
                        <select class="form-control" name="status_product_id" class="status_product_id">
                    ';
                    foreach($statusList as $status) {
                        if($status['id'] == $status_product_id) {
                            echo '<option selected value="'.$status['id'].'">'.$status['status'].'</option>';
                        } else {
                            echo '<option value="'.$status['id'].'">'.$status['status'].'</option>';
                        }
                    }
                    echo '
                        </select>
                    </div>
                    ';
                }else {
                    echo '
                    <div class="form_group" style="top: 20%">
                        <label for="usr">Loại sản phẩm:</label>
                        <select class="form-control" name="category_id" class="category_id">
                    ';
                    foreach($categoryItems as $category) {
                        echo '<option value="'.$category['id'].'">'.$category['title'].'</option>';
                    }
                    echo '
                        </select>
                    </div>';
                }
            ?>
            
            <div class="size_div_wrap">

                <label> Giá: </label>

                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top: 0;">
                    <label>Free-size</label>
                    <input type="number" name="price_free_size" class="price_free_size" <?php if ($price_free_size > 0) {
                        echo ' value ="'.$price_free_size.'"';
                    }?>>
                </div>

                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top:25%;">
                    <label>Lớn</label>
                    <input type="number"  name="price_l" class="price_l" <?php if ($price_l > 0) {
                        echo ' value ="'.$price_l.'"';
                    }?>>
                </div>

                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top:50%;">
                    <label >Vừa</label>
                    <input type="number" name="price_m" class="price_m" <?php if ($price_m > 0) {
                        echo ' value ="'.$price_m.'"';
                    }?>>
                </div>

                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top: 75%;">
                    <label>Nhỏ</label>
                    <input type="number" name="price_s" class="price_s" <?php if ($price_s > 0) {
                        echo  ' value ="'.$price_s.'"';
                    }?>>
                </div>
            </div>
            <div class="description_div">
                <label for="description" style="position:absolute; width:20%; left:10%">Mô tả:</label>
                <input type="text" class="description" name="description" value="<?=$description?>">
            </div>
        </div>
        <div class="right_div">
            <div class = "upload_img">
                <div class="title_of_img_card">
                    <label for="image">Hình ảnh sản phẩm:</label>
                </div>
                <div class="img_card">
                    <input name="image" id="image" type="file" accept="image/*" onchange="loadFile(event)">
                </div>
                <div class="img_container">
                    <?php
                        if ($id != '' && $id != 0) {
                            echo '<img id="output"  src="../../masterial/image/thuc_don/'.$image.'"/>';
                        } else {
                            echo '<img id="output"/>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="bottom_div">
            <button class="btn btn-success" name="confirm">Xác Nhận</button>
        </div>
    </form>
</div>