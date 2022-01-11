<?php
require_once('../../database/dbhelper.php');

// them
function add_coupon($name_cp, $type_cp, $code_cp, $value_cp ,$description, 
                    $active_date, $expire_date, $min_order_value, $max__order_amount){
    $sql="INSERT INTO `coupon` ( name_cp, type_cp, code_cp, value_cp,`description`, 
        active_date, expire_date, min_order_value, max__order_amount)
        VALUES ('$name_cp', '$type_cp', '$code_cp', $value_cp ,'$description', 
        '$active_date', '$expire_date', '$min_order_value', '$max__order_amount') ";   
    // print_r($sql);
    execute($sql);
}

function update_coupon($id_cp, $name_cp, $type_cp, $code_cp, $value_cp ,$description, 
                    $active_date, $expire_date, $min_order_value, $max__order_amount){
    $sql="UPDATE `coupon` 
          SET  name_cp = '$name_cp', type_cp = '$type_cp', code_cp = '$code_cp', value_cp  = $value_cp ,description = '$description', 
                active_date = '$active_date', expire_date = '$expire_date', min_order_value = '$min_order_value', max__order_amount= '$max__order_amount'
          WHERE id_cp = $id_cp;";  

    execute($sql);
}

//lấy thông tin tat ca mã giảm giá
function get_coupon(){
    $sql = "SELECT * from `coupon`";
    return executeResult($sql);
}
//lấy thông tin mã giảm giá bang id
function get_acoupon($id){
    $sql = "SELECT * from `coupon` where id_cp='$id'";
    return getArrResult($sql);
    
}
// print_r(get_acoupon(1));
//kiem tra tinh hop le ma KM
function checkcoupon($code_cp) {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $currentDateTime = date("Y-m-d h:m:s");
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
function status_coupon($code_cp) {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $currentDateTime = date("Y-m-d h:m:s");
    $sql = "SELECT * from `coupon` WHERE code_cp='$code_cp'";
    $info_cp = getArrResult($sql);
    // echo var_dump($info_cp["active_date"]== "0000-00-00 00:00:00");    
    if($info_cp["active_date"]== "0000-00-00 00:00:00" || $info_cp["active_date"]== null){
        return "Vĩnh viễn ";
    }else if($info_cp["expire_date"]<$currentDateTime){
        return "Quá hạn";
    }else if($info_cp["active_date"]>$currentDateTime){ 
        return "Sắpp diễn ra";
    } else  {
        return "Đang diễn ra";
    }
}

// mô tả giá trị coupon (vd giamr 20% toi da 100K cho don toi thieu 300K)
function value_coupon($value, $type){
    if($type=="0"){
        $str = "Giảm ".$value." % ";
    }else if($type=="1"){
        if($value % 1000 == 0){
            $str = "Giảm ".($value/1000)." K ";
        }else{
            $str = "Giảm ".$value." VNĐ ";
        }
    }else{
        $str = " Ưu đãi khác";
    }
    return $str;
}





// echo "<br/>".value_coupon(200000,'KM002');
// echo "<br/>".value_coupon(200000,'KM002');


?>