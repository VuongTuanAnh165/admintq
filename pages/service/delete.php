<?php /*session_destroy();*/
    $open = "service";
    require_once(__DIR__ . '/../../autoload/autoload.php');

    $id = intval(getInput('id'));
    $sql="SELECT * FROM service WhERE service_id=$id";
    $service = $db->fetchcheck($sql);

    if(empty($service))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    else
    {
        $sql1="DELETE FROM service WHERE service_id=$id";
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