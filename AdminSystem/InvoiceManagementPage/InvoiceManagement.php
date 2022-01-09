<?php
    require_once('../../database/dbhelper.php');
	$baseUrl = '../';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

     <!-- jQuery library -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="invoice_management.css">
    <link rel="stylesheet" href="../ProductManagementPage/draft.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PizzaHust Admin</title>
</head>
<body>

    <!-- <img class="img" src="../../masterial/image/bgrAdminPage/topBgr.jpg" alt="top"> -->

    <header>
        <img class="img" src="../../masterial/image/bgrAdminPage/topBgr.jpg" alt="top">
        <div class="top_bar">
            <img class="logo_name" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
            <a href="#" class="logout_btn">Logout</a>
        </div>
    </header>

    <div class="work_screen">
        <div class="left_bar">
            <a href="../DashBoard/DashBoard.php" target="_self"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Tổng Quan</span></a>
            <a href="../ProductManagementPage/ProductManagementPage.php" target="_self"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Món Ăn</span></a>
            <a href="#" class="active"><i class="fa fa-cube" aria-hidden="true"></i><span>Đơn Hàng</span></a>
            <!-- <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>Báo Cáo</span></a> -->
        </div>

        <div class="main_center_panel">
            <h1>Danh sách đơn hàng</h1>

            <div class="table_wrap">
                <ul>
                    <li><button id="filterButtonAll" style="border-bottom: 3px solid #A80000;" onclick="filterStatus('')">Tất cả đơn hàng</button></li>
                    <li><button id="filterButtonWaiting" onclick="filterStatus('1')">Đơn hàng chờ xác nhận</button></li>
                    <li><button id="filterButtonConfirmed" onclick="filterStatus('2')">Đơn hàng đã xác nhận</button></li>
                    <li><button id="filterButtonRejected" onclick="filterStatus('3')">Đơn hàng bị hủy</button></li>
                </ul>

                <!-- <div class="Search DieuKienLoc">
                    <img src="../../masterial/image/iconAdminPage/screeningLogo.svg" alt="Loc">
                    <input type="text" placeholder="Thêm điều kiện lọc"/>
                </div> -->
                <div class="Search TimKiem">
                    <img src="../../masterial/image/iconAdminPage/searchLogo.svg" alt="TimKiem">
                    <select name="searchOption" id="searchOption" onchange="searchTable()">
                        <option>Mã</option>
                        <option>Ngày tạo</option>
                        <option>Khách hàng</option>
                        <option>Số điện thoại</option>
                        <option>Địa chỉ</option>
                        <option>Danh sách đặt hàng</option>
                        <option>Trạng thái</option>
                        <option>Tổng tiền</option>
                    </select>
                    <input id="searchInput" type="text" placeholder="Tìm kiếm" onkeyup="searchTable()"/>
                </div>

                <table id="OrderList" class="OrderList">
                    <tr class="Orderist_head">
                        <th onclick="sortTable('OrderList', 0)">Mã</th>
                        <th onclick="sortTable('OrderList', 1)">Thời gian tạo</th>
                        <th onclick="sortTable('OrderList', 2)">Khách hàng</th>
                        <th onclick="sortTable('OrderList', 3)">Số điện thoại</th>
                        <th onclick="sortTable('OrderList', 4)">Địa chỉ</th>
                        <th onclick="sortTable('OrderList', 5)">Danh sách đặt hàng</th>
                        <th onclick="sortTable('OrderList', 6)">Trạng thái</th>
                        <th onclick="sortTable('OrderList', 7)">Tổng tiền</th>
                    </tr>

                    <?php
                        $sql_Order = "SELECT `order`.`id` AS id, `order`.`order_time` AS oTime, `order`.`fullname` AS oName, `order`.`phoneNumber` AS oPhone, 
                            `order`.`address` AS oAddress, `order`.`status` AS oStatus, `order`.`payment` AS oMoney 
                            FROM `order`
                            ORDER BY oTime DESC";
                        $data_Order = executeResult($sql_Order);

                        foreach ($data_Order as $item_Order) {
                            echo '<tr>
                                <td><a href="#" onclick="openPopupFromElement(this)">'.$item_Order['id'].'</a></td>
                                <td>'.$item_Order['oTime'].'</td>
                                <td><b>'.$item_Order['oName'].'</b></td>
                                <td>'.$item_Order['oPhone'].'</td>
                                <td>'.$item_Order['oAddress'].'</td>';
                                
                                // In danh sach dat hang cua khach hang nay
                                $sql_Detail = "SELECT `product_name`, `quatity`, `size`, `plinth`, `topping`
                                    FROM `order_detail`
                                    WHERE `order_id` = ".$item_Order['id'];
                                $data_Detail = executeResult($sql_Detail);
                                echo '<td>';
                                foreach ($data_Detail as $item_Detail){
                                    echo '<b>&#9654 '.$item_Detail['product_name'].'</b><small>';
                                    if ($item_Detail['size'] != NULL){
                                        echo ', Size: <b>'.$item_Detail['size'].'</b>';
                                    }
                                    if ($item_Detail['plinth'] != NULL){
                                        echo ', Đế: <b>'.$item_Detail['plinth'].'</b>';
                                    }
                                    if ($item_Detail['topping'] != NULL){
                                        echo ', Topping: <b>'.$item_Detail['topping'].'</b>';
                                    }
                                    echo ', SL: <b>'.$item_Detail['quatity'].'</b></small><br>';
                                }
                                echo '</td>';

                                if ($item_Order['oStatus'] == 'Chờ xác nhận'){
                                    echo "<td style='color:#F98607;'>";
                                } elseif ($item_Order['oStatus'] == 'Đã xác nhận') {
                                    echo "<td style='color:#4CAF50;'>";
                                } elseif ($item_Order['oStatus'] == 'Đã bị hủy'){
                                    echo "<td style='color:#A80000;'>";
                                }
                                echo $item_Order['oStatus'];
                            
                                echo '</td>
                                <td><b>'.$item_Order['oMoney'].'</b></td>
                            </tr>';

                        }
                        
                    ?>

                </table>
            </div>
        </div>
    </div>

    <div id="popup_background" class="popup_background">
        <div class="popup_blur_background" onclick="closePopup()"></div>
        <div class="popup_panel" id="popup_panel">
        </div>
    </div>

    <script src="invoice_management.js"></script>

</body>
</html>


