<?php
require 'controller_cp.php';
$coupon = get_coupon();



?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="https://t004.gokisoft.com/uploads/2021/07/1-s-1637-ico-web.jpg">

         <!-- <link rel="stylesheet" href="dashboard.css"> -->
         <link rel="stylesheet" href="coupon.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
       
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

         <!-- jQuery library -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>

        <header class="scroll">
            <meta charset="UTF-8">
            <img class="img" src="../../masterial/image/bgrAdminPage/topBgr.jpg" alt="top">
            <div class="top_bar">
                <img class="logo_name" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
                <a href="../login_form.php" class="logout_btn">Logout</a>
            </div>
        </header>

        <div class="work_screen">
            <div class="left_bar scroll">
                <a href="#" class="active"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Tổng Quan</span></a>
                <a href="../CategoryManagementPage/CategoryManagement.php"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Danh Mục Món ăn</span></a>
                <a href="../CodeProductManagementPage/productManagementPage.php"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Món Ăn</span></a>
                <a href="../InvoiceManagementPage/InvoiceManagementPage.html"><i class="fa fa-cube" aria-hidden="true"></i><span>Đơn Hàng</span></a>
            </div>



            <div id="main_center_panel">
                <!-- lamf tiếp vào đây -->

                <div class="head">
                    <div id="h1">Danh sách ma khuyen mai</div>
                    <div class="filter_wrap">
                        <select class="form-control" name="filter" id="filter" required="true" method="post">
                            <option value="">Tất cả</option>
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
                        <input type="hidden" name="category_selected" id="category_selected" />
                    </div>
                    <div class="timkiem">
                        <div class="search_logo"></div>  
                        <input type="text" placeholder="Tìm kiếm" id="search_tf" name = "search_tf"/>
                    </div>
                    <div class="wrap_btn">
                        <button class="btn btn-success add_button">Thêm khuyen mai</button>
                    </div> 

                    <div class="wrap_plinth">
                        <a href="addcp.php"><button class="btn" style="color:white">Đế Pizza</button></a>
                    </div>
                </div>   



            <div id="table_panel">
                <table class="table table-bordered table-hover" id="main_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ma</th>
                            <th>Tên Mã</th>
                            <th>Giá trị</th>                         
                            <th>Ngày bắt đầu</th> 
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>                
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($coupon as $item){ ?>
                        <tr>
                            <td><?php echo $item['id_cp']; ?></td>
                            <td><?php echo $item['code_cp']; ?></td> 
                            <td><?php echo $item['name_cp']; ?></td>
                            <td><?php echo value_coupon( $item['code_cp']) ; ?></td>
                            <td><?php echo $item['active_date']; ?></td> 
                            <td><?php echo $item['expire_date']; ?></td> 
                            <td><?php echo status_coupon( $item['code_cp']) ; ?></td>
                            
                            
                        </tr>
                    <?php } ?> 

                    </tbody>   
                </table>
        </div>
            
        
    
    </body>
</html>