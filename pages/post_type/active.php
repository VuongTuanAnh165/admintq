<?php 
    $open="post_type";
    require_once ( __DIR__ . '/../../autoload/autoload.php');
     
    $id = intval(getInput('id'));
    $sql="SELECT * FROM post_type WhERE post_type_id=$id";
    $post_type = $db->fetchcheck($sql);
    if(empty($post_type))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    
    $post_type_active = $post_type['post_type_active'] == 1 ? 0 : 1;

    $update = $db->update('post_type',array("post_type_active" => $post_type_active), array("post_type_id" => $id));
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