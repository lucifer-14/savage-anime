<html>
<?php

include "header.php";$title='Dashboard' ;
$animesResult=mysqli_query($conn,"select id from animes where active=1");
$animesCount=mysqli_num_rows($animesResult);

$usersResult=mysqli_query($conn,"select id from users where active=1");
$usersCount=mysqli_num_rows($usersResult);

// $ticketConfirmResult=mysqli_query($conn,"select id from tripbooking where active=1 and isconfirm=1");
// $ticketCofirmCount=mysqli_num_rows($ticketConfirmResult);
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include "navbar.php" ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">

            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo $animesCount ?></h3>
                  <p>Total Animes</p>
                </div>
                <div class="icon">
                  <i class="fa fa-paw"></i>
                </div>
                <a href="animesmanagement.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> <!-- fix here -->
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $usersCount ?></h3>
                  <p>Total Users</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <a href="usersmanagement.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> <!-- fix link -->
              </div>
            </div>
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    <?php include "footer.php" ?>
  </div>
</body>

</html>