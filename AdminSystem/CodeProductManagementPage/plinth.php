<?php
    require_once 'DB.class.php';
    require_once('../../database/dbhelper.php');
    require_once('../../database/utility.php');
    $db = new DB();
    $data = $db->getRows('plinth',array('order_by'=>'id ASC'));
    // $id = $name = $price = '';
    // $connect = mysqli_connect('localhost','root', '','quan_ly_cua_hang_pizza_hust');
    // $query = "SELECT * FROM plinth ORDER BY id ASC";
    // $result = mysqli_query($connect, $query);
    if(!empty($sessData['status']['msg'])){
        $statusMsg = $sessData['status']['msg'];
        $statusMsgType = $sessData['status']['type'];
        unset($_SESSION['sessData']['status']);
    }

    if (isset($_POST['add_btn'])) {
        $name = getPost('name');
	    $price = getPost('price');
        $sql = "INSERT INTO plinth(name, price) VALUES ('$name', '$price')";
        execute($sql);
        header('location: plinth.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="https://t004.gokisoft.com/uploads/2021/07/1-s-1637-ico-web.jpg">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="jquery.tabledit.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
        
        <style>
            @font-face {
                font-family: Monsterrat;
                src: url("../../masterial/font/Montserrat-Medium.ttf");
            }
            .plinth_popup{
                z-index: 2;    
                position: fixed;
                background-color: rgba(0, 0, 0, 0.9);
                display: flex;
                justify-self: center;
                align-items: center;
                transition: 0.5s;
                width: 100%;
                height: 100%;
            }
            .plinth_popup .info_card{
                position: fixed;
                width: 70%;
                height: 80%;
                left: 15%;
                top: 10%;
                background: #f2f2f2;
                border-radius: 5px;
            }
                .plinth_popup .info_card .close_btn{
                    color: #404040;
                    z-index: 3;
                    position: absolute;
                    right: 0;
                    font-size: 20px;
                    margin: 20px;
                    cursor: pointer;
                }
                .plinth_popup .info_card h3{
                    position: absolute;
                    top: 5%;
                    left: 45%;
                    height: 5%;
                }
                .panel-body{
                    position: absolute;
                    width: 100%;
                    height: 90%;
                    top: 10%;
                }

                .left_panel_body{
                    position: absolute;
                    width: 60%;
                    height: 80%;
                    top: 10%;
                    background-color: white;
                }
                    .left_panel_body table {
                        position: absolute;
                        width: 100%;
                        border-collapse: collapse;
                        table-layout: fixed;  
                        font-size: 15px;
                        font-family: Monsterrat;
                        font-weight: lighter;
                        height: 100%;
                        display: block;
                        overflow: auto; 
                    }

                    .left_panel_body table tr {
                        height: 50px;
                        word-wrap: break-word;
                    }
                    .left_panel_body table th {
                        position: sticky; 
                        top: 0;
                        text-align: center;
                        z-index: 0;
                        background: white;
                    }
                    .left_panel_body table th:nth-child(4), td:nth-child(4) {
                        width: 200px;
                    }
                    .left_panel_body table th:nth-child(3), td:nth-child(3) {
                        width: 25%;
                    }
                    .left_panel_body table th:nth-child(2), td:nth-child(2) {
                        width: 35%;
                    }
                    .left_panel_body table th:nth-child(1), td:nth-child(1) {
                        width: 10%;
                        text-align: center;
                    } 
                .right_panel_body{
                    position: absolute;
                    width: 30%;
                    height: 60%;
                    top: 20%;
                    left: 65%;
                }
                .right_panel_body h1{
                    position: absolute;
                    font-size: 20px;
                    left: 25%;
                }

                .right_panel_body form{
                    position: absolute;
                    width: 100%;
                    height: 80%;
                    top: 20%;
                }
                    .button_add_plinth{
                        position: absolute;
                        width: 40%;
                        height: 15%;
                        top: 85%;
                        left: 40%;
                    }
        </style>
    </head>
    <body>
        <div class="plinth_popup" id="plinth_popup">
            <div class="info_card">
                <a href="ProductManagementPage.php"><i class="fa fa-times close_btn" aria-hidden="true"></i></a>
                <h3>Đế Pizza</h3>
                <div class="panel-body">
                    <div class="left_panel_body">
                        <table id="editable_table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th >ID</th>
                                    <th >Tên</th>
                                    <th >Giá (VNĐ)</th>
                                    <th style="z-index: 5;">Sửa/Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $index = 0; if(!empty($data)): foreach($data as $row): ?>
                                <tr id="<?php echo $row['id']; ?>">
                                    <td><?php echo ++$index; ?></td>
                                    <td>
                                        <span class="editSpan name_span"><?php echo $row['name']; ?></span>
                                        <input class="editInput name_input form-control input-sm" type="text" name="name" value="<?php echo $row['name']; ?>" style="display: none; font-size: 20px">
                                    </td>
                                    <td>
                                        <span class="editSpan price_span"><?php echo $row['price']; ?></span>
                                        <input class="editInput price_input form-control input-sm" type="text" name="price" value="<?php echo $row['price']; ?>" style="display: none; font-size: 20px">
                                    </td>
                                    <td style="z-index: 4;">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-sm btn-default editBtn" style="float: none;"><span class="glyphicon glyphicon-pencil"></span></button>
                                            <button type="button" class="btn btn-sm btn-default deleteBtn" style="float: none;"><span class="glyphicon glyphicon-trash"></span></button>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-success saveBtn" style="float: none; display: none;">Save</button>
                                        <button type="button" class="btn btn-sm btn-danger confirmBtn" style="float: none; display: none;">Confirm</button>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td colspan="5">No plinth(s) found......</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>         
                    </div>
                    <div class="right_panel_body">
                        <h1 style="font-family: Monsterrat;">Thêm đế pizza</h1>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="name_div">
                                <label for="name" style="font-family: Monsterrat;">Tên sản phẩm:</label>
                                <input required="true" type="text" class="form-control" id="name" name="name" style="font-size: 20px">
                            </div>
                            <div class="price_div" style="margin-top: 5%">
                                <label for="price" style="font-family: Monsterrat;">Giá:</label>
                                <input required="true" type="text" class="form-control" id="price" name="price"style="font-family: Monsterrat;font-size: 20px">
                            </div>
                            <div class="button_add_plinth">
                                <button class="btn btn-success" name="add_btn" style="font-family: Monsterrat;">Thêm</button>
                            </div>
                        </form>
                    </div>   
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.editBtn').on('click',function(){
                    //hide edit span
                    $(this).closest("tr").find(".editSpan").hide();
                    
                    //show edit input
                    $(this).closest("tr").find(".editInput").show();
                    
                    //hide edit button
                    $(this).closest("tr").find(".editBtn").hide();
                    
                    //show edit button
                    $(this).closest("tr").find(".saveBtn").show();
                    
                });
                
                $('.saveBtn').on('click',function(){
                    var trObj = $(this).closest("tr");
                    var ID = $(this).closest("tr").attr('id');
                    var inputData = $(this).closest("tr").find(".editInput").serialize();
                    $.ajax({
                        type:'POST',
                        url:'userAction.php',
                        dataType: "json",
                        data:'action=edit&id='+ID+'&'+inputData,
                        
                        success:function(response){
                            if(response.status == 'ok'){
                                trObj.find(".editSpan.name_span").text(response.data.name);
                                trObj.find(".editSpan.price_span").text(response.data.price);
                                
                                trObj.find(".editInput.name_input").text(response.data.name);
                                trObj.find(".editInput.price_input").text(response.data.price);
                                
                                trObj.find(".editInput").hide();
                                trObj.find(".saveBtn").hide();
                                trObj.find(".editSpan").show();
                                trObj.find(".editBtn").show();
                            }else{
                                alert(response.msg);
                            }
                        }
                    });
                });
                
                $('.deleteBtn').on('click',function(){
                    //hide delete button
                    $(this).closest("tr").find(".deleteBtn").hide();
                    
                    //show confirm button
                    $(this).closest("tr").find(".confirmBtn").show();
                    
                });
                
                $('.confirmBtn').on('click',function(){
                    var trObj = $(this).closest("tr");
                    var ID = $(this).closest("tr").attr('id');
                    $.ajax({
                        type:'POST',
                        url:'userAction.php',
                        dataType: "json",
                        data:'action=delete&id='+ID,
                        success:function(response){
                            if(response.status == 'ok'){
                                trObj.remove();
                            }else{
                                trObj.find(".confirmBtn").hide();
                                trObj.find(".deleteBtn").show();
                                alert(response.msg);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>