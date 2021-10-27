<?php
    require_once ( __DIR__ . '/../../layout/header.php');
?>
<?php
    require_once ( __DIR__ . '/../../autoload/autoload.php');
    $sql="SELECT * FROM user_tb,website_config,service_group WHERE user_tb.web_id=website_config.web_id AND user_tb.service_gr_id=service_group.service_gr_id";
    $user_tb = $db->fetchdata($sql);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Khách hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách khách hàng</li>
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
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bảng danh sách khách hàng</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead> 
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên khách hàng</th>
                                        <th>SĐT</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Website</th>
                                        <th>Nhóm dịch vụ</th>
                                        <th>Tin nhắn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 1; foreach ($user_tb as $item) : ?>
                                        <tr>
                                            <td><?php echo $stt ?></td>
                                            <td><?php echo $item['user_name'] ?></td>
                                            <td><a href="tel:<?php echo $item['user_number_phone'] ?>"><?php echo $item['user_number_phone'] ?></a></td> 
                                            <td><a href="mailto:<?php echo $item['user_email'] ?>"><?php echo $item['user_email'] ?></a></td>                                     
                                            <td><?php echo $item['user_address'] ?></td>
                                            <td><?php echo $item['web_name'] ?></td>
                                            <td><?php echo $item['service_gr_name'] ?></td>
                                            <td><?php echo $item['user_cmt'] ?></td>
                                        </tr>
                                    <?php $stt++; endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên khách hàng</th>
                                        <th>SĐT</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Website</th>
                                        <th>Nhóm dịch vụ</th>
                                        <th>Tin nhắn</th>
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