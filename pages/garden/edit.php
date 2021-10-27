<?php
$open = "garden";
require_once(__DIR__ . '/../../autoload/autoload.php');

$id = intval(getInput('id'));
$sql = "SELECT * FROM garden WhERE garden_id=$id";
$garden = $db->fetchcheck($sql);
if (empty($garden)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin($open);
}

$sql1 = "SELECT * FROM website_config";
$website_config = $db->fetchdata($sql1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data =
        [
            "garden_content" => postInput('garden_content'),
            "web_id" => postInput('web_id'),
            "garden_description" => postInput('garden_description')
        ];

    if ($post['garden_description'] != $data['garden_description']) {
        $id_update = $db->update("garden", $data, array("garden_id" => $id));
        if ($id_update > 0) {
            $_SESSION['success'] = " Cập nhật thành công ";
            redirectAdmin($open);
        } else {
            $_SESSION['error'] = " Dữ liệu không thay đổi ";
            redirectAdmin($open);
        }
    } else {
        $id_update = $db->update("garden", $data, array("garden_id" => $id));
        if ($id_update > 0) {
            $_SESSION['success'] = " Cập nhật thành công ";
            redirectAdmin($open);
        } else {
            $_SESSION['error'] = " Dữ liệu không thay đổi ";
            redirectAdmin($open);
        }
    }
}
?>

<?php
require_once(__DIR__ . '/../../layout/header.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thay đổi blog</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="./index.php">Vườn đẹp An Nhiên</a></li>
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
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Website</label>
                            <div class="col-sm-8">
                                <select class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="web_id">
                                    <?php foreach ($website_config as $item) : ?>
                                        <option <?php if ($item['web_id'] == $garden['web_id']) echo 'selected' ?> value="<?php echo $item['web_id'] ?>"><?php echo $item['web_name'] ?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Mô tả" name='garden_description' value="<?php echo $garden['garden_description']?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Blog</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='garden_content'>
                                    <?php echo $garden['garden_content'] ?>
                                </textarea>
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
require_once(__DIR__ . '/../../layout/footer.php');
?>