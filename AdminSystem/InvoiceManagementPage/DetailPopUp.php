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
        <p><i>Tên khách hàng:</i> '.$row['fullname'].'</p>
        <p><i>Số điện thoại:</i> '.$row['phonenumber'].'</p>
        <p><i>Địa chỉ:</i> '.$row['address'].'</p>
    </div>';
    echo '<div class="popup_id">
        <p><i>Mã đơn hàng:</i> '.$row['id'].'</p>
        <p><i>Ngày mua:</i> '.$row['order_time'].'</p>
    </div>';
    echo '<div class="popup_note">
        <p><i>Ghi chú:</i> '.$row['note'].'</p>
    </div>';
?>

<!-- Chi tiết danh sách món trong đơn hàng -->
<table class="popup_table">
    <tr>
        <th>Tên món ăn</th>
        <th>Đặc tả</th>
        <th>Giá tiền</th>
        <th>Số lượng</th>
        <th>Tổng giá</th>
    </tr>

    <?php 
        $sql = "SELECT `product_name`, `size`, `topping`, `plinth`, `price`, `quatity`
        FROM `order_detail`
        WHERE `order_detail`.`order_id` = ".$orderid;

        $dataOrder = executeResult($sql);

        $total_money = 0;

        foreach ($dataOrder as $item){
            echo '<tr>
                <td>'.$item['product_name'].'</td>';
                echo '<td>';
                if ($item['size'] != NULL){
                    echo '&#9654 <i>Size:</i> '.$item['size'].'<br>';
                } 
                if ($item['plinth'] != NULL){
                    echo '&#9654 <i>Đế</i>: '.$item['plinth'].'<br>';
                }
                if ($item['topping'] != NULL){
                    echo '&#9654 <i>Topping</i>: '.$item['topping'].'<br>';
                }
                echo'</td>';
                echo '<td>'.$item['price'].'</td>
                <td>'.$item['quatity'].'</td>
                <td>'.($item['price'] * $item['quatity']).'</td>
            </tr>';

            $total_money += ($item['price'] * $item['quatity']);
        }

        echo '<tr class="sum">
            <td colspan="4">Giá trị sản phẩm:</td>
            <td>'.$total_money.'</td>
        </tr>';
        if ($row['address'] != 'Nhận tại quán'){
            echo '<tr class="sum">
                <td colspan="4">Phí ship:</td>
                <td>+22000</td>
            </tr>';
        }
        if ($row['coupon'] != 0){ // if có voucher
            echo '<tr class="sum">
                <td colspan="4">Giảm giá:</td>
                <td>-'.$row['coupon'].'</td>
            </tr>';
        }
        echo '<tr class="sum">
            <td colspan="4"><span>Tổng giá trị đơn hàng:</span></td>
            <td><span>'.$row['payment'].'</span></td>
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
            echo '<p style="color:#4CAF50; witdh:100%; text-align: center;">Đơn hàng đã được xác nhận!</p>';
        } elseif ($row['status'] == 'Đã bị hủy'){
            echo '<p style="color:#A80000; witdh:100%; text-align: center;">Đơn hàng đã bị hủy!</p>';
        }
    ?>
</div>

<script type="text/javascript">
    </script>