<?php
require_once(__DIR__ . '/autoload/autoload.php');
?>
<?php
$username = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $password_new = postInput('password_new');
  $password_confirm = postInput('password_confirm');
  if ($password_new == $password_confirm) {
    $password_new = md5($password_new);
    $id_update = $db->update("admin", array("password" => $password_new), array("username" => $username));
    if ($id_update > 0) {
      echo '<script>alert("Đổi mật khẩu thành công")</script>';
      header("location:index.php");
    } else {
      header("location:index.php");
      echo '<script>alert("Mật khẩu không thay đổi")</script>';
    }
  } else {
    echo '<script>alert("Mật khẩu nhập lại chưa khớp")</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Recover Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

  <br /><br />
  <div class="container">
    <h3 style="color: #002247; text-align: center">WEBSITE MULTIPLE MANAGEMENT</h3>
    <p style="text-align: center; position: relative">
      <img src="/image/banner.png" alt="welcome image">
    </p>
    <br />
    <h3 style="text-align: center;">Đổi mật khẩu</h3>
    <p style="text-align: center;">Bạn chỉ còn một bước nữa để có được mật khẩu mới, hãy cập nhật mật khẩu của bạn ngay bây giờ.</p>
    <br />
    <form method="post" style="margin: 0% 25%;">
      <label>Nhập mật khẩu mới</label>
      <input type="password" class="form-control" placeholder="Mật khẩu mới" name="password_new">
      <br />
      <label>Nhập lại mật khẩu</label>
      <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="password_confirm">
      <br />
      <input type="submit" name="login" value="Cập nhật" class="btn btn-info" />
      <br />
    </form>
  </div>

  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo base_url() ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>dist/js/adminlte.min.js"></script>
</body>

</html>