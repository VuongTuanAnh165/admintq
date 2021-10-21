<?php 
    $open="service_group";
    require_once ( __DIR__ . '/../../autoload/autoload.php');
     
    $id = intval(getInput('id'));
    $sql="SELECT * FROM service_group WhERE service_gr_id=$id";
    $service_group = $db->fetchcheck($sql);
    if(empty($service_group))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    
    $service_gr_active = $service_group['service_gr_active'] == 1 ? 0 : 1;

    $update = $db->update('service_group',array("service_gr_active" => $service_gr_active), array("service_gr_id" => $id));
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