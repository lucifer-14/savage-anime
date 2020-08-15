<html>
<?php

include "header.php";
$title='To-Watch List' ;

if (!isset($_SESSION['userId']) && $_SESSION['role'] != 'User') {
  $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  header("location:login.php?url=$url");
  exit();
}
$imagePath = 'user_img/';
$data = mysqli_query($conn, "select *,animes.id as aId, towatchlist.id as tId from towatchlist, animes where animes.id=towatchlist.animeId and towatchlist.userId=$currentUser order by processedDate desc");
$dataCount = mysqli_num_rows($data);
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
              <h1 class="m-0 text-dark"><i class="fa fa-eye"></i>&nbsp;To-Watch List</h1>
              <hr>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="card card-primary card-outline">
            <div class="card-body">
              <?php if(isset($_GET['message'])):?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $_GET['message']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php endif;?>
              <p></p>
              <?php if($dataCount!=0) : ?>
              <div class="table-responsive">
                <table class="table table-striped dt-table" id="tblToWatchList">
                  <thead>
                    <tr>
                      <th class="no-sort"></th>
                      <th>Anime Name</th>
                      <th>Episodes</th>
                      <th>Anime Type</th>
                      <th>Genre</th>
                      <th>Status</th>
                      <th>Released Date</th>
                      <th class="no-sort"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($towatchlist = mysqli_fetch_assoc($data)) : ?>
                    <tr>
                      <td><a href="watch.php?animeId=<?php echo $towatchlist['aId'] ?>"><img src="<?php echo substr($towatchlist['photo'], 3) ?>" alt="" class="round listImg" style="height: 100px"></a></td>
                      <td><a href="watch.php?animeId=<?php echo $towatchlist['aId'] ?>"><?php if($towatchlist['season']!=0){echo $towatchlist["name1"]." (Season-".$towatchlist['season'].")";}else{echo $towatchlist['name1'];} ?></a></td>
                      <td><?php $tempId=$towatchlist['aId'];$query=mysqli_query($conn, "select * from episodes where active=1 and animeId=$tempId");$epCount=mysqli_num_rows($query);echo $epCount; ?></td>
                      <td><?php echo $towatchlist['animeType'] ?></td>
                      <td><?php echo $towatchlist['genre'] ?></td>
                      <td><?php echo $towatchlist['status'] ?></td>
                      <td><?php echo $towatchlist['releasedDate_Month'].', '.$towatchlist['releasedDate_Year'] ?></td>
                      <td>
                        <button type="button" id="btnDelete" data-id="<?php echo $towatchlist["tId"] ?>" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletemodel"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
              <?php endif;?>
              <p></p>
              <?php if($dataCount==0) : ?>
              <div class="alert alert-dismissible fade show" role="alert" style="background-color: rgb(0,0,0,.05);">
                <div style="text-align: center;"><i class="fa fa-times-circle text-danger"></i> No animes are added to To-Watch list.</div>
              </div>
              <?php endif;?>
            </div>
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <div class="modal fade" id="deletemodel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Remove Confirmation</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="profile_delete.php?deleteIdentifier=3" method="post">
            <div class="modal-body">
              <p class="text-danger">Remove from ?</p>
              <input type="hidden" name="id" id="deletedId">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
          </form>
        </div>
                <!-- /.modal-content -->
      </div>
            <!-- /.modal-dialog -->
    </div>

    <?php include "footer.php" ?>
    <script type="text/javascript">
      $("#tblToWatchList").on("click", "#btnDelete", function () {
        $("#deletedId").val($(this).data('id'));
        var tableData = $(this).closest('tr')
          .find('td')
          .map(function () {
            return $(this).text();
          });
        $("#deletemodel .modal-body p").text("Remove "+ tableData[1]+" from To-Watch list?");

      });
    </script>
  </div>
</body>

</html>