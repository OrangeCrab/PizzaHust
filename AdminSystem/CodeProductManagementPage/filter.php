<?php
    require_once('../../database/dbhelper.php');
    $connect = new PDO("mysql:host=localhost;dbname=quan_ly_cua_hang_pizza_hust", "root", "");
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

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    $total_row = $statement->rowCount();

    $output = '';

    if($total_row > 0)
    {
        $index = 0;
        foreach($result as $row)
        {
            $output .= '
            <tr>
                <td>'.(++$index).'</td>
                <td><img src="../../masterial/image/thuc_don/'.$row['image'].'" style="height: auto; width: 100px;"/></td>
                <td>'.$row['title'].'</td>
                <td>'.$row['description'].'</td>
                <td>'.getStatusName($row['status_id']).'</td>
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
    }
    else
    {
        $output .= '
        <tr>
            <td colspan="5" align="center">No Data Found</td>
        </tr>
        ';
    }

    echo $output;

    function getStatusName($status_id)
    {
        $sql = "select status from status where id='$status_id'";
        
        return getArrResult($sql)['status'];
    }

    function getCategoryName($category_id)
    {
        $sql = "select name from category where id='$category_id'";
        
        return getArrResult($sql)['name'];
    }
?>