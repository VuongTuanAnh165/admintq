<?php
    require_once ( __DIR__ . '/../../autoload/autoload.php');
    $sql="SELECT *  FROM product_group";
    $product_group = $db->fetchdata($sql);
?>

<?php
    require_once ( __DIR__ . '/../../layout/header.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sản phẩm <a href="./add.php" class="btn btn-success">Thêm mới</a></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Nhóm sản phẩm sản phẩm</li>
                    </ol>
                </div>
            </div>
            <div class="clearfix">

            </div>
            <?php require_once "../notification.php"; ?>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bảng nhóm sản phẩm</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead> 
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 1; foreach ($product_group as $item) : ?>
                                        <tr>
                                            <td><?php echo $stt ?></td>
                                            <td><?php echo $item['product_gr_name'] ?></td>
                                            <td><?php echo $item['product_gr_description'] ?></td>
                                            <td>
                                                <a href="active.php?id=<?php echo $item['product_gr_id'] ?>" class="btn btn-xs <?php echo $item['product_gr_active'] == 1 ? 'btn-info' : 'btn-dark' ?> ">
                                                    <?php echo $item['product_gr_active'] == 1 ? 'Đã kích hoạt' : 'Chưa kích hoạt' ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-info" href='edit.php?id=<?php echo $item["product_gr_id"] ?>'><i class="fa fa-edit"></i>Sửa</a>
                                                <a class="btn btn-xs btn-danger" href='delete.php?id=<?php echo $item["product_gr_id"] ?>'><i class="fa fa-times"></i>Xóa</a>
                                            </td>
                                        </tr>
                                    <?php $stt++; endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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