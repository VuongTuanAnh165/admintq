<?php
    $open = "website_config";
    require_once(__DIR__ . '/../../autoload/autoload.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data =
            [
                "web_name" => postInput('web_name'),
                "web_icon" => postInput('web_icon'),
                "web_description" => postInput('web_description'),
                "web_domain" => postInput('web_domain')
            ];

        $error = [];
        if (postInput('web_name') == '') 
        {
            $error['web_name'] = "Mời bạn nhập đầy đủ tên website";
        }

        if (empty($error)) 
        {
            $id_insert = $db->insert("website_config", $data);
            if ($id_insert > 0) 
            {
                $_SESSION['success'] = " Thêm mới thành công ";
                redirectAdmin($open);
            } 
            else 
            {
                $_SESSION['error'] = " Thêm mới thất bại ";
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
                    <h1>Thêm mới website</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="./index.php">Danh sách website</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
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
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên website</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên website" name='web_name'>
                                <?php if (isset($error['web_name'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['web_name'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên miền</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên miền" name='web_domain'>
                                <?php if (isset($error['web_domain'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['web_domain'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Logo</label>
                            <div class="col-sm-8">
                                <input type="file" class='form-control-file' id="exampleFormControlFile1" name='web_icon' onchange="preview_thumbail_logo(this);">
                                <?php if (isset($error['web_icon'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['web_icon'] ?>
                                <?php endif; ?>
                                <img id="logo" src="#" alt="your image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Mô tả" name='web_description'>
                                <?php if (isset($error['web_description'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['web_description'] ?>
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