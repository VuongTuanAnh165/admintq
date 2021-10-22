<?php
    $open = "policies";
    require_once(__DIR__ . '/../../autoload/autoload.php');

    $id = intval(getInput('id'));
    $sql="SELECT * FROM policies WhERE policies_id=$id";
    $policies = $db->fetchcheck($sql);
    if(empty($policies))
    {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin($open);
    }

    $sql1="SELECT * FROM website_config";
    $website_config=$db->fetchdata($sql1);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data =
            [
                "policies_title" => postInput('policies_title'),
                "policies_description" => postInput('policies_description'),
                "policies_content" => postInput('policies_content'),
                "web_id" => postInput('web_id')
            ];

        $error = [];
        if (postInput('policies_title') == '') 
        {
            $error['policies_title'] = "Mời bạn nhập đầy đủ tên chính sách";
        }

        if(empty($error))
        {
            if($post['policies_title'] != $data['policies_title'])
            {
                $id_update = $db->update("policies",$data,array("policies_id"=>$id));
                if($id_update > 0)
                {
                    $_SESSION['success'] = " Cập nhật thành công ";
                    redirectAdmin($open);
                }
                else
                {
                    $_SESSION['error'] = " Dữ liệu không thay đổi ";
                    redirectAdmin($open);
                }  
            } 
            else
            {
                $id_update = $db->update("policies",$data,array("policies_id"=>$id));
                if($id_update > 0)
                {
                    $_SESSION['success'] = " Cập nhật thành công ";
                    redirectAdmin($open);
                }
                else
                {
                    $_SESSION['error'] = " Dữ liệu không thay đổi ";
                    redirectAdmin($open);
                }
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
                    <h1>Thay đổi chính sách</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="./index.php">Danh sách chính sách</a></li>
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
                    <form class="form-horizontal" action="" method="POST">

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Website</label>
                            <div class="col-sm-8">
                                <select class="form-control form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="web_id">
                                    <?php foreach ($website_config as $item) :?>
                                        <option <?php if($item['web_id']==$policies['web_id']) echo 'selected'?> value="<?php echo $item['web_id']?>"><?php echo $item['web_name'] ?></option>
                                    <? endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Tên tiêu đề</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Tên tiêu đề" name='policies_title' value="<?php echo $policies['policies_title']?>">
                                <?php if (isset($error['policies_title'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['policies_title'] ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Mô tả" name='policies_description' value="<?php echo $policies['policies_description']?>">
                                <?php if (isset($error['policies_description'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['policies_description'] ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-lable">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" id="summernote" name='policies_content'>
                                    <?php echo $policies['policies_content']?>
                                </textarea> 
                                <?php if (isset($error['policies_content'])) :  ?>
                                    <p class="text-danger"></p> <?php echo $error['policies_content'] ?>
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