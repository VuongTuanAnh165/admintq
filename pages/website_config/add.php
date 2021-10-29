<?php
$open = "website_config";
require_once(__DIR__ . '/../../autoload/autoload.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = $_FILES['web_icon']['name'];
    $file_size = $_FILES['web_icon']['size'];
    $file_tmp = $_FILES['web_icon']['tmp_name'];
    $file_type = $_FILES['web_icon']['type'];
    $file_parts = explode('.', $_FILES['web_icon']['name']);
    $file_ext = strtolower(end($file_parts));
    $expensions = array("jpeg", "jpg", "png");
    $web_icon = $_FILES['web_icon']['name'];
    $target = base_img($open) ."photo/" . basename($web_icon);
    $data =
        [
            "web_name" => postInput('web_name'),
            "web_icon" => $web_icon,
            "web_description" => postInput('web_description'),
            "web_domain" => postInput('web_domain')
        ];

    if (postInput('web_name') == '') {
        echo "<script>alert('Mời bạn nhập đầy đủ tên website');</script>";
    } else {
        if (in_array($file_ext, $expensions) === false) {
            echo "<script>alert('Chỉ hỗ trợ upload file JPEG hoặc PNG.');</script>";
        } else {
            if ($file_size > 2097152) {
                echo "<script>alert('Kích thước file không được lớn hơn 2MB.');</script>";
            } else {
                $id_insert = $db->insert("website_config", $data);
                if ($id_insert > 0 && move_uploaded_file($_FILES['web_icon']['tmp_name'], $target)) {
                    $_SESSION['success'] = " Thêm mới thành công ";
                    redirectAdmin($open);
                } else {
                    $_SESSION['error'] = " Thêm mới thất bại ";
                }
            }
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
                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên website</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên website" name='web_name'>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên miền</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên miền" name='web_domain'>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Logo</label>
                            <div class="col-sm-8">
                                <input type="file" class='form-control-file' id="exampleFormControlFile1" name='web_icon' onchange="preview_thumbail_logo(this);">

                                <img id="logo" src="#" alt="your image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Mô tả" name='web_description'>

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