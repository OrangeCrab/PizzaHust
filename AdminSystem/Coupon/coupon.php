<?php
    session_start();
    if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == 0){
        header('location: ../login_form.php');
        die();
    }

    require 'controller_cp.php';
    //phan trang
    $limit = 10;
    $page = 1;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    if($page <= 0){
        $page = 1;
    }
    $firstIndex = ($page - 1)*$limit;
    // $coupon = get_coupon();
    $sql = "SELECT * from `coupon` where 1 ORDER BY id_cp desc limit ".$firstIndex.",".$limit;
    $coupon = executeResult($sql);
    $sql = "SELECT count(id_cp) as total_cp from `coupon` ";
    $coutResult = getArrResult($sql);
    $count = $coutResult['total_cp'];
    $numberPages = ceil($count/$limit);
    //------

    if (!empty($_POST['add_coupon']))
    {
        // Lay data
        // print_r($_POST['id_cp']);
        $data['id_cp']         = isset($_POST['id_cp']) ? $_POST['id_cp'] : '';
        $data['name_cp']         = isset($_POST['name_cp']) ? $_POST['name_cp'] : '';
        $data['type_cp']    = isset($_POST['type_cp']) ? $_POST['type_cp'] : '';
        $data['code_cp']    = isset($_POST['code_cp']) ? $_POST['code_cp'] : '';
        $data['value_cp']    = isset($_POST['value_cp']) ? $_POST['value_cp'] : '';
        $data['description']    = isset($_POST['description']) ? $_POST['description'] : '';
        $data['active_date']    = isset($_POST['active_date']) ? $_POST['active_date'] : '';
        $data['expire_date']    = isset($_POST['expire_date']) ? $_POST['expire_date'] : '';
        $data['min_order_value']    = isset($_POST['min_order_value']) ? $_POST['min_order_value'] : '';
        $data['max__order_amount']    = isset($_POST['max__order_amount']) ? $_POST['max__order_amount'] : '';
        

        if($data['id_cp'] == ''){
            add_coupon( $data['name_cp'], $data['type_cp'], $data['code_cp'], $data['value_cp'] ,$data['description'],
            $data['active_date'], $data['expire_date'], $data['min_order_value'], $data['max__order_amount']);
        }else{
            update_coupon($data['id_cp'], $data['name_cp'], $data['type_cp'], $data['code_cp'], $data['value_cp'], $data['description'],
            $data['active_date'], $data['expire_date'], $data['min_order_value'], $data['max__order_amount']);
        }
        // die();
        header("location: coupon.php?page=".$page."");
        die();

    }

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

    <header>
        <img class="img" src="../../masterial/image/bgrAdminPage/topBgr.jpg" alt="top">
        <div class="top_bar">
            <img class="logo_name" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
            <form action="" method="post">
                <input type="text" name="logout" id="logout" value="logout" style="display: none;">
                <button type="submit" class="logout_btn">Logout</button>
            </form>
            <?php 
                if (isset($_POST['logout'])){
                    $_SESSION['admin_id'] = 0;
                    header('location: ../login_form.php');
                    die();
                }
            ?>
        </div>
    </header>

        <div class="work_screen">
            <div class="left_bar scroll">
                <a href="../DashBoard/DashBoard.php" target="_self"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Tổng Quan</span></a>
                <a href="../ProductManagementPage/ProductManagementPage.php"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Món Ăn</span></a>
                <a href="../InvoiceManagementPage/InvoiceManagementPage.html"><i class="fa fa-cube" aria-hidden="true"></i><span>Đơn Hàng</span></a>
                <a href="#" class="active"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Mã khuyến mãi</span></a>
            </div>

            <div id="main_center_panel">
                <!-- lamf tiếp vào đây -->

                <div class="head">
                    <div id="h1">Danh sách mã khuyến mãi</div>
                    
                    <div class="wrap_btn">
                        <button class="btn btn-success add_button">Thêm khuyen mai</button>
                    </div> 

                    <!-- <div class="wrap_plinth">
                        <a href="addcp.php"><button class="btn" style="color:white">Đế Pizza</button></a>
                    </div> -->
                </div>   

                <div id="table_panel">
                    <table class="table table-bordered table-hover" id="main_table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Mã</th>
                                <th>Code</th>
                                <!-- <th>Loại </th> -->
                                <th>Giá trị</th>
                                <th>Ngày bắt đầu</th> 
                                <th>Ngày kết thúc</th>
                                <th>Mô tả</th>                         
                                <!-- <th>Trạng thái</th>   -->
                                <th style="width: 20px"></th>
                                <th style="width: 20px"></th>              
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($coupon as $item){ ?>
                            <tr>
                                <td><?php echo $item['id_cp']; ?></td>
                                <td><?php echo $item['name_cp']; ?></td>
                                <td><?php echo $item['code_cp']; ?></td> 
                                <!-- <td><?php echo $item['type_cp']; ?></td>  -->
                                <td><?php echo value_coupon($item['value_cp'],$item['type_cp']); ?></td> 
                                <td><?php echo date("h:m  d-m-Y", strtotime($item['active_date'])); ?></td> 
                                <td><?php echo date("h:m  d-m-Y", strtotime($item['expire_date'])); ?></td> 
                                <td><?php echo $item['description']; ?></td>
                                <td style="width: 20px">
                                <!-- <a href="<?php echo "form.php?id=".$item['id_cp'];?>"><button class="btn btn-warning">Sửa</button></a> -->
                                <button onclick="editCoupon(<?php echo (int)$item['id_cp']; ?>)" class="btn btn-warning add_button">Sửa</button>
                                <script>
                                    // hiển thị edit sản phẩm coupon id=?
                                    function editCoupon(id){

                                        document.getElementById('active_date').min = '';
                                        console.log("id =", document.getElementById('active_date').min);

                                        $.ajax({ url: 'ajaxcp.php',
                                                data: {'action': 'edit', 'id': id},
                                                dataType: "json",
                                                type: 'post',
                                                success: function(relust) {
                                                    // console.log("succsecful edit id = ",relust['id_cp']);
                                                    document.getElementById('id_cp').value = relust['id_cp'];
                                                    document.getElementById('name_cp').value = relust['name_cp'];
                                                    document.getElementById('code_cp').value = relust['code_cp'];
                                                    document.getElementById('value_cp').value = relust['value_cp'];
                                                    document.getElementById('active_date').value = (relust['active_date']).replaceAll( ' ', 'T').slice(0, 16);
                                                    document.getElementById('expire_date').value = relust['expire_date'].replaceAll( ' ', 'T').slice(0, 16);
                                                    document.getElementById('description').value = relust['description'];
                                                    document.getElementById('type_cp').value = relust['type_cp'];
                                                    document.getElementById('max__order_amount').value = relust['max__order_amount'];
                                                    setvalue_cp();
                                                }
                                        });
                                    }
                                </script>
                                </td>
                                <td style="width: 20px">
                                <button onclick="deleteCoupon(<?php echo (int)$item['id_cp']; ?>)" class="btn btn-danger">Xoá</button>
                                </td>
                                
                            </tr>

                        <?php } ?> 
                        </tbody>   
                    </table>
                    <?php 
                    if($numberPages > 1){
                        echo '<ul class="pagination">';
                        if($page > 1){
                            echo '<li class="page-item"><a class="page-link" href="?page='.($page-1).'">Previous</a></li>';
                        }      

                        $showPages = [1, $page-1, $page, $page+1, $numberPages];
                        $isFirst = $isLast = false;
                        for($i = 1; $i <= $numberPages; $i++){
                            if(!in_array($i, $showPages) && ($numberPages > 10)) {
                                if(!$isFirst && $page > 3){
                                    echo '<li class="page-item "><a class="page-link" href="?page='.($page-2).'">...</a></li>';
                                    $isFirst = true;
                                }
                                if(!$isLast && ($i-1 > $page)){
                                    echo '<li class="page-item "><a class="page-link" href="?page='.($page+2).'">...</a></li>';
                                    $isLast = true;
                                }
                                continue;
                            
                            }
                            if($page == $i){
                                echo '<li class="page-item active"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                            }else{
                                echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
                           }
                        }

                        if($page < $numberPages){
                            echo '<li class="page-item"><a class="page-link" href="?page='.($page+1).'">Next</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="product_popup" id="Product_popup">
            <div class="testbox" id="testbox">
                <form class="form_cp"  method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_cp" id="id_cp" />

                    <div class="banner">
                    <h1>Mã khuyến mãi</h1>
                    </div>
                    <div class="item">
                    <p>Tên Mã</p>
                    <input type="text" name="name_cp" id="name_cp" required/>
                    
                    </div>
                    <div class="item">
                        <p>Mã</p>
                        <div class="name-item">
                            <input type="text" name="code_cp" id= "code_cp" maxlength="10" required/>
                            <input type="button"  onclick="autoCoupon()" value="Tạo mã" id= "btn_code">
                            <script type="text/javascript">
                                function autoCoupon(length = 10){
                                    var result           = '';
                                    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                                    var charactersLength = characters.length;
                                    for ( var i = 0; i < length; i++ ) {
                                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                                    }
                                    document.getElementById("code_cp").value = result;
                                }
                            </script>
                        </div>
                    </div>
                    <div class="item">
                    <p>Hạn sử dụng</p>
                    <div class="name-item">
                        <input type="datetime-local" name="active_date"  id="active_date" placeholder="Từ" onchange=" cicl()" required/>
                        <input type="datetime-local" name="expire_date" id="expire_date" placeholder="Đến" required />
                        <script>
                            const d = new Date();
                            // console.log(d.toISOString().slice(0, 16));
                            let dateInput = document.getElementById("active_date");
                            dateInput.min = d.toISOString().slice(0, 16) ;
                            // if(dateInput.change)
                            function cicl(){
                                // console.log("từ: ",document.getElementById("active_date").value);
                                document.getElementById("expire_date").min = document.getElementById("active_date").value;
                            }
                        </script>
                    </div>
                    </div>
                    <div class="item">
                        <p>Giá trị mã khuyến mãi</p>
                        <div class="city-item">
                        <input type="number" name="value_cp" value="" id="value_cp" min = "0" required/>
                        <select name="type_cp" value="" id="type_cp"  onchange="setvalue_cp()" required>
                            <option value="0" >Theo phần trăm</option>
                            <option value="1" >Cố dịnh</option>
                        </select>
                        <script>
                            let type_cp = document.getElementById("type_cp");
                            let value_cp = document.getElementById("value_cp");
                            if(type_cp.value == "0"){
                                    console.log("Loai cp: ",type_cp.value );
                                    
                                    value_cp.max = 100;

                                }else if(type_cp.value == "1"){
                                    value_cp.max = null;
                                }
                                console.log(" dèuale min cp: ",value_cp.min," - ", value_cp.max);

                            function setvalue_cp(){

                                if(type_cp.value == "0"){
                                    console.log("Loai cp: ",type_cp.value );
                                    
                                    value_cp.max = 100;
                                    console.log("min cp: ",value_cp.min," - ", value_cp.max);

                                }else if(type_cp.value == "1"){
                                    value_cp.max = null;
                                }
                                console.log(" dèuale min cp: ",value_cp.min," - ", value_cp.max);

                            }
                        </script>
                        </div>
                    </div>
                    <div class="item">
                    <p>Đơn tối thiểu</p>
                    <input type="number" name="min_order_value" id="min_order_value"  value=""/>
                    </div>
                    
                    <!-- <div class="item">
                    <p>Gioi han</p>-->
                    <input type="hidden" name="max__order_amount" id="max__order_amount"  value=""/>
                    <!-- </div> --> 

                    <div class="item">
                    <p>Mô tả</p>
                    <textarea rows="4" name="description" id="description"></textarea>
                    </div>

                    <div class="btn-item">
                        <div class="btn-block">
                            <button type="submit" name ="add_coupon" value="Tạo">Xác nhận</button>
                            <button id="close_btn" class="close_btn" onclick="close_form()" >Hủy bỏ</button>
                            <script>
                                function close_form(){
                                    // console.log("eee");
                                    document.getElementById('id_cp').value = '';
                                    document.getElementById('name_cp').value = '';
                                    document.getElementById('code_cp').value = '';
                                    document.getElementById('value_cp').value = '';
                                    document.getElementById('active_date').value = '';
                                    document.getElementById('expire_date').value = '';
                                    document.getElementById('description').value = '';
                                    document.getElementById('type_cp').value = '0';
                                    document.getElementById('max__order_amount').value = '';
                                    }
                            </script>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="coupon.js"></script>
    </body>
</html>