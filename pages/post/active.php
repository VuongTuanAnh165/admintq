<?php 
    $open="post";
    require_once ( __DIR__ . '/../../autoload/autoload.php');
     
    $id = intval(getInput('id'));
    $sql="SELECT * FROM post WhERE post_id=$id";
    $post = $db->fetchcheck($sql);
    if(empty($post))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    
    $post_active = $post['post_active'] == 1 ? 0 : 1;

    $update = $db->update('post',array("post_active" => $post_active), array("post_id" => $id));
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