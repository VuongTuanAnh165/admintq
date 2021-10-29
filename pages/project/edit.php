<?php
$open = "project";
require_once(__DIR__ . '/../../autoload/autoload.php');

$id = intval(getInput('id'));
$sql = "SELECT * FROM project WhERE project_id=$id";
$project = $db->fetchcheck($sql);
if (empty($project)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin($open);
}

$sql1 = "SELECT * FROM website_config";
$website_config = $db->fetchdata($sql1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors_img = "";
    $file_name = $_FILES['project_img']['name'];
    $file_size = $_FILES['project_img']['size'];
    $file_tmp = $_FILES['project_img']['tmp_name'];
    $file_type = $_FILES['project_img']['type'];
    $file_parts = explode('.', $_FILES['project_img']['name']);
    $file_ext = strtolower(end($file_parts));
    $expensions = array("jpeg", "jpg", "png");

    $project_img = $_FILES['project_img']['name'];
    $target =base_img($open) . "photo/" . basename($project_img);
    $data =
        [
            "project_name" => postInput('project_name'),
            "project_img" => $project_img,
            "project_description" => postInput('project_description'),
            "project_status" => postInput('project_status'),
            "web_id" => postInput('web_id'),
            "project_content" => postInput('project_content')
        ];
    if (postInput('project_name') == '') {
        echo "<script>alert('Mời bạn nhập đầy đủ tên dự án');</script>";
    } else {
        if (in_array($file_ext, $expensions) === false) {
            echo "<script>alert('Chỉ hỗ trợ upload file JPEG hoặc PNG.');</script>";
        } else {
            if ($file_size > 2097152) {
                echo "<script>alert('Kích thước file không được lớn hơn 2MB.');</script>";
            } else {
                if ($post['project_name'] != $data['project_name']) {
                    $id_update = $db->update("project", $data, array("project_id" => $id));
                    if ($id_update > 0 && move_uploaded_file($_FILES['project_img']['tmp_name'], $target)) {
                        $_SESSION['success'] = " Cập nhật thành công ";
                        redirectAdmin($open);
                    } else {
                        $_SESSION['error'] = " Dữ liệu không thay đổi ";
                        redirectAdmin($open);
                    }
                } else {
                    $id_update = $db->update("project", $data, array("project_id" => $id));
                    if ($id_update > 0 && move_uploaded_file($_FILES['project_img']['tmp_name'], $target)) {
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
                            <label for="inputEmail3" class="col-sm-2 control-lable">Website</label>
                            <div class="col-sm-8">
                                <select class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="web_id">
                                    <?php foreach ($website_config as $item) : ?>
                                        <option <?php if ($item['web_id'] == $project['web_id']) echo 'selected' ?> value="<?php echo $item['web_id'] ?>"><?php echo $item['web_name'] ?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên dự án</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên dự án" name='project_name' value="<?php echo $project['project_name'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Ảnh nền</label>
                            <div class="col-sm-8">
                                <input type="file" class='form-control-file' id="exampleFormControlFile1" name='project_img' onchange="preview_thumbail_logo(this);">
                                <img width="100px" id="logo" src="./photo/<?php echo $project['project_img'] ?>" alt="your image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Mô tả" name='project_description' value="<?php echo $project['project_description'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Kết quả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Kết quả" name='project_status' value="<?php echo $project['project_status'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='project_content'>
                                    <?php echo $project['project_content'] ?>
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