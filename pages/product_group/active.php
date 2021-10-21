<?php 
    $open="product_group";
    require_once ( __DIR__ . '/../../autoload/autoload.php');
     
    $id = intval(getInput('id'));
    $sql="SELECT * FROM product_group WhERE product_gr_id=$id";
    $product_group = $db->fetchcheck($sql);
    if(empty($product_group))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    
    $product_active = $product_group['product_gr_active'] == 1 ? 0 : 1;

    $update = $db->update('product_group',array("product_gr_active" => $product_active), array("product_gr_id" => $id));
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