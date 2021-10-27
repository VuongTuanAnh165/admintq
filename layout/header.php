<?php
    require_once ( __DIR__ . '/../autoload/autoload.php');
    $sql="SELECT *  FROM company";
    $company = $db->fetchdata($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url()?>plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url()?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()?>dist/css/adminlte.min.css">
    <!-- icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url()?>plugins/summernote/summernote-bs4.min.css">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="<?php echo base_url()?>plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="<?php echo base_url()?>plugins/codemirror/theme/monokai.css">
    <!-- SimpleMDE -->
    <link rel="stylesheet" href="<?php echo base_url()?>plugins/simplemde/simplemde.min.css">
 
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo base_url();?>dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo base_url();?>index.php" class="brand-link">
                <img src="<?php echo base_url();?>pages/company/photo/<?php echo $company[0]['company_logo'] ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MULTIPLE MANAGER</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-header">Nội dung chính</li>
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>
                                    Sản phẩm
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="</*?php echo base_url();?>pages/product/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Danh sách sản phẩm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="</*?php echo base_url();?>pages/product_group/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Nhóm sản phẩm</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Dịch vụ
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>pages/service/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Danh sách dịch vụ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>pages/service_group/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Nhóm dịch vụ</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-kanban"></i>
                                <p>
                                    Dự án
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>pages/project/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Danh sách dự án</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Bài viết
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>pages/post/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Danh sách bài viết</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>pages/post_type/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Nhóm bài viết</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Blog</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-columns-gap"></i>
                                <p>
                                    Vườn đẹp An nhiên
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>pages/garden/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Quản lý Blog </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Thông tin Khách hàng</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-person"></i>
                                <p>
                                    Khách hàng
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>pages/user_tb/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Quản lý khách hàng</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Cài đặt</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Chính sách
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>pages/policies/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Quản lý chính sách</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-gear"></i>
                                <p>
                                    Cài đặt website
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>pages/website_config/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Quản lý website</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-puzzle"></i>
                                <p>
                                    Cài đặt chung
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>pages/company/index.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Quản lý công ty</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Tài khoản</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-person-rolodex"></i>
                                <p>
                                    Tài khoản
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>recover-password.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Đổi mật khẩu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>logout.php" class="nav-link">
                                        <i class="bi bi-play nav-icon"></i>
                                        <p>Đăng xuất</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>