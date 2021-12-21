<?php
	$id = $msg = $name = $price  = $category_id = $image = $description = $price_free_size = $price_s= $price_m = $price_l ='';
    $count_menu = '';

    require_once('../../database/utility.php');   
	require_once('../../database/define.php');
	require_once('../../database/dbhelper.php');
	require_once('form_save.php');

	$id = getGet('id');
    
   	if($id != '' && $id > 0) {
	
		$sql = "select * from product where id = '$id' ";
	
		if(getArrResult($sql) != null) {
			$category_id = getArrResult($sql)['category_id'];
			$price = getArrResult($sql)['price'];
			$name = getArrResult($sql)['name'];
			$description = getArrResult($sql)['description'];
            $image = getArrResult($sql)['image'];
            
		} else {
			$id = 0;
		}
	} else {
		$id = 0;
	}

	$sql = "select * from category";
	$categoryItems = executeResult($sql);

    $sql = "SELECT COUNT(*) FROM menu";
    $count_menu = getArrResult($sql)['COUNT(*)'];
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
        <link rel="stylesheet" href="product_management.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

        <script src="jquery.tabledit.min.js"></script>            
        <title>Product Management</title>
    </head>
    <body>
        <header class="scroll">
            <img class="img" src="../../masterial/image/bgrAdminPage/topBgr.jpg" alt="top">
            <div class="top_bar">
                <img class="logo_name" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
                <a href="../login_form.php" class="logout_btn">Logout</a>
            </div>
        </header>
        

        <div class="work_screen">
            <div class="left_bar scroll">
                <a href="../DashBoard/DashBoard.html"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Tổng Quan</span></a>
                <a href="#" class="active"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Món Ăn</span></a>
                <a href="../InvoiceManagementPage/InvoiceManagementPage.html"><i class="fa fa-cube" aria-hidden="true"></i><span>Đơn Hàng</span></a>
            </div>
            
            <div id="main_center_panel">
                <div class="head">
                    <div id="h1">Danh sách sản phẩm</div>
                    <div class="filter_wrap">
                        <select class="form-control" name="filter" id="filter" required="true" method="post">
                            <option value="">Tất cả</option>
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
                        <input type="hidden" name="category_selected" id="category_selected" />
                    </div>
                    <div class="timkiem">
                        <div class="search_logo"></div>  
                        <input type="text" placeholder="Tìm kiếm" id="search_tf" name = "search_tf"/>
                    </div>
                    <div class="wrap_btn">
                        <button class="btn btn-success add_button">Thêm sản phẩm</button>
                    </div> 
                    <div class="wrap_plinth">
                        <a href="plinth.php"><button class="btn" style="color:white">Đế Pizza</button></a>
                    </div>
                </div>                 
                
                <div id="table_panel">
                    <table class="table table-bordered table-hover" id="main_table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Giá</th>
                                <th>Loại</th>
                                <th style="width: 30px"></th>
					            <th style="width: 30px"></th>                              
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>   
                    </table>
                </div>
        </div>
        <div class="product_popup" id="editProduct_popup">
            <div class="info_card">
                <a><i class="fa fa-times close_btn" aria-hidden="true"></i></a>
                <h3>Thêm sản phẩm</h3>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="left_div">
                            <div class="form_group" style="top: 5%">
                                <label for="usr">Tên sản phẩm:</label>
                                <input required="true" type="text" id="usr" name="name" value="<?=$name?>">
                                <input type="text" name="id" value="<?=$id?>" hidden="true">
                            </div>
                            
                            <div class="form_group" style="top: 18%">
                                <label for="usr">Loại sản phẩm:</label>
                                <select class="form-control" name="category_id" id="category_id" required="true">
                                    <option value="">-- Chọn --</option>
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
                            <div class="size_div_wrap">

                                <label> Giá: </label>

                                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top: 0;">
                                    <label>Free-size</label>
                                    <input type="number" name="price_free_size">
                                </div>

                                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top:25%;">
                                    <label>Lớn</label>
                                    <input type="number"  name="price_l">
                                </div>

                                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top:50%;">
                                    <label >Vừa</label>
                                    <input type="number"   name="price_m">
                                </div>

                                <div class="size_div" style="position: absolute; width: 70%; height: 20%; left: 30%; top: 75%;">
                                    <label>Nhỏ</label>
                                    <input type="number"   name="price_s">
                                </div>
                            </div>
                            <div class="description_div">
                                <label for="description" style="position:absolute; width:20%; left:10%">Mô tả:</label>
                                <input required="true" type="text" id="description" name="description" value="<?=$description?>">
                            </div>
                            <div class="meal_div_wrap">
                                <div class="meal_div" style="position: absolute; width: 25%; height: 100%; left:10%;">
                                    <label >Bữa sáng</label>
                                    <input type="checkbox" name="meal[]" value = "1" >
                                </div>
                                <div class="meal_div"style="position: absolute; width: 25%; height: 100%; left:40%;">
                                    <label >Bữa trưa</label>
                                    <input type="checkbox" name="meal[]" value = "2">
                                </div>
                                <div class="meal_div" style="position: absolute; width: 25%; height: 100%; left:70%;">
                                    <label >Bữa tối</label>
                                    <input type="checkbox" name="meal[]" value = "3" >
                                </div>
                            </div>
                        </div>
                        <div class="right_div">
                            <div class = "select_menu">

                                <label for="" >Menu:</label>
                                <div class="menu_div" style="position: absolute;width: 40%; height: 25%; left:20%">
                                    <label >Khai vị</label>
                                    <input type="checkbox" name="menu[]" value = "1" >
                                </div>
                                
                                <div class="menu_div" style="position: absolute;width: 40%; height: 25%; left:60%">
                                    <label >Món chính</label>
                                    <input type="checkbox" name="menu[]" value = "2" >
                                </div>   
                                
                                <div class="menu_div" style="position: absolute;width: 40%; height: 25%; left:20%; top: 30%">
                                    <label >Tráng miệng</label>
                                    <input type="checkbox" name="menu[]" value = "3">
                                </div>
                                
                                <br>
                                <div class="menu_div" style="position: absolute;width: 40%; height: 25%; left:60%; top: 30%">
                                    <label >Món chay</label>
                                    <input type="checkbox" name="menu[]" value = "4">
                                </div>
                                
                                <div class="menu_div" style="position: absolute;width: 40%; height: 25%; left:20%; top: 60%">
                                    <label >Dành cho trẻ em</label>
                                    <input type="checkbox" name="menu[]" value = "5">
                                </div>
                                
                            </div>
                            <div class="title_of_img_card">
                                <label for="image">Hình ảnh sản phẩm:</label>
                            </div>
                            <div class="img_card">
                                <input name="image" id="image" required="true" type="file" accept="image/*" onchange="loadFile(event)">
                            </div>
                            <div class="img_container">
                                <img id="output"/>
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
        <script src="product_management.js"></script>
    </body>
</html>
 