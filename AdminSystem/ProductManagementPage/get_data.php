<?php
    require_once('../../database/dbhelper.php');

    function loadData($query)
    {
        $result = executeResult($query);
        $index = 0;
        foreach($result as $row)
        {
            $id = $row['id'];
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
            <tr id="'.$id.'">
                <td>'.(++$index).'</td>
                <td><img src="../../masterial/image/thuc_don/'.$row['image'].'" style="height: auto; width: 100px;"/></td>
                <td>'.$row['name'].'</td>
                <td>'.$row['description'].'</td>
                <td>'.getStatusName($row['status_product_id']).'</td>
                <td>'.number_format($price).' VNĐ</td>
                <td>'.getCategoryName($row['category_id']).'</td>
                <td>
                <a href="#" onclick="openEditPopup('.$row['id'].')""><button class="btn btn-warning">Sửa</button></a>
                </td>
                <td>
                <button class="btn btn-danger deleteProductBtn">Xoá</button>
                </td>
            </tr>
            ';
        }
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

    function getPizzaBase($query){
        $result = executeResult($query);
        $index = 0;
        if(!empty($result)){
            foreach($result as $row){
                $id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                ++$index;
                echo '
                    <tr id="'.$id.'">
                        <td>'.$index.'</td>
                        <td>
                            <span class="editSpan name_span">'.$name.'</span>
                            <input class="editInput name_input form-control input-sm" type="text" name="name" value="'.$name.'" style="display: none; font-size: 15px">
                        </td>
                        <td>
                            <span class="editSpan price_span">'.$price.'</span>
                            <input class="editInput price_input form-control input-sm" type="text" name="price" value="'.$price.'" style="display: none; font-size: 15px">
                        </td>
                        <td>
                            <button class="btn btn-warning editBtn">Sửa</button>
                            <button class="btn btn-success saveBtn" style="display: none;">Lưu</button>
                        </td>
                        <td>
                            <button class="btn btn-danger deleteBtn">Xóa</button>
                        </td>
                    </tr>
                ';
            }
        }else{
            echo '<tr><td colspan="5">No pizza base(s) found......</td></tr>';
        }
    }
?>