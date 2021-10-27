<?php
$open = "company";
require_once(__DIR__ . '/../../autoload/autoload.php');

$id = intval(getInput('id'));
$sql_check = "SELECT * FROM company WhERE company_id=$id";
$company_check = $db->fetchcheck($sql_check);
if (empty($company_check)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin($open);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors_img = "";
    $file_name = $_FILES['company_logo']['name'];
    $file_size = $_FILES['company_logo']['size'];
    $file_tmp = $_FILES['company_logo']['tmp_name'];
    $file_type = $_FILES['company_logo']['type'];
    $file_parts = explode('.', $_FILES['company_logo']['name']);
    $file_ext = strtolower(end($file_parts));
    $expensions = array("jpeg", "jpg", "png");

    $company_logo = $_FILES['company_logo']['name'];
    $target = "photo/" . basename($company_logo);
    $data =
        [
            "company_name" => postInput('company_name'),
            "company_logo" => $company_logo,
            "company_email" => postInput('company_email'),
            "company_address" => postInput('company_address'),
            "company_mobile" => postInput('company_mobile'),
            "company_phone" => postInput('company_phone'),
            "company_description" => postInput('company_description'),
            "company_content" => postInput('company_content')
        ];
    if (postInput('company_name') == '') {
        echo "<script>alert('Mời bạn nhập đầy đủ tên công ty');</script>";
    } else {
        if (in_array($file_ext, $expensions) === false) {
            echo "<script>alert('Chỉ hỗ trợ upload file JPEG hoặc PNG.');</script>";
        } else {
            if ($file_size > 2097152) {
                echo "<script>alert('Kích thước file không được lớn hơn 2MB.');</script>";
            } else {
                if ($post['company_name'] != $data['company_name']) {
                    $id_update = $db->update("company", $data, array("company_id" => $id));
                    if ($id_update > 0 && move_uploaded_file($_FILES['company_logo']['tmp_name'], $target)) {
                        $_SESSION['success'] = " Cập nhật thành công ";
                        redirectAdmin($open);
                    } else {
                        $_SESSION['error'] = " Dữ liệu không thay đổi ";
                        redirectAdmin($open);
                    }
                } else {
                    $id_update = $db->update("company", $data, array("company_id" => $id));
                    if ($id_update > 0 && move_uploaded_file($_FILES['company_logo']['tmp_name'], $target)) {
                        $_SESSION['success'] = " Cập nhật thành công ";
                        redirectAdmin($open);
                    } else {
                        $_SESSION['error'] = " Dữ liệu không thay đổi ";
                        redirectAdmin($open);
                    }
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
                    <h1>Thay đổi Dự án</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="./index.php">Danh sách Dự án</a></li>
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
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên công ty</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên Công ty" name='company_name' value="<?php echo $company_check['company_name'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Logo</label>
                            <div class="col-sm-8">
                                <input type="file" class='form-control-file' id="exampleFormControlFile1" name='company_logo' onchange="preview_thumbail_logo(this);">
                                <img width="100px" id="logo" src="./photo/<?php echo $company_check['company_logo'] ?>" alt="your image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Email" name='company_email' value="<?php echo $company_check['company_email'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Địa chỉ</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Địa chỉ" name='company_address' value="<?php echo $company_check['company_address'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Số điện thoại</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Số điện thoại" name='company_mobile' value="<?php echo $company_check['company_mobile'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Hotline</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="hotline" name='company_phone' value="<?php echo $company_check['company_phone'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Mô tả" name='company_description' value="<?php echo $company_check['company_description'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='company_content'>
                                    <?php echo $company_check['company_content'] ?>
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