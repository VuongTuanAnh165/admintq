<?php 
    $open="product";
    require_once ( __DIR__ . '/../../autoload/autoload.php');
     
    $id = intval(getInput('id'));
    $sql="SELECT * FROM product WhERE product_id=$id";
    $product = $db->fetchcheck($sql);
    if(empty($product))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    
    $product_active = $product['product_active'] == 1 ? 0 : 1;

    $update = $db->update('product',array("product_active" => $product_active), array("product_id" => $id));
    if($update > 0)
    {
        $_SESSION['success'] = " Cập nhật thành công ";
        redirectAdmin($open);
    }
    else
    {
        $_SESSION['error'] = " Dữ liệu không thay đổi ";
        redirectAdmin($open);
    }    

?>