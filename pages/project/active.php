<?php 
    $open="project";
    require_once ( __DIR__ . '/../../autoload/autoload.php');
     
    $id = intval(getInput('id'));
    $sql="SELECT * FROM project WhERE project_id=$id";
    $project = $db->fetchcheck($sql);
    if(empty($project))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    
    $project_active = $project['project_active'] == 1 ? 0 : 1;

    $update = $db->update('project',array("project_active" => $project_active), array("project_id" => $id));
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