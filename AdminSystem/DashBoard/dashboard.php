<?php
 require_once('../route_map.php');

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
                            <div class="numbers">1241</div>
                        </div>     
                        <div class="iconbox">
                            <i class="fas fa-scroll"  aria-hidden="true"></i>
                         </div>
                    </div>

                    <div class="card"> 
                        <div>
                            <div class="card-name">Tổng đơn hàng</div> 
                            <div class="numbers">1294</div> 
                        </div>     
                        <div class="iconbox">
                            <i class="fas fa-shopping-cart"  aria-hidden="true"></i>
                        </div>       
                    </div>

                    <div class="card">  
                        <div>                                             
                            <div class="card-name">Khách hàng </div>
                            <div class="numbers">56 </div> 
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
                            <a href="#" class="btn">View All</a>
                        </div>
                        <table>
                            <thead> 
                                <tr>
                                   <td>Don hang</td>
                                   <td>Tien</td>
                                   <td>So dt</td>
                                   <td>Dia diem</td>
                                   <td>Trang Thai</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Star</td>
                                    <td>120312100</td>
                                    <td>0924214213</td>
                                    <td>Hoof Hoanf Kieesm</td>
                                    <td><span class="status return">Huy</span></td>
                                </tr>
                                <tr>
                                    <td>Star Haizz</td>
                                    <td>0924214213</td>
                                    <td>0924214213</td>
                                    <td> Hoanf Kieesm</td>
                                    <td><span class="status delivered">Xac Nhan</span></td>
                                </tr>
                                <tr>
                                    <td>Star All</td>
                                    <td>0924214213</td>
                                    <td>0924214213</td>
                                    <td>Hoof Guong</td>
                                    <td><span class="status pending">Dang giao</span></td>
                                </tr>
                                <tr>
                                    <td>Ten Ten</td>
                                    <td>0924214213</td>
                                    <td>0924214213</td>
                                    <td>DH Guong</td>
                                    <td><span class="status inprogress">Da giao</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <dib class="recentCustomers">
                        <div class="cardHeader">
                            <h2>Dat nhieu</h2>
                            <!-- <a href="#" class="btn">View All</a> -->
                        </div>
                        <table>
                            <tbody>
                                <tr>
                                    <td width="60px"><div class="imgBx"><img src="../../masterial/image/thuc_don/4_vi.jpg" alt=""></div></td>
                                    <td><h4>Vip1 <br><span>pizza</span> </h4></td>
                                </tr>
                                <tr>
                                    <td width="60px"><div class="imgBx"><img src="../../masterial/image/thuc_don/5_loai_thit.jpg" alt=""></div></td>
                                    <td><h4>Vip2 <br><span>pizza thit</span> </h4></td>
                                </tr>
                                <tr>
                                    <td width="60px"><div class="imgBx"><img src="../../masterial/image/thuc_don/bo_tom.jpg" alt=""></div></td>
                                    <td><h4>Vip3 <br><span>pizza tom</span> </h4></td>
                                </tr>
                                <tr>
                                    <td width="60px"><div class="imgBx"><img src="../../masterial/image/thuc_don/ga_BBQ.jpg" alt=""></div></td>
                                    <td><h4>Vip4 <br><span>pizza ga_BBQ</span> </h4></td>
                                </tr>
                                <tr>
                                    <td width="60px"><div class="imgBx"><img src="../../masterial/image/thuc_don/mi_y2.jpg" alt=""></div></td>
                                    <td><h4>Vip5 <br><span>Mi y 2</span> </h4></td>
                                </tr>
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