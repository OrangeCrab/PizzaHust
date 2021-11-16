<!-- Nút đóng -->
<div class="popup_close" onclick="closePopup()">&times;</div>      

<!-- Thông tin khách hàng và đơn hàng -->
<?php
require_once('../../database/dbhelper.php');
$baseUrl = '../';
$orderid = $_GET["orderid"];

$sql = "select * from `order` where `order`.`id` = ".$orderid; 
$data = executeResult($sql);

foreach ($data as $row){
    echo '<div class="popup_name">
        <p>Tên khách hàng: '.$row['fullname'].'</p>
        <p>Số điện thoại: '.$row['phone_number'].'</p>
        <p>Địa chỉ: '.$row['address'].'</p>
    </div>
    <div class="popup_id">
        <p>Mã đơn hàng: '.$row['id'].'</p>
        <p>Ngày mua: '.$row['order_date'].'</p>
    </div>';
}
?>

<!-- Chi tiết danh sách món trong đơn hàng -->
<table class="popup_table">
    <tr>
        <th>Mã</th>
        <th>Tên món ăn</th>
        <th>Số lượng</th>
        <th>Giá tiền</th>
        <th>Đặc tả</th>
        <th>Tổng giá</th>
    </tr>

    <?php 
        $sql = "select `product`.`id` as productid, `product`.`title` as title, `product`.`description` as productdesc,
        `order_detail`.`price` as price, `order_detail`.`num` as num, `order_detail`.`total_money` as total
        from (`order_detail` inner join `product` on `product`.`id` = `order_detail`.`product_id`) 
        where `order_id` = ".$orderid;

        $data = executeResult($sql);

        $total_money = 0;

        foreach ($data as $item){
            echo '<tr>
                <td>'.$item['productid'].'</td>
                <td>'.$item['title'].'</td>
                <td>'.$item['num'].'</td>
                <td>'.$item['price'].'</td>
                <td>'.$item['productdesc'].'</td>
                <td>'.$item['total'].'</td>
            </tr>';

            $total_money += $item['total'];
        }

        echo '<tr class="sum">
            <td colspan="5">Tổng cộng</td>
            <td>'.$total_money.'</td>
        </tr>';
    ?>

    </table>
</div>
<div class="popup_confirmation">
    <p>{Xác nhận đơn hàng ở đây}</p>
</div>