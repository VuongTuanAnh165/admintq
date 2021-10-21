<?php
    $open = "product_group";
    require_once(__DIR__ . '/../../autoload/autoload.php');
    $sql1="SELECT * FROM website_config";
    $website_config=$db->fetchdata($sql1);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data =
            [
                "product_gr_name" => postInput('product_gr_name'),
                "product_gr_description" => postInput('product_gr_description'),
                "web_id" => postInput('web_id')
            ];

        $error = [];
        if (postInput('product_gr_name') == '') 
        {
            $error['product_gr_name'] = "Mời bạn nhập đầy đủ tên sản phẩm";
        }

        if (empty($error)) 
        {
            $id_insert = $db->insert("product_group", $data);
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
                    <h1>Thêm mới sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="./index.php">Danh sách sản phẩm</a></li>
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
                            <label for="inputEmail3" class="col-sm-2 control-lable">Website</label>
                            <div class="col-sm-8">
                                <select class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="web_id">
                                    <?php foreach ($website_config as $item) :?>
                                        <option value="<?php echo $item['web_id']?>"><?php echo $item['web_name'] ?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên sản phẩm" name='product_gr_name'>
                                <?php if (isset($error['product_gr_name'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['product_gr_name'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='product_gr_description'>

                                </textarea>
                                <?php if (isset($error['product_gr_description'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['product_gr_description'] ?>
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