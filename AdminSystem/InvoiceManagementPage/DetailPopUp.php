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

    $row = $data[0];
    echo '<div class="popup_name">
        <p>Tên khách hàng: '.$row['fullname'].'</p>
        <p>Số điện thoại: '.$row['phonenumber'].'</p>
        <p>Địa chỉ: '.$row['address'].'</p>
    </div>';
    echo '<div class="popup_id">
        <p>Mã đơn hàng: '.$row['id'].'</p>
        <p>Ngày mua: '.$row['order_time'].'</p>
    </div>';
    echo '<div class="popup_note">
        <p>Ghi chú: '.$row['note'].'</p>
    </div>';
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
        $sql = "SELECT `product`.`id` AS pID, `product`.`name` AS pName, `order_detail`.`size` AS size, `order_detail`.`topping` AS topping,
            `order_detail`.`plinth` AS plinth, `order_detail`.`price` AS price, `order_detail`.`quatity` AS quantity
        FROM `order_detail`, `order`, `product`
        WHERE `order_detail`.`order_id` = `order`.`id` AND `product`.`id` = `order_detail`.`product_id` AND `order`.`id` = ".$orderid;

        $dataOrder = executeResult($sql);

        $total_money = 0;

        foreach ($dataOrder as $item){
            echo '<tr>
                <td>'.$item['pID'].'</td>
                <td>'.$item['pName'].'</td>';
                echo '<td>';
                if ($item['size'] != NULL){
                    echo 'Size: '.$item['size'].'<br>';
                } 
                if ($item['plinth'] != NULL){
                    echo 'Đế: '.$item['plinth'].'<br>';
                }
                if ($item['topping'] != NULL){
                    echo 'Topping: '.$item['topping'].'<br>';
                }
                echo'</td>';
                echo '<td>'.$item['price'].'</td>
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
    <?php
        if ($row['status'] == 'Chờ xác nhận'){
            echo '<p style="color:#F98607;">Đơn hàng đang chờ xác nhận</p>';
            echo '<button class="confirmButton" onclick="orderConfirmButtonChange('.$orderid.')">Xác nhận đơn hàng</button>
            <button class="rejectButton" onclick="orderRejectButtonChange('.$orderid.')">Hủy đơn hàng</button>';
        } elseif ($row['status'] == 'Đã xác nhận'){
            echo '<p style="color:#4CAF50; witdh:100%; text-align: center;">Đơn hàng đã được xác nhận</p>';
        } elseif ($row['status'] == 'Đã bị hủy'){
            echo '<p style="color:#A80000; witdh:100%; text-align: center;">Đơn hàng đã bị hủy</p>';
        }
    ?>
</div>

<script type="text/javascript">
    </script>