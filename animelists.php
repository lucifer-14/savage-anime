<html>
<?php

include "header.php";
$title='Anime Lists';
// $ticketConfirmResult=mysqli_query($conn,"select id from tripbooking where active=1 and isconfirm=1");
// $ticketCofirmCount=mysqli_num_rows($ticketConfirmResult);

$data=mysqli_query($conn, "select * from animes where active=1 order by name1, season");

?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include "navbar.php" ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <h1 class="m-0 text-dark">Anime Lists</h1>
            </div><!-- /.col -->
           <!--  <div class="col-sm-6">
              <div></div>
            </div>/.col  -->
          </div><!-- /.row -->
          <hr>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Rows (Start card) -->

          <div class="card card-primary card-outline">
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped dt-table" id="tblAnimes">
                          <thead>
                              <tr>
                                  <th class="no-sort"></th>
                                  <th>Anime Name</th>
                                  <th>Episodes</th>
                                  <th>Anime Type</th>
                                  <th>Genre</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php while ($animes = mysqli_fetch_assoc($data)) : ?>
                                  <tr>
                                      <td><a href="watch.php?animeId=<?php echo $animes['id'] ?>"><img src="<?php echo substr($animes['photo'],3); ?>" alt="" class="round listImg" style="height: 100px;"></a></td>
                                      <td><a href="watch.php?animeId=<?php echo $animes['id'] ?>"><?php if($animes['season']!=0){echo $animes["name1"]." (Season-".$animes['season'].")";}else{echo $animes['name1'];} ?></a></td>
                                      <td><?php $tempId=$animes['id'];$query=mysqli_query($conn, "select * from episodes where active=1 and animeId=$tempId");$epCount=mysqli_num_rows($query); echo $epCount; ?></td>
                                      <td><?php echo $animes["animeType"] ?></td>
                                      <td><?php echo $animes["genre"] ?></td>
                                      <td><?php echo $animes["status"] ?></td>
                                  </tr>
                                  </a>
                              <?php endwhile; ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>

          <!-- /.row (end card) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    <?php include "footer.php" ?>
  </div>
</body>
<style type="text/css">
  .card-title{
    font-size: 16px;                        
  }
  .card-text{
    font-size: 15px;
  }
</style>
</html>