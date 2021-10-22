<?php 
    $open="website_config";
    require_once ( __DIR__ . '/../../autoload/autoload.php');
     
    $id = intval(getInput('id'));
    $sql="SELECT * FROM website_config WhERE web_id=$id";
    $website_config = $db->fetchcheck($sql);
    if(empty($website_config))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    
    $web_active = $website_config['web_active'] == 1 ? 0 : 1;

    $update = $db->update('website_config',array("web_active" => $web_active), array("web_id" => $id));
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