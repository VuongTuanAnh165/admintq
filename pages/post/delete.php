<?php /*session_destroy();*/
    $open = "post";
    require_once(__DIR__ . '/../../autoload/autoload.php');

    $id = intval(getInput('id'));
    $sql="SELECT * FROM post WhERE post_id=$id";
    $post = $db->fetchcheck($sql);

    if(empty($post))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    else
    {
        $sql1="DELETE FROM post WHERE post_id=$id";
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