<?php
require 'view.php';
$order = get_overview();
$top = get_order_top();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="dashboard.css">
        <link rel="stylesheet" href="../CodeProductManagementPage/draft.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </head>
    <body>

        <header>
            <meta charset="UTF-8">
            <img class="img" src="../../masterial/image/bgrAdminPage/topBgr.jpg" alt="top">
            <div class="top_bar">
                <img class="logo_name" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
                <a href="../login_form.php" class="logout_btn">Logout</a>
            </div>
        </header>

        <div class="work_screen">
            <div class="left_bar">
                <a href="#" class="active"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Tổng Quan</span></a>
                <a href="../CategoryManagementPage/CategoryManagement.php"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Danh Mục Món ăn</span></a>
                <a href="../CodeProductManagementPage/productManagementPage.php"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Món Ăn</span></a>
                <a href="../InvoiceManagementPage/InvoiceManagementPage.html"><i class="fa fa-cube" aria-hidden="true"></i><span>Đơn Hàng</span></a>
            </div>

            <div id="main_center_panel">
                    <!-- lamf tiếp vào đây -->
                <h1>Tổng quan</h1>
                <div class="cardBox">
                    <div class="card">                                       
                        <div>   
                            <div class="card-name">Tổng sản phẩm</div>
                            <div class="numbers"><?php echo number_products(); ?></div>
                        </div>     
                        <div class="iconbox">
                            <i class="fas fa-scroll"  aria-hidden="true"></i>
                         </div>
                    </div>

                    <div class="card"> 
                        <div>
                            <div class="card-name">Tổng đơn hàng</div> 
                            <div class="numbers"><?php echo number_orders(); ?></div> 
                        </div>     
                        <div class="iconbox">
                            <i class="fas fa-shopping-cart"  aria-hidden="true"></i>
                        </div>       
                    </div>

                    <div class="card">  
                        <div>                                             
                            <div class="card-name">Khách hàng </div>
                            <div class="numbers"><?php echo number_users(); ?> </div> 
                        </div>                                                      
                        <div class="iconbox">
                            <i class="fas fa-users"  aria-hidden="true"></i>                 
                        </div>
                    </div>
                    
                </div>

                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Recent Orders</h2>
                            <a href="../InvoiceManagementPage/InvoiceManagement.php" class="btn">Chi Tiết</a>
                        </div>
                        <table>
                            <thead> 
                                <tr>
                                   <td>Đơn hàng</td>
                                   <td>Tiền</td>
                                   <td>Số Điện Thoại</td>
                                   <td>Địa điểm</td>
                                   <td>Trạng thái</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order as $item){ ?>
                                    <tr>
                                        <td><?php echo $item['id']; ?></td>
                                        <td><?php echo $item['payment'].''; ?></td>
                                        <td><?php echo $item['userPhoneNumber']; ?></td>
                                        <td><?php echo $item['userAddress']; ?></td> 
                                        <td><span class="status <?php status_css($item['status']) ?>" > <?php status_css($item['status']) ?></span></td>                     
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <dib class="recentCustomers">
                        <div class="cardHeader">
                            <h2>Nổi bật</h2>
                            <!-- <a href="#" class="btn">View All</a> -->
                        </div>
                        <table>
                            <tbody>
                                <?php foreach ($top as $top_item){ ?>
                                    <tr>
                                        <td width="60px"><div class="imgBx"><img src="" alt=""></div></td>
                                        <td><h4><?php echo $top_item['productName']; ?> <br><span>  <?php echo $top_item['SUM(quatity)']; ?></span> </h4></td>    
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </dib>
                </div>
                
                <script type="text/javascript">
                    google.charts.load('current', {packages: ['corechart', 'line']});
                    google.charts.setOnLoadCallback(drawBasic);
                
                    function drawBasic() {
                
                        var data = new google.visualization.DataTable();
                        data.addColumn('number', 'X');
                        data.addColumn('number', 'Tháng 6');
                        data.addColumn('number', 'Tháng 7');
                
                        data.addRows([
                            [0, 0, 14],   [1, 10, 3],  [2, 23, 20],  [3, 17, 27],  [4, 18, 33],  [5, 9, 22],
                            [6, 11, 16],  [7, 18, 20],  [8, 33, 22],  [9, 40, 21],  [10, 38, 14], [11, 8, 22],
                            [12, 30, 18], [13, 40, 14], [14, 42, 25], [15, 47, 33], [16, 44, 40], [17, 48, 50],
                            [18, 52, 44], [19, 54, 44], [20, 42, 30], [21, 55, 40], [22, 56, 47], [23, 57, 52],
                            [24, 60, 22], [25, 50, 14], [26, 52, 13], [27, 51, 32 ], [28, 49, 41], [29, 53, 32],
                            [30, 55, 21], 
                        ]);
                
                        var options = {
                            hAxis: {
                            title: 'Ngày'
                            },
                            vAxis: {
                            title: 'Đơn hàng'
                            }
                        };
                
                        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                
                        chart.draw(data, options);
                        }
                </script>

                <div id="chart_div" class="char" ></div>
            <!-- </div>  -->
            </div>
        </div>
       
        
    </body>
</html>
