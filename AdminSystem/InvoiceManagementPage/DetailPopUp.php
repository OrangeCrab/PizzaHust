<!-- Nút đóng -->
<div class="popup_close" onclick="closePopup()">&times;</div>      

<!-- Thông tin khách hàng và đơn hàng -->
<?php
require_once('../../database/dbhelper.php');
$baseUrl = '../';
$orderid = $_GET["orderid"];

$sql = "SELECT *
    FROM `order`
    WHERE `order`.`id` = ".$orderid; 
$data = executeResult($sql);

foreach ($data as $row){
    echo '<div class="popup_name">
        <p>Tên khách hàng: '.$row['fullname'].'</p>
        <p>Số điện thoại: '.$row['phonenumber'].'</p>
        <p>Địa chỉ: '.$row['address'].'</p>
    </div>
    <div class="popup_id">
        <p>Mã đơn hàng: '.$row['id'].'</p>
        <p>Ngày mua: '.$row['order_time'].'</p>
    </div>';
}
?>

<!-- Chi tiết danh sách món trong đơn hàng -->
<table class="popup_table">
    <tr>
        <th>Mã</th>
        <th>Tên món ăn</th>
        <th>Đặc tả</th>
        <th>Giá tiền</th>
        <th>Số lượng</th>
        <th>Tổng giá</th>
    </tr>

    <?php 
        $sql = "SELECT `product`.`id` AS pID, `product`.`name` AS pName, `size`.`name` AS size, `plinth`.`name` AS plinth, 
            `order_detail`.`price` AS price, `order_detail`.`quatity` AS quantity 
            FROM `order_detail`, `order`, `product`, `size`, `plinth` 
            WHERE `order_detail`.`order_id` = `order`.`id` 
            AND `product`.`id` = `order_detail`.`product_id` 
            AND `order`.`size_id` = `size`.`id` 
            AND `order`.`plinth_id` = `plinth`.`id` 
            AND `order`.`id` = ".$orderid;

        $dataOrder = executeResult($sql);

        $total_money = 0;

        foreach ($dataOrder as $item){
            echo '<tr>
                <td>'.$item['pID'].'</td>
                <td>'.$item['pName'].'</td>
                <td>Size: '.$item['size'].'<br>Đế: '.$item['plinth'].'</td>
                <td>'.$item['price'].'</td>
                <td>'.$item['quantity'].'</td>
                <td>'.($item['price'] * $item['quantity']).'</td>
            </tr>';

            $total_money += ($item['price'] * $item['quantity']);
        }

        echo '<tr class="sum">
            <td colspan="5">Tổng cộng</td>
            <td>'.$total_money.'</td>
        </tr>';
    ?>

    </table>
</div>
<div class="popup_confirmation">
    <input style= "background-color: #4CAF50; color: white; 
    padding: 10px 20px; border: none; border-radius: 10px; "
    onclick="confirmButtonChange()" type="button" value="Xác nhận" id="button"></input>
</div>

<!-- <script src="invoice_management.js"></script> -->