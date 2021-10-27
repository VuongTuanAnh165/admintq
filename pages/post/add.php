<?php
$open = "post";
require_once(__DIR__ . '/../../autoload/autoload.php');
$sql1 = "SELECT * FROM website_config";
$sql2 = "SELECT * FROM post_type";
$sql3 = "SELECT * FROM product";
$website_config = $db->fetchdata($sql1);
$post_type = $db->fetchdata($sql2);
$product = $db->fetchdata($sql3);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();
    $file_name = $_FILES['post_image1']['name'];
    $file_size = $_FILES['post_image1']['size'];
    $file_tmp = $_FILES['post_image1']['tmp_name'];
    $file_type = $_FILES['post_image1']['type'];
    $file_parts = explode('.', $_FILES['post_image1']['name']);
    $file_ext = strtolower(end($file_parts));
    $expensions = array("jpeg", "jpg", "png");
    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "Chỉ hỗ trợ upload file JPEG hoặc PNG.";
    } else {
        if ($file_size > 2097152) {
            $errors[] = 'Kích thước file không được lớn hơn 2MB';
        } else {
            $post_image1 = $_FILES['post_image1']['name'];
            $target = "photo/" . basename($post_image1);
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

            $error = [];
            if (postInput('post_title') == '') {
                $error['post_title'] = "Mời bạn nhập đầy đủ tiêu đề bài viết";
            }

            if (empty($error)) {
                $id_insert = $db->insert("post", $data);
                if ($id_insert > 0 && move_uploaded_file($_FILES['post_image1']['tmp_name'], $target)) {
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
                    <h1>Thêm mới bài viết</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="./index.php">Danh sách bài viết</a></li>
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
                            <label for="inputEmail3" class="col-sm-2 control-lable">Nhóm bài viết</label>
                            <div class="col-sm-8">
                                <select class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="post_type_id">
                                    <?php foreach ($post_type as $item) : ?>
                                        <option value="<?php echo $item['post_type_id'] ?>"><?php echo $item['post_type_title'] ?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên tiêu đề</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên tiêu đề" name='post_title'>
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
                                <img id="post1" src="#" alt="your image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Mô tả" name='post_description'>
                                <?php if (isset($error['post_description'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['post_description'] ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='ptd_text'>

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
                                        <option value="<?php echo $item['product_id'] ?>"><?php echo $item['product_name'] ?></option>
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