<?php 
    $open="company";
    require_once ( __DIR__ . '/../../autoload/autoload.php');
     
    $id = intval(getInput('id'));
    $sql="SELECT * FROM company WhERE company_id=$id";
    $company = $db->fetchcheck($sql);
    if(empty($company))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }
    
    $company_active = $company['company_active'] == 1 ? 0 : 1;

    $update = $db->update('company',array("company_active" => $company_active), array("company_id" => $id));
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