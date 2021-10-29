<?php
$open = "post_type";
require_once(__DIR__ . '/../../autoload/autoload.php');
$sql1 = "SELECT * FROM website_config";
$website_config = $db->fetchdata($sql1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = $_FILES['post_type_img']['name'];
    $file_size = $_FILES['post_type_img']['size'];
    $file_tmp = $_FILES['post_type_img']['tmp_name'];
    $file_type = $_FILES['post_type_img']['type'];
    $file_parts = explode('.', $_FILES['post_type_img']['name']);
    $file_ext = strtolower(end($file_parts));
    $expensions = array("jpeg", "jpg", "png");

    $post_type_img = $_FILES['post_type_img']['name'];
    $target =base_img($open) . "photo/" . basename($post_type_img);
    $data =
        [
            "post_type_title" => postInput('post_type_title'),
            "post_type_description" => postInput('post_type_description'),
            "web_id" => postInput('web_id'),
            "post_type_img" => $post_type_img
        ];

    if (postInput('post_type_title') == '') {
        echo "<script>alert('Mời bạn nhập đầy đủ tên nhóm dịch vụ');</script>";
    } else {
        if (in_array($file_ext, $expensions) === false) {
            echo "<script>alert('Chỉ hỗ trợ upload file JPEG hoặc PNG.');</script>";
        } else {
            if ($file_size > 2097152) {
                echo "<script>alert('Kích thước file không được lớn hơn 2MB.');</script>";
            } else {
                $id_insert = $db->insert("post_type", $data);
                if ($id_insert > 0 && move_uploaded_file($_FILES['post_type_img']['tmp_name'], $target)) {
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
                    <h1>Thêm mới nhóm bài viết</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="./index.php">Danh sách nhóm bài viết</a></li>
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
                            <label for="inputEmail3" class="col-sm-2 control-lable">Website</label>
                            <div class="col-sm-8">
                                <select class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="web_id">
                                    <?php foreach ($website_config as $item) : ?>
                                        <option value="<?php echo $item['web_id'] ?>"><?php echo $item['web_name'] ?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên tiêu đề</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên tiêu đề" name='post_type_title'>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Ảnh nền</label>
                            <div class="col-sm-8">
                                <input type="file" class='form-control-file' id="exampleFormControlFile1" name='post_type_img' onchange="preview_thumbail_logo(this);">
                                <img id="logo" src="#" alt="your image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='post_type_description'>

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