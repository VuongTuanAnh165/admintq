<?php 
    $open="service";
    require_once ( __DIR__ . '/../../autoload/autoload.php');
     
    $id = intval(getInput('id'));
    $sql="SELECT * FROM service WhERE service_id=$id";
    $service = $db->fetchcheck($sql);
    if(empty($service))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    
    $service_active = $service['service_active'] == 1 ? 0 : 1;

    $update = $db->update('service',array("service_active" => $service_active), array("service_id" => $id));
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