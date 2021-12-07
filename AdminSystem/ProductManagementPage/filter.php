<?php
    require_once('../../database/dbhelper.php');
    if($_POST["query"] != '')
    {
        $search_array = explode(",", $_POST["query"]);
        $search_text = implode("', '", $search_array);
        $query = "SELECT * FROM product WHERE category_id = '$search_text'";
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
            <td><img src="../../masterial/image/thuc_don/'.$row['image'].'" style="height: auto; width: 100px;"/></td>
            <td>'.$row['name'].'</td>
            <td>'.$row['description'].'</td>
            <td>'.getStatusName($row['status_product_id']).'</td>
            <td>'.number_format($row['price']).' VNĐ</td>
            <td>'.getCategoryName($row['category_id']).'</td>
            <td style="width: 20px">
            <a href="editProductPopup.php?id='.$row['id'].'"><button class="btn btn-warning">Sửa</button></a>
            </td>
            <td style="width: 20px">
            <button onclick="deleteProduct('.$row['id'].')" class="btn btn-danger">Xoá</button>
            </td>
        </tr>
        ';
    }
    function getStatusName($status_product_id)
    {
        $sql = "select status from status_product where id='$status_product_id'";       
        return getArrResult($sql)['status'];
    }

    function getCategoryName($category_id)
    {
        $sql = "select title from category where id='$category_id'";      
        return getArrResult($sql)['title'];
    }
    function getSizeName($size_id)
    {
        $sql = "select name from size where id='$size_id'";
        $result = getArrResult($sql)['name'];
        if ($result != 'null') {
            return '_'.$result;
        }
        else return '';
    }
?>