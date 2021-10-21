<?php
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

    $sql1="SELECT * FROM website_config";
    $website_config=$db->fetchdata($sql1);

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $data =
            [
                "service_gr_name" => postInput('service_gr_name'),
                "service_gr_description" => postInput('service_gr_description'),
                "web_id" => postInput('web_id')
            ];

        $error = [];
        if (postInput('service_gr_name') == '') 
        {
            $error['service_gr_name'] = "Mời bạn nhập đầy đủ tên sản phẩm";
        }

        if(empty($error))
        {
            if($service_group['service_gr_name'] != $data['service_gr_name'])
            {
                $id_update = $db->update("service_group",$data,array("service_gr_id"=>$id));
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
                $id_update = $db->update("service_group",$data,array("service_gr_id"=>$id));
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
                    <h1>Thay đổi dịch vụ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="./index.php">Danh sách dịch vụ</a></li>
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
                            <label for="inputEmail3" class="col-sm-2 control-lable">Website</label>
                            <div class="col-sm-8">
                                <select class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="web_id">
                                    <?php foreach ($website_config as $item) :?>
                                        <option <?php if($item['web_id']==$service_group['web_id']) echo 'selected'?> value="<?php echo $item['web_id']?>"><?php echo $item['web_name'] ?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên nhóm dịch vụ</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên nhóm dịch vụ" name='service_gr_name' value="<?php echo $service_group['service_gr_name']?>">
                                <?php if (isset($error['service_gr_name'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['service_gr_name'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="summernote" name='service_gr_description'>
                                    <?php echo $service_group['service_gr_description']?>
                                </textarea> 
                                <?php if (isset($error['service_gr_description'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['service_gr_description'] ?>
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