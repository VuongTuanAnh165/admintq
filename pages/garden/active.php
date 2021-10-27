<?php 
    $open="garden";
    require_once ( __DIR__ . '/../../autoload/autoload.php');
     
    $id = intval(getInput('id'));
    $sql="SELECT * FROM garden WhERE garden_id=$id";
    $garden = $db->fetchcheck($sql);
    if(empty($garden))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    
    $garden_active = $garden['garden_active'] == 1 ? 0 : 1;

    $update = $db->update('garden',array("garden_active" => $garden_active), array("garden_id" => $id));
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