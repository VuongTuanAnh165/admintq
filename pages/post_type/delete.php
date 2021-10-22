<?php /*session_destroy();*/
    $open = "post_type";
    require_once(__DIR__ . '/../../autoload/autoload.php');

    $id = intval(getInput('id'));
    $sql="SELECT * FROM post_type WhERE post_type_id=$id";
    $post_type = $db->fetchcheck($sql);

    if(empty($post_type))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    else
    {
        $sql1="DELETE FROM post_type WHERE post_type_id=$id";
        $id_delete = $db->delete($sql1);
        if($id_delete > 0)
        {
            $_SESSION['success'] = " Xóa thành công ";
            redirectAdmin($open);
        }
        else
        {
            $_SESSION['error'] = " Không có dữ liệu ";
        }
    }
?>