<?php
$connect = mysqli_connect("127.0.0.1", "root", "", "website_multiple_management");
session_start();
if (isset($_SESSION["username"])) {
  header("location:index.php");
}
if (isset($_POST["login"])) {
  if (empty($_POST["username"]) && empty($_POST["password"])) {
    echo '<script>alert("Tài khoản và mật khẩu là bắt buộc")</script>';
  } else {
    $username = mysqli_real_escape_string($connect, $_POST["username"]);
    $password = mysqli_real_escape_string($connect, $_POST["password"]);
    $password = md5($password);
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
      $_SESSION['username'] = $username;
      header("location:index.php");
    } else {
      echo '<script>alert("Tài khoản hoặc mật khẩu chưa đúng")</script>';
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Webslesson Tutorial | PHP Login Registration Form with md5() password Encryption</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
  <br /><br />
  <div class="container">
    <h3 style="color: #002247; text-align: center">WEBSITE MULTIPLE MANAGEMENT</h3>
    <p style="text-align: center; position: relative">
      <img src="/image/banner.png" alt="welcome image">
    </p>
    <br />
    <h3 style="text-align: center;">Đăng nhập</h3>
    <br />
    <form method="post" style="margin: 0% 25%;">
      <label>Nhập tài khoản</label>
      <input type="text" name="username" class="form-control" />
      <br />
      <label>Nhập mật khẩu</label>
      <input type="password" name="password" class="form-control" />
      <br />
      <input type="submit" name="login" value="Login" class="btn btn-info" />
      <br />
    </form>
  </div>
</body>

</html>