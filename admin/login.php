<?php
include "config.php";
include "../logincommon.php";
//check login post request
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  validate($username, $password, 'dashboard.php', true);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in | Savage Anime</title>
  <link rel="shortcut icon" href="images/savage_logo.png" sizes="128x128" />
  <!-- Tell the browser to be responsive to screen device-widthth -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="components/fontawesome-free/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="components/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="components/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>Admin </b>Log in
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">

        <form action="login.php" method="post" class="pt-4">
          <input hidden name="url" value="<?php echo str_replace("url=","",$_SERVER["QUERY_STRING"]) ?>" />
          <p class="text-danger"><?php echo $error ?? ''; ?></p>
          <div class="input-group mb-3">
            <input type="text" name='username' class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name='password' class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div> -->
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="login" class="btn btn-primary btn-block">Log In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-1">
          <a href="forgot-password.html">Forgot Password?</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="components/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="components/boostrap/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="js/adminlte.min.js"></script>

</body>

</html>