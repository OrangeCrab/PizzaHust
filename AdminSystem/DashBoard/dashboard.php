<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == 0) {
    header('location: ../login_form.php');
    die();
}
require 'view.php';
$order = get_overview();
$top_product = get_order_top();
$data_chart = get_sales();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="dashboard.css">
        <link rel="stylesheet" href="../InvoiceManagementPage/invoice_management.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js" ></script>
    </head>
    <body>

        <header>
            <meta charset="UTF-8">
            <img class="img" src="../../masterial/image/bgrAdminPage/topBgr.jpg" alt="top">
            <div class="top_bar">
                <img class="logo_name" src="../../masterial/image/iconHomePage/PizzaHustLogo.svg" alt="">
                <form action="" method="post">
                    <input type="text" name="logout" id="logout" value="logout" style="display: none;">
                    <button type="submit" class="logout_btn" style="border: none;">Logout</button>
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
            <div class="left_bar">
                <a href="#" class="active"><i class="fa fa-tachometer" aria-hidden="true"></i><span>Tổng Quan</span></a>
                <a href="../ProductManagementPage/ProductManagementPage.php" target="_self"><i class="fa fa-cutlery" aria-hidden="true"></i><span>Sản Phẩm</span></a>
                <a href="../InvoiceManagementPage/InvoiceManagement.php"><i class="fa fa-cube" aria-hidden="true"></i><span>Đơn Hàng</span></a>
                <a href="../Coupon/coupon.php" ><i class="fa fa-barcode" aria-hidden="true"></i><span>Khuyến Mãi</span></a>
            </div>

            <div id="main_center_panel">
                    <!-- lamf tiếp vào đây -->
                <div class="h1">Tổng quan</div>
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
                            <div class="card-name">Tổng đơn hàng </div> 
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
                            <h2>Đơn hàng mới</h2>
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
                                        <td><a href="#" onclick="openPopupFromElement(this)"><?php echo $item['id']; ?></a></td>
                                        <td><?php echo $item['payment'].''; ?></td>
                                        <td><?php echo $item['phonenumber']; ?></td>
                                        <td><?php echo $item['address']; ?></td> 
                                        <td><span class="status <?php status_css($item['status']) ?>" > <?php echo $item['status'] ?></span></td>                     
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <dib class="recentCustomers">
                        <div class="cardHeader">
                            <h2>Đặt nhiều</h2>
                            <!-- <a href="#" class="btn">View All</a> -->
                        </div>
                        <table>
                            <tbody>
                                <?php foreach ($top_product as $top_item){ ?>
                                    <tr>
                                        <td width="60px"><div class="imgBx"><img src="<?php echo '../../masterial/image/thuc_don/'.$top_item['image']; ?>" alt=""></div></td>
                                        <td><h4><?php echo $top_item['product_name']; ?> <br><span>  <?php echo $top_item['SUM(quatity)']; ?></span> </h4></td>    
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </dib>
                </div>

                <div class="chart_div" >
                    <canvas id="myChart" ></canvas>
                </div>
            
            </div>
        </div>
       
              
        <script>
            // console.log( );
            let myChart = document.getElementById('myChart').getContext('2d');
            Chart.defaults.font.size = 16;
            Chart.defaults.font.family  = 'Lato';
            Chart.defaults.font.color = '#000';
            
            let barChart = new Chart(myChart, {
                type:'line',
                data:{
                    labels:[<?php echo $data_chart[0] ;?>],
                    datasets:[
                    {
                        label:'Doanh thu',
                        data:[<?php echo $data_chart[1] ;?>],
                        // backgroundColor: fillPattern,
                        backgroundColor: 'rgba(0,167,108,0.2)',
                        borderColor:'#04AA6D',
                        fill: true,
                        borderWidth:3,
                        hoverBorderWidth:4,
                        hoverBorderColor:'#000',
                        tension: 0.4
                    }
                    // ,{
                    //     label:'Tuan truoc',
                    //     data:[10,155,100,160,0,70],
    
                    //     backgroundColor: 'red',
                    //     borderWidth:1,
                    //     borderColor:'#777',
                    //     hoverBorderWidth:3,
                    //     hoverBorderColor:'#000'
                    // }
                    ]
                },
                options:{
		            tooltips:{mode: 'index'},
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                        x: {
                            title: {text: 'Ngày', display:true,align:'end'}
                        }
                    },
                    plugins: {
                    title:{
                        display: false,
                        text:'Doanh thu',
                        fontSize:24
                    }},
                    legend:{
                        display: false,
                        position:'right',
                        labels:{
                            fontColor:'#000',
                            fontSize: 18
                        }
                    },
                    layout:{
                        padding:{
                            left:10,
                            right:50,
                            top:10,
                            bottom:10
                        }
                       
                    },
                    toptips:{
                        enables:false
                    },
                 
                }
                        
            });
         </script>

    </body>
</html>
