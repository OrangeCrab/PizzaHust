<?php
    require_once('get_data.php');
    
    session_start();
    if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == 0) {
        header('location: ../login_form.php');
        die();
    }

    $query = "SELECT * FROM product";

    $sql = "select * from category";
	$categoryItems = executeResult($sql);

    $query_get_pbs = "select * from plinth";
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="product_management.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <title>Product Management</title>
    </head>
    <body>
        <header class="scroll">
            <img class="img" src="../../masterial/image/bgrAdminPage/topBgr.jpg" alt="top">
            <div class="top_bar">
                <img class="logo_name" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
                <form action="form_save.php" method="post">
                    <input type="text" name="logout" id="logout" value="logout" style="display: none;">
                    <button type="submit" class="logout_btn">Logout</button>
                </form>
            </div>
        </header>
        <div class="left_bar scroll">
            <a href="../DashBoard/DashBoard.php"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Tổng Quan</span></a>
            <a href="#" class="active"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Sản Phẩm</span></a>
            <a href="../InvoiceManagementPage/InvoiceManagement.php"><i class="fa fa-cube" aria-hidden="true"></i><span>Đơn Hàng</span></a>
            <a href="../Coupon/coupon.php" ><i class="fa fa-barcode" aria-hidden="true"></i><span>Khuyến Mãi</span></a>
        </div>
        <div id="main_center_panel">
            <div class="head">
                <div id="h1">Danh sách sản phẩm</div>
                <div class="filter_wrap">
                    <select class="form-control" name="filter" id="filter" required="true" onclick="filterByCategory()">
                        <option value="">Tất cả</option>
                        <?php
                            foreach($categoryItems as $category) {
                                echo '<option value="'.$category['id'].'">'.$category['title'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="timkiem">
                    <div class="search_logo"></div>  
                    <input type="text" placeholder="Tìm kiếm" id="search_tf" name = "search_tf" onkeyup="filterByName()"/>
                </div>
                <div class="wrap_btn">
                    <a href="#"><button class="btn btn-success add_button" id="add_button" onclick="addProduct()">Thêm sản phẩm</button></a>
                </div> 
                <div class="wrap_plinth">
                    <a href="#"><button class="btn btn-success" onclick="openPizzaBase()">Đế Pizza</button></a>
                </div>
            </div>                 
            
            <div id="table_panel">
                <table class="table table-bordered table-hover" id="main_table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th>Giá</th>
                            <th>Loại</th>
                            <th></th>
                            <th></th>                              
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            loadData($query);
                        ?>
                    </tbody>   
                </table>
            </div>
        </div>
        
        <div class="product_popup" id="editProduct_popup">
            <div class="info_card" id="info_card"></div>
            <div class="info_card" id="edit_info_card"></div>
            <div class="info_card" id="pizza_base_info_card">
                <div class="popup_close" onclick="closePopup()">&times;</div>
                <h3 style="position: absolute; top: 5%; left: 45%; height: 5%;">Đế Pizza</h3>
                <div class="panel-body">
                    <div class="left_panel_body">
                        <table id="editable_table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Giá (VNĐ)</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    getPizzaBase($query_get_pbs);
                                ?>
                            </tbody>
                        </table>         
                    </div>
                    <div class="right_panel_body">
                        <div class="title_div">
                            <h1 style="font-family: Monsterrat; font-size: 20px;">Thêm đế pizza</h1>
                        </div>
                        <div class="form_div">
                            <div class="name_div">
                                <label for="name" style="font-family: Monsterrat;">Tên sản phẩm:</label>
                                <input required="true" type="text" class="form-control" id="name" name="name" style="font-size: 15px">
                            </div>
                            <div class="price_div" style="margin-top: 5%">
                                <label for="price" style="font-family: Monsterrat;">Giá:</label>
                                <input required="true" type="text" class="form-control" id="price" name="price"style="font-family: Monsterrat;font-size: 15px">
                            </div>
                            <div class="button_add_plinth">
                                <button class="btn btn-success add_pbBtn" name="add_btn" style="font-family: Monsterrat;">Thêm</button>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
        <script src="product_management.js"></script>
    </body>
</html>