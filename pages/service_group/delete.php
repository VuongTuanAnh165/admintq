<?php /*session_destroy();*/
    $open = "service_group";
    require_once(__DIR__ . '/../../autoload/autoload.php');

    $id = intval(getInput('id'));
    $sql="SELECT * FROM service_group WhERE service_gr_id=$id";
    $service_group = $db->fetchcheck($sql);

    if(empty($service_group))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    else
    {
        $sql1="DELETE FROM service_group WHERE service_gr_id=$id";
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