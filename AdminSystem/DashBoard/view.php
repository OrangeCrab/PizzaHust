<?php
require_once('../../database/dbhelper.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');

//So don hang
function number_orders(){
    $sql = "SELECT count(*) as `count` from  `order` ";
    $conn = mysqli_connect(HOST,USERNAME, PASSWORD,DATABASE);
    mysqli_set_charset($conn,'utf8');
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $count = $row['count'];
    mysqli_close($conn);
    return $count;
    
}
//So don hang
function number_users(){
    $sql = "SELECT count(*) as `count` from  `user_account` ";
    $conn = mysqli_connect(HOST,USERNAME, PASSWORD,DATABASE);
    mysqli_set_charset($conn,'utf8');
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $count = $row['count'];
    mysqli_close($conn);
    return $count;
}
//So san pham
function number_products(){
    $sql = "SELECT count(*) as `count` from  `product` ";
    $conn = mysqli_connect(HOST,USERNAME, PASSWORD,DATABASE);
    mysqli_set_charset($conn,'utf8');
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $count = $row['count'];
    mysqli_close($conn);
    return $count;
}

// lấy 10 đơn mới nhất
function get_overview(){
    $sql = "SELECT  * FROM `order` order by order_time DESC LIMIT 10";
    return executeResult($sql);
}


//lay 5 pizza order nhieu trong tuan
function get_order_top(){
    $sql = "SELECT order_detail.product_name ,SUM(quantity) , `image`
    FROM `order_detail`,`order` , `product`
    WHERE   `order_detail`.order_id=`order`.`id` 
    -- AND ( `order`.`order_time` > CURRENT_DATE -700 ) 
    and `product`.`name` = order_detail.product_name
    GROUP BY product_name ORDER BY SUM(quantity) DESC  LIMIT 5";
    return executeResult($sql);
}

//trạng thái hàng
function status_css($status){

    if($status =='Đã xác nhận') echo "delivered" ;
    else if($status =='Đã bị hủy' )echo"return" ;
    else if($status ==2) echo"inprogress" ;
    else if($status =='Chờ xác nhận') echo"pending" ;
}

//doanh thu tuan
function get_sales(){
    $sql = "SELECT  order_time, SUM(payment) as sales 
            FROM `order`
            WHERE `status` = N'Đã xác nhận' and
            `order`.`order_time` > CURRENT_DATE - 6
            GROUP BY DATE_FORMAT(order_time, '%y-%m-%d')
            ORDER BY order_time ASC";
    $data = executeResult($sql);
    $res[]='';
    $res[1]='';

    if($data == NULL){
       $dateBegin = date('Y-m-d',strtotime ( '-6 day' ,  strtotime ( date("Y-m-d"))));
       $dateEnd = date("Y-m-d");
       while($dateBegin <= $dateEnd){
        $res[0] = $res[0] . '"'. date('d-m', strtotime($dateBegin)).'",';
        $res[1] = $res[1] . '"0",';
        $dateBegin = date('Y-m-d',strtotime ( '+1 day' , strtotime ( $dateBegin ))) ;
       }
       return $res;
    }else{
        $date = date('Y-m-d', strtotime('-6 day' ,  strtotime ( date("Y-m-d"))));
        foreach( $data as $item){
            $tg = date('Y-m-d', strtotime($item['order_time']));
            while ( $date < $tg){
                $res[0] = $res[0] . '"'. date('d-m', strtotime($date)).'",';
                $res[1] = $res[1] . '"0",';
                $date = date('Y-m-d',strtotime ( '+1 day' , strtotime ( $date ))) ;
            }
            $res[0] = $res[0] . '"'. date('d-m', strtotime($item['order_time'])).'",';
            $res[1] = $res[1] . '"'. $item['sales'].'",';
            $date = date('Y-m-d',strtotime ( '+1 day' , strtotime ( $date ))) ;

        }
        $dateEnd = date("Y-m-d");
        while($date <= $dateEnd){
            $res[0] = $res[0] . '"'. date('d-m', strtotime($date)).'",';
            $res[1] = $res[1] . '"0",';
            $date = date('Y-m-d',strtotime ( '+1 day' , strtotime ( $date ))) ;
        }
        
        $res[1] = trim($res[1],",");
        $res[0] = trim($res[0],",");
        return $res;
    }
    
}
// $data = get_sales();
// echo var_dump( $data['0']);

