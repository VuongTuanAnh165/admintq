<?php
$open = "service";
require_once(__DIR__ . '/../../autoload/autoload.php');
$sql = "SELECT * FROM service_group";
$service_group = $db->fetchdata($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = $_FILES['service_image']['name'];
    $file_size = $_FILES['service_image']['size'];
    $file_tmp = $_FILES['service_image']['tmp_name'];
    $file_type = $_FILES['service_image']['type'];
    $file_parts = explode('.', $_FILES['service_image']['name']);
    $file_ext = strtolower(end($file_parts));
    $expensions = array("jpeg", "jpg", "png");
    $service_image = $_FILES['service_image']['name'];
    $target = "photo/" . basename($service_image);
    $data =
        [
            "service_name" => postInput('service_name'),
            "service_description" => postInput('service_description'),
            "service_content" => postInput('service_content'),
            "service_gr_id" => postInput('service_gr_id'),
            "service_image" => $service_image
        ];

    if (postInput('service_name') == '') {
        echo "<script>alert('Mời bạn nhập đầy đủ tên dịch vụ');</script>";
    } else {
        if (in_array($file_ext, $expensions) === false) {
            echo "<script>alert('Chỉ hỗ trợ upload file JPEG hoặc PNG.');</script>";
        } else {
            if ($file_size > 2097152) {
                echo "<script>alert('Kích thước file không được lớn hơn 2MB.');</script>";
            } else {
                $id_insert = $db->insert("service", $data);
                if ($id_insert > 0 && move_uploaded_file($_FILES['service_image']['tmp_name'], $target)) {
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
                    <h1>Thêm mới dịch vụ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="./index.php">Danh sách dịch vụ</a></li>
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
                            <label for="inputEmail3" class="col-sm-2 control-lable">Nhóm dịch vụ</label>
                            <div class="col-sm-8">
                                <select class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="service_gr_id">
                                    <?php foreach ($service_group as $item) : ?>
                                        <option value="<?php echo $item['service_gr_id'] ?>"><?php echo $item['service_gr_name'] ?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên dịch vụ</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên dịch vụ" name='service_name'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="mô tả" name='service_description'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Hình ảnh</label>
                            <div class="col-sm-8">
                                <input type="file" class='form-control-file' id="exampleFormControlFile1" name='service_image' onchange="preview_thumbail1(this);">
                                <img id="anh1" src="#" alt="your image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='service_content'>

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