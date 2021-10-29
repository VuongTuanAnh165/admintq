<?php
$open = "post";
require_once(__DIR__ . '/../../autoload/autoload.php');

$id = intval(getInput('id'));
$sql = "SELECT * FROM post WhERE post_id=$id";
$post = $db->fetchcheck($sql);
if (empty($post)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin($open);
}

$sql1 = "SELECT * FROM website_config";
$sql2 = "SELECT * FROM post_type";
$sql3 = "SELECT * FROM product";
$website_config = $db->fetchdata($sql1);
$post_type = $db->fetchdata($sql2);
$product = $db->fetchdata($sql3);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = $_FILES['post_image1']['name'];
    $file_size = $_FILES['post_image1']['size'];
    $file_tmp = $_FILES['post_image1']['tmp_name'];
    $file_type = $_FILES['post_image1']['type'];
    $file_parts = explode('.', $_FILES['post_image1']['name']);
    $file_ext = strtolower(end($file_parts));
    $expensions = array("jpeg", "jpg", "png");
    $post_image1 = $_FILES['post_image1']['name'];
    $target =base_img($open) . "photo/" . basename($post_image1);
    $data =
        [
            "post_title" => postInput('post_title'),
            "post_description" => postInput('post_description'),
            "ptd_text" => postInput('ptd_text'),
            "product_id" => postInput('product_id'),
            "post_type_id" => postInput('post_type_id'),
            "web_id" => postInput('web_id'),
            "post_image1" => $post_image1
        ];

    if (postInput('post_title') == '') {
        echo "<script>alert('Mời bạn nhập đầy đủ tên dịch vụ');</script>";
    } else {
        if (in_array($file_ext, $expensions) === false) {
            echo "<script>alert('Chỉ hỗ trợ upload file JPEG hoặc PNG.');</script>";
        } else {
            if ($file_size > 2097152) {
                echo "<script>alert('Kích thước file không được lớn hơn 2MB.');</script>";
            } else {
                if ($post['post_title'] != $data['post_title']) {
                    $id_update = $db->update("post", $data, array("post_id" => $id));
                    if ($id_update > 0 && move_uploaded_file($_FILES['post_image1']['tmp_name'], $target)) {
                        $_SESSION['success'] = " Cập nhật thành công ";
                        redirectAdmin($open);
                    } else {
                        $_SESSION['error'] = " Dữ liệu không thay đổi ";
                        redirectAdmin($open);
                    }
                } else {
                    $id_update = $db->update("post", $data, array("post_id" => $id));
                    if ($id_update > 0 && move_uploaded_file($_FILES['post_image1']['tmp_name'], $target)) {
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
                    <h1>Thay đổi bài viết</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="./index.php">Danh sách bài viết</a></li>
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
                                        <option <?php if ($item['web_id'] == $post['web_id']) echo 'selected' ?> value="<?php echo $item['web_id'] ?>"><?php echo $item['web_name'] ?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Nhóm bài viết</label>
                            <div class="col-sm-8">
                                <select class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="post_type_id">
                                    <?php foreach ($post_type as $item) : ?>
                                        <option <?php if ($item['post_type_id'] == $post['post_type_id']) echo 'selected' ?> value="<?php echo $item['post_type_id'] ?>"><?php echo $item['post_type_title'] ?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên tiêu đề</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên sản phẩm" name='post_title' value="<?php echo $post['post_title'] ?>">
                                <?php if (isset($error['post_title'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['post_title'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Hình ảnh</label>
                            <div style="margin-bottom: 1%;" class="col-sm-8">
                                <input type="file" class='form-control-file' id="exampleFormControlFile1" name='post_image1' onchange="preview_thumbailpost1(this);">
                                <?php if (isset($error['post_image1'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['post_image1'] ?>
                                <?php endif; ?>
                                <img id="post1" width="100px" src="./photo/<?php echo $post['post_image1'] ?>" alt="<?php echo $post['post_image1'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Mô tả" name='post_description' value="<?php echo $post['post_description'] ?>">
                                <?php if (isset($error['post_description'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['post_description'] ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='ptd_text'>
                                    <?php echo $post['ptd_text'] ?>
                                </textarea>
                                <?php if (isset($error['ptd_text'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['ptd_text'] ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Sản phẩm liên kết</label>
                            <div class="col-sm-8">
                                <select class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="product_id">
                                    <?php foreach ($product as $item) : ?>
                                        <option <?php if ($item['product_id'] == $post['product_id']) echo 'selected' ?> value="<?php echo $item['product_id'] ?>"><?php echo $item['product_name'] ?></option>
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
require_once(__DIR__ . '/../../layout/footer.php');
?>