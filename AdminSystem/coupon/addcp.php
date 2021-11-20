<?php
require 'controller_cp.php';
$coupon = get_coupon();


if (!empty($_POST['add_coupon']))
{
    // Lay data
    $data['name_cp']         = isset($_POST['name_cp']) ? $_POST['name_cp'] : '';
    $data['type_cp']    = isset($_POST['type_cp']) ? $_POST['type_cp'] : '';
    $data['code_cp']    = isset($_POST['code_cp']) ? $_POST['code_cp'] : '';
    $data['value_cp']    = isset($_POST['value_cp']) ? $_POST['value_cp'] : '';
    $data['description']    = isset($_POST['description']) ? $_POST['description'] : '';
    $data['active_date']    = isset($_POST['active_date']) ? $_POST['active_date'] : '';
    $data['expire_date']    = isset($_POST['expire_date']) ? $_POST['expire_date'] : '';
    $data['min_order_value']    = isset($_POST['min_order_value']) ? $_POST['min_order_value'] : '';
    $data['max__order_amount']    = isset($_POST['max__order_amount']) ? $_POST['max__order_amount'] : '';
    
    add_coupon( $data['name_cp'],$data['type_cp'],$data['code_cp'],$data['value_cp'] ,$data['description'],
    $data['active_date'], $data['expire_date'], $data['min_order_value'], $data['max__order_amount']);
     
    header("Location: coupon.php");

}


?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="dashboard.css">
        <link rel="stylesheet" href="../CodeProductManagementPage/draft.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    </head>
    <body>
    <?php  echo "<br/> <br/> <br/>".var_dump($data['code_cp']);?>
    <h1>Tạo mã </h1>
                <a href="coupon.php">Trở về</a> <br/> <br/>
                <form method="post" >
                    <table width="50%" border="1" cellspacing="0" cellpadding="10">
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" name="name_cp" value=""/>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>Code</td>
                            <td>
                                <input type="text" name="code_cp" value="" id="code_cp"/>
                                <!-- <div id="code_cp">Nội dung ajax sẽ được load ở đây</div> -->
            
                            </td>
                            <!-- <td><button type="button" onclick= "load_ajax()" > Tự tạo</button></td> -->
                            <script type="text/javascript">
                                function autoCoupon(){
                                    // var length = 10;
                                    // $.ajax({
                                    //     url:"couponcr.php"
                                    //     mothod:'post',
                                    //     data:{type:'coupon_action',length: length},
                                    //     dataType:'html',
                                    //     success: function(response){
                                    //         response=response.replace(/(|r\n|\r)/gm,"");
                                    //         $('#code_cp').val(response);

                                    //     }
                                    // })
                                    document.getElementById("code_cp").value = "haha";
                                }

                            </script>
                            <script language="javascript">
                                function load_ajax()
                                {
                                    $.ajax({
                                    url : "result.php",
                                    type : "post",
                                    dataType:"text",
                                    data : {
                                        
                                    },
                                    success : function (result){
                                        $('#result').html(result);
                                    }
                                });
                                }
                        </script>
                        </tr>
                        <tr>
                            <td>hình thức giảm</td>
                            <td>
                            <input type="text" name="type_cp" value="" id="type_cp"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Giá giảm</td>
                            <td>
                            <input type="text" name="value_cp" value="" id="value_cp"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Ngày bd</td>
                            <td>
                                <input type="text" name="active_date" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td>Ngày KT</td>
                            <td>
                                <input type="text" name="expire_date" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td>DK </td>
                            <td>
                                <input type="text" name="min_order_value" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td>Giảm tối đa</td>
                            <td>
                                <input type="text" name="max__order_amount" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="add_coupon" value="Tạo"/>
                            </td>
                        </tr>
                        
                    </table>
                </form>
    </body>
</html>