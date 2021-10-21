<?php
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

    $sql1="SELECT * FROM service_group";
    $service_group=$db->fetchdata($sql1);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data =
            [
                "service_name" => postInput('service_name'),
                "service_description" => postInput('service_description'),
                "service_content" => postInput('service_content'),
                "service_gr_id" => postInput('service_gr_id'),
                "service_image" => postInput('service_image')
            ];

        $error = [];
        if (postInput('service_name') == '') 
        {
            $error['service_name'] = "Mời bạn nhập đầy đủ tên sản phẩm";
        }

        if(empty($error))
        {
            if($service['service_name'] != $data['service_name'])
            {
                $id_update = $db->update("service",$data,array("service_id"=>$id));
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
                $id_update = $db->update("service",$data,array("service_id"=>$id));
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
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên dịch vụ</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên sản phẩm" name='service_name' value="<?php echo $service['service_name']?>">
                                <?php if (isset($error['service_name'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['service_name'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='service_description'>
                                    <?php echo $service['service_name']?>
                                </textarea> 
                                <?php if (isset($error['service_description'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['service_description'] ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Hình ảnh</label>
                            <div class="col-sm-8">
                                <input type="file" class='form-control-file' id="exampleFormControlFile1" name='service_image' onchange="preview_thumbail1(this);">
                                <?php if (isset($error['service_image'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['service_image'] ?>
                                <?php endif; ?>
                                <img width="100px" id="anh1" src="./photo/<?php echo $service['service_image'] ?>" alt="<?php echo $service['service_image'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="codeMirrorDemo" class="p-3" name='service_content'>
                                    <?php echo $service['service_content'] ?>
                                </textarea>
                                <?php if (isset($error['service_content'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['service_content'] ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Nhóm dịch vụ</label>
                            <div class="col-sm-8">
                                <select class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="service_gr_id">
                                    <?php foreach ($service_group as $item) :?>
                                        <option <?php if($item['service_gr_id']==$service['service_gr_id']) echo 'selected'?> value="<?php echo $item['service_gr_id']?>"><?php echo $item['service_gr_name'] ?></option>
                                    <? endforeach ?>
                                </select>
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