<?php
    $open = "company";
    require_once(__DIR__ . '/../../autoload/autoload.php');

    $id = intval(getInput('id'));
    $sql="SELECT * FROM company WhERE company_id=$id";
    $company = $db->fetchcheck($sql);
    if(empty($company))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data =
            [
                "company_name" => postInput('company_name'),
                "company_email" => postInput('company_email'),
                "company_address" => postInput('company_address'),
                "company_mobile" => postInput('company_mobile'),
                "company_phone" => postInput('company_phone'),
                "company_logo" => postInput('company_logo'),
                "company_description" => postInput('company_description')
            ];

        $error = [];
        if (postInput('company_name') == '') 
        {
            $error['company_name'] = "Mời bạn nhập đầy đủ tên companysite";
        }

        if(empty($error))
        {
            if($post['company_name'] != $data['company_name'])
            {
                $id_update = $db->update("company",$data,array("company_id"=>$id));
                if($id_update > 0)
                {
                    $_SESSION['success'] = " Cập nhật thành công ";
                    redirectAdmin($open);
                }
                else
                {
                    $_SESSION['error'] = " Dữ liệu không thay đổi ";
                    redirectAdmin($open);
                }  
            } 
            else
            {
                $id_update = $db->update("company",$data,array("company_id"=>$id));
                if($id_update > 0)
                {
                    $_SESSION['success'] = " Cập nhật thành công ";
                    redirectAdmin($open);
                }
                else
                {
                    $_SESSION['error'] = " Dữ liệu không thay đổi ";
                    redirectAdmin($open);
                }
            }
        }
    }
?>

<?php
    require_once ( __DIR__ . '/../../layout/header.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thay đổi thông tin công ty</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="./index.php">Thông tin công ty</a></li>
                        <li class="breadcrumb-item active">Sửa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form class="form-horizontal" action="" method="POST">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên công ty</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên công ty" name='company_name' value="<?php echo $company['company_name']?>">
                                <?php if (isset($error['company_name'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['company_name'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Logo</label>
                            <div class="col-sm-8">
                                <input type="file" class='form-control-file' id="exampleFormControlFile1" name='company_logo' onchange="preview_thumbail_logo(this);">
                                <?php if (isset($error['company_logo'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['company_logo'] ?>
                                <?php endif; ?>
                                <img id="logo" width="100px" src="./photo/<?php echo $company['company_logo'] ?>" alt="<?php echo $company['company_logo'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên miền" name='company_email' value="<?php echo $company['company_email']?>">
                                <?php if (isset($error['company_email'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['company_email'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Hostline</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên miền" name='company_phone' value="<?php echo $company['company_phone']?>">
                                <?php if (isset($error['company_phone'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['company_phone'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Số điện thoại</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên miền" name='company_mobile' value="<?php echo $company['company_mobile']?>">
                                <?php if (isset($error['company_mobile'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['company_mobile'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Địa chỉ</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên miền" name='company_address' value="<?php echo $company['company_address']?>">
                                <?php if (isset($error['company_address'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['company_address'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Mô tả" name='company_description' value="<?php echo $company['company_description'] ?>">
                                <?php if (isset($error['company_description'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['company_description'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="from-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php
    require_once ( __DIR__ . '/../../layout/footer.php');
?>