<?php
  require_once ( __DIR__ . '/autoload/autoload.php');
  if(!isset($_SESSION["username"]))  
 {  
      header("location:login.php");  
 }  
?>

<?php
    require_once ( __DIR__ . '/layout/header.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Trang quản trị</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div style="width:960px; margin: auto; overflow: hidden">
        <h3 style="color: #002247; text-align: center">WEBSITE MULTIPLE MANAGEMENT</h3>
        <p style="text-align: center; position: relative">
            <img src="/image/banner.png" alt="welcome image">
        </p>
        <p style="text-align:center; margin: 0 auto; font-family: Arial; font-weight: bold; width: 700px; line-height: 25px">
            Hệ thống quản lý đa website, hỗ trợ doanh nghiệp quản lý website một cách nhanh chóng, tiện lợi. 
            Mang đến những trải nghiệm tốt nhất và thú vị cho người dùng.
        </p>
    </div>
  <!-- /.content -->
</div>

<?php
    require_once ( __DIR__ . '/layout/footer.php');
?>
