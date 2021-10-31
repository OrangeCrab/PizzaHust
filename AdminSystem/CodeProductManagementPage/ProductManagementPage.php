<?php
    require_once('../../database/dbhelper.php');
	$baseUrl = '../';
	$sql = "select product.*, category.name as category_name from product left join category on product.category_id = category.id ";
	$data = executeResult($sql);
?> 

<!DOCTYPE html>
<html>
    <head>
    <link rel="shortcut icon" href="https://t004.gokisoft.com/uploads/2021/07/1-s-1637-ico-web.jpg">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="product_management.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <title>Product Management</title>
    </head>
    <body>
        <header class="scroll">
            <img class="img" src="../../masterial/image/bgrAdminPage/topBgr.jpg" alt="top">
            <div class="top_bar">
                <img class="logo_name" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
                <a href="#" class="logout_btn">Logout</a>
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
                   
                    <a href="editor.php"><div id="add_button" class=" marginOf_feature_button" ><button class="btn btn-success" style="margin-left: 700px;">Thêm sản phẩm</button></div> </a> 
                </div>
                
                <div id="table_panel">
                    <div class="search">
                        <img src="../../masterial/image/iconAdminPage/searchLogo.svg" alt="TimKiem">
                        <input type="text" placeholder="Tìm kiếm"/>
                    </div>
               
                    <table class="table table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Giá</th>
                                <th>Loại sản phẩm</th>
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
                            <td>'.$item['status'].'</td>
					        <td>'.number_format($item['price']).' VNĐ</td>
					        <td>'.$item['category_name'].'</td>
					        <td style="width: 20px">
						    <a href="editor.php?id='.$item['id'].'"><button class="btn btn-warning">Sửa</button></a>
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
       
 