<?php
    require_once('../../database/dbhelper.php');
    if($_POST["query"] != '')
    {
        $search_array = explode(",", $_POST["query"]);
        $search_text = implode("', '", $search_array);
        $query = "SELECT * FROM product WHERE categoryID = '$search_text'";
    }
    else
    {
        $query = "SELECT * FROM product";
    }
    $result = executeResult($query);
    $index = 0;
    foreach($result as $row)
    {
        echo '
        <tr>
            <td>'.(++$index).'</td>
            <td><img src="../../masterial/image/thuc_don/'.$row['productImg'].'" style="height: auto; width: 100px;"/></td>
            <td>'.$row['productName'].'</td>
            <td>'.$row['description'].'</td>
            <td>'.getStatusName($row['statusID']).'</td>
            <td>'.number_format($row['productPrice']).' VNĐ</td>
            <td>'.getCategoryName($row['categoryID']).'</td>
            <td style="width: 20px">
            <a href="editProductPopup.php?id='.$row['id'].'"><button class="btn btn-warning">Sửa</button></a>
            </td>
            <td style="width: 20px">
            <button onclick="deleteProduct('.$row['id'].')" class="btn btn-danger">Xoá</button>
            </td>
        </tr>
        ';
    }
    function getStatusName($statusID)
    {
        $sql = "select status from status where id='$statusID'";
        
        return getArrResult($sql)['status'];
    }

    function getCategoryName($categoryID)
    {
        $sql = "select title from category where id='$categoryID'";
        
        return getArrResult($sql)['title'];
    }
?>