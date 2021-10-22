<?php /*session_destroy();*/
    $open = "policies";
    require_once(__DIR__ . '/../../autoload/autoload.php');

    $id = intval(getInput('id'));
    $sql="SELECT * FROM policies WhERE policies_id=$id";
    $policies = $db->fetchcheck($sql);

    if(empty($policies))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    else
    {
        $sql1="DELETE FROM policies WHERE policies_id=$id";
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