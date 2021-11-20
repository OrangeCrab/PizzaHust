<?php
require_once('../../database/dbhelper.php');

// them
function add_coupon($name_cp, $type_cp, $code_cp,$value_cp ,$description, 
    $active_date, $expire_date, $min_order_value, $max__order_amount){
    $sql="INSERT INTO `coupon` ( name_cp, type_cp, code_cp, value_cp,`description`, 
        active_date, expire_date, min_order_value, max__order_amount)
        VALUES ('$name_cp', '$type_cp', '$code_cp', $value_cp ,'$description', 
        '$active_date', '$expire_date', '$min_order_value', '$max__order_amount') ";   
    execute($sql);
}


//lấy thông tin tat ca mã giảm giá
function get_coupon(){
    $sql = "SELECT * from `coupon`";
    return executeResult($sql);
}


//kiem tra tinh hop le ma KM
function checkcoupon($code_cp){
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $currentDateTime = date("Y-m-d h-m-s");
    $sql = "SELECT * from `coupon` WHERE code_cp='$code_cp'";
    $info_cp = getArrResult($sql);
    if(empty( $info_cp)){
        return "Không tồn tại mã";
    }else if($info_cp) 
    if($info_cp["expire_date"]<$currentDateTime){
        return "Qua han";
    }else{
        return "Hop le";    
    }
}

//kiem tra trạng thái coupon
function status_coupon($code_cp){
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $currentDateTime = date("Y-m-d h-m-s");
    $sql = "SELECT * from `coupon` WHERE code_cp='$code_cp'";
    $info_cp = getArrResult($sql);
    // echo var_dump($info_cp["active_date"]== "0000-00-00 00:00:00");    
    if($info_cp["active_date"]== "0000-00-00 00:00:00" || $info_cp["active_date"]== null){
        return "Vĩnh viễn ";
    }else if($info_cp["expire_date"]<$currentDateTime){
        return "Qua han";
    }else if($info_cp["active_date"]>$currentDateTime){ 
        return "Sap dien ra";
    } else  {
        return "Dang dien ra";
    }
}

// mô tả giá trị coupon (vd giamr 20% toi da 100K cho don toi thieu 300K)
function value_coupon($code_cp){
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $currentDateTime = date("Y-m-d h-m-s    ");
    $sql = "SELECT * from `coupon` WHERE code_cp='$code_cp'";
    $info_cp = getArrResult($sql);
    // echo var_dump($info_cp );
    if($info_cp['type_cp']=="PERCENTAGE"){
        $str = "Giảm ".$info_cp['value_cp']." % ";
        if($info_cp['max__order_amount']!=0){
            $str .=" tối đa ".$info_cp['max__order_amount']." đồng ";
        }
        if($info_cp['min_order_value']!=0){
            $str .=" cho đơn hàng từ ".$info_cp['min_order_value']." đồng trở lên";
        }
        
    }else if($info_cp['type_cp']=="CURRENCY"){
        $str = "Giảm ".$info_cp['value_cp']." đồng ";
        if($info_cp['min_order_value']!=0){
            $str .=" cho đơn hàng từ ".$info_cp['min_order_value']." đồng trở lên";
        }
    }else{
        $str = " Ưu đãi khác";
    }
    return $str;
}

// tinhs so tien duoc khuyem mai
function value_promotional($total,$code_cp){
    $cp = get_coupon($code_cp);
    if($cp['type_cp']=='CURRENCY'){
        return  $cp['value_cp'];
    }else
    if($cp['type_cp']=='PERCENTAGE' ){
        return ($cp['max__order_amount']<$cp['value_cp']*$total)? $cp['max__order_amount'] : $cp['value_cp']*$total;       
    }
}



// echo "<br/>".value_coupon(200000,'KM002');
// echo "<br/>".value_coupon(200000,'KM002');


?>