<?php 
    $open="policies";
    require_once ( __DIR__ . '/../../autoload/autoload.php');
     
    $id = intval(getInput('id'));
    $sql="SELECT * FROM policies WhERE policies_id=$id";
    $policies = $db->fetchcheck($sql);
    if(empty($policies))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    
    $policies_active = $policies['policies_active'] == 1 ? 0 : 1;

    $update = $db->update('policies',array("policies_active" => $policies_active), array("policies_id" => $id));
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