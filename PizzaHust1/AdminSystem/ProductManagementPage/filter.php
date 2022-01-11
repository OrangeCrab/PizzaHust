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
        $price_s = $row['price_s'];
        $price_m = $row['price_m'];
        $price_l = $row['price_m'];
        $price_free_size = $row['price_free_size'];

        $price = 0;
        if ($price_free_size > 0) {
            $price = $price_free_size;
        }else {
            if ($price_s > 0) {
                $price = $price_s;
            }else {
                if ($price_m > 0) {
                    $price = $price_m;
                }else {
                    $price = $price_l;
                }
            }
        }

        echo '
        <tr>
            <td>'.(++$index).'</td>
            <td><img src="../../masterial/image/thuc_don/'.$row['image'].'" style="height: auto; width: 100px;"/></td>
            <td>'.$row['name'].'</td>
            <td>'.$row['description'].'</td>
            <td>'.getStatusName($row['status_product_id']).'</td>
            <td>'.number_format($price).' VNĐ</td>
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
?>