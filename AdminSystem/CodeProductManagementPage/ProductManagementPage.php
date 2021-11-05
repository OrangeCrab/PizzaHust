<?php
    require_once('../../database/dbhelper.php');
	$baseUrl = '../';
    // chay cau lenh sql để lấy tên loại sản phẩm sử dụng lệnh join bảng
	$sql = "select product.*, category.name as category_name , status.status as status_name from ((product 
    left join category on product.category_id = category.id )
    left join status on product.status_id = status.id)";
	$data = executeResult($sql);

    $title = 'Thêm/Sửa Sản Phẩm';
	$baseUrl = '../';

	$id = $msg = $title = $price = $weight = $status_id = $category_id = $date = $thumbnail = $description='';

    require_once('../../database/utility.php');
	require_once('form_save.php');
 

	require_once('../../database/define.php');
	require_once('../../database/dbhelper.php');

	// sửa/thêm sản phẩm
	// khi click vào sửa sản phẩm thì sẽ gửi lên server 1 cái ID
	// lúc đấy thì mình sẽ sử dụng lệnh getGet(trong file utility.php) để lấy ID đấy về
	// Nếu có ID được lấy về thì tức là lệnh sửa 
	// còn nếu không( ID = null) thì đấy là lệnh thêm
	$id = getGet('id');
    //echo $id;
   	if($id != '' && $id > 0) {
		// có nghĩa là lệnh sửa sản phẩm
		$sql = "select * from product where id = '$id' ";
		// mình sẽ select * từ sản phẩm có mã ID bằng với mã ID mà mình vừa GET
		// lưu vào 1 mảng tạm 
		// gán các biến là các giá trị trong mảng đó
		//executeResult($sql) = executeResult($sql);
		if(getArrResult($sql) != null) {
			$category_id = getArrResult($sql)['category_id'];
			$price = getArrResult($sql)['price'];
			$title = getArrResult($sql)['title'];
			$weight = getArrResult($sql)['weight'];
			$status_id = getArrResult($sql)['status_id'];
			$description = getArrResult($sql)['description'];
            $thumbnail = getArrResult($sql)['thumbnail'];
            
		} else {
			$id = 0;
		}
	} else {
		$id = 0;
	}

	$sql = "select * from category";
	//var_dump($sql);
	$categoryItems = executeResult($sql);
	$sql = " select *from status ";
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
        <link rel="stylesheet" href="product_management.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
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
                <a href="../CategoryManagementPage/CategoryManagement.php"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Danh Mục Món Ăn</span></a>
                <a href="#" class="active"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Món Ăn</span></a>
                <a href="../InvoiceManagementPage/InvoiceManagementPage.html"><i class="fa fa-cube" aria-hidden="true"></i><span>Đơn Hàng</span></a>
            </div>
            
            <div id="main_center_panel">
                <div class="head">
                    <div id="h1">Danh sách sản phẩm</div>
                    <div class="timkiem">
                        <img src="../../masterial/image/iconAdminPage/searchLogo.svg" alt="TimKiem" id="search_icon">
                        <input type="text" placeholder="Tìm kiếm" id="search_tf"/>
                    </div>
                    <div class="wrap_btn">
                        <!-- <a href="#editProduct_popup"></a> -->
                        <button class="btn btn-success add_button">Thêm sản phẩm</button>
                    </div>
                    
                </div>                 
                
                <div id="table_panel">
                    
                    <table class="table table-bordered table-hover" >
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
                            <?php
                                $index = 0;
                                foreach($data as $item) {
                                    echo '<tr>
                                    <td>'.(++$index).'</td>
                                    <td><img src="'.$item['thumbnail'].'" style="height: 100px; width: 100px;"/></td>
                                    <td>'.$item['title'].'</td>
                                    <td>'.$item['description'].'</td>
                                    <td>'.$item['status_name'].'</td>
                                    <td>'.number_format($item['price']).' VNĐ</td>
                                    <td>'.$item['category_name'].'</td>
                                    <td style="width: 20px">
                                    <a href="editProductPopup.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
                                    </td>
                                    <td style="width: 20px">
                                    <button onclick="deleteProduct('.$item['id'].')" class="btn btn-danger">Xoá</button>
                                    </td>
                                    </tr>';
                                }
                            ?>
                        
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
                        <div class="form_group" style="top: 5%">
                            <label for="usr">Tên sản phẩm:</label>
                            <input required="true" type="text" class="form-control" id="usr" name="title" value="<?=$title?>">
                            <input type="text" name="id" value="<?=$id?>" hidden="true">
                        </div>
                        
                        <div class="form_group" style="top: 15%">
                            <label for="usr">Loại Sản Phẩm:</label>
                            <select class="form-control" name="category_id" id="category_id" required="true">
                                <option value="">-- Chọn --</option>
                                <?php
                                    foreach($categoryItems as $category) {
                                        if($category['id'] == $category_id) {
                                            echo '<option selected value="'.$category['id'].'">'.$category['name'].'</option>';
                                        } else {
                                            echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form_group" style="top: 25%">
                            <label for="description">Mô tả sản phẩm:</label>
                            <input required="true" type="text" class="form-control" id="description" name="description" value="<?=$description?>">
                        </div>
                        
                        <div class="form_group"style="top: 35%">
                            <label for="status">Trạng thái:</label>
                            <select class="form-control" name="status_id" id="status_id" required="true">
								<option value="">-- Chọn --</option>
								<?php
									foreach($statusList as $status) {
										if($status['id'] == $status_id) {
											echo '<option selected value="'.$status['id'].'">'.$status['status'].'</option>';
										} else {
											echo '<option value="'.$status['id'].'">'.$status['status'].'</option>';
										}
									}
								?>
							</select>
                        </div>
                        <div class="form_group" style="top: 45%">
                            <label for="price">Giá:</label>
                            <input required="true" type="number" class="form-control" id="price" name="price" value="<?=$price?>">
                        </div>
                        
                        <div class="form_group" style="top: 55%">
                            <label for="weight">Khối lượng:</label>
                            <input required="true" type="number" class="form-control" id="weight" name="weight" value="<?=$weight?>">
                        </div>
                        <div class="form_group" style="top: 65%">
                            <label for="thumbnail">Hình ảnh sản phẩm:</label>
                            <input required="true" type="text" class="form-control" id="thumbnail" name="thumbnail" value="<?=$thumbnail?>">
                        </div>     
                        <div class="cfbtn_div" style="top: 85%">
                            <button class="btn btn-success">Xác Nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="product_management.js"></script>
    </body>
</html>
        <script type="text/javascript">
            function deleteProduct(id) {
                option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
                if(!option) return;

                $.post('form_api.php', {
                    'id': id,
                    'action': 'delete'
                }, function(data) {
                    location.reload()
                })
        }
</script>
       
 