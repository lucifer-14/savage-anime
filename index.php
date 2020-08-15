<html>
<?php

include "header.php";
$title='Home' ;
// $ticketConfirmResult=mysqli_query($conn,"select id from tripbooking where active=1 and isconfirm=1");
// $ticketCofirmCount=mysqli_num_rows($ticketConfirmResult);

$dataRR=mysqli_query($conn, "select *, episodes.id as eId, animes.id as aId from animes, episodes where animes.id=episodes.animeId and animes.active=1 and episodes.active=1 order by latestDate desc limit 12");
$dataPAS=mysqli_query($conn, "select *, animes.id as aId, visits.id as vId from animes, visits where animeType='Series' and active=1 and visits.animeId=animes.id order by monthlyVisits desc limit 12");
$dataPAM=mysqli_query($conn, "select *, animes.id as aId, visits.id as vId from animes, visits where animeType='Movie' and active=1 and visits.animeId=animes.id order by monthlyVisits desc limit 12");
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php include "navbar.php" ?>

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-lg-8 col-12">
              <h1 class="m-0 text-dark">Home</h1>
            </div><!-- /.col -->
            <!-- <div class="col-lg-4 col-6">
              <form action="searchresult.php" method="post" id="searchForm" enctype="multipart/form-data">
                <input class="form-control" type="search" placeholder="Search" name="search" >
              </form>
            </div>/.col   -->
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
            <h5 class="card-header">Recently Released</h5>
            <div class="card-body">
              <div class="row">
                <?php while ($animes = mysqli_fetch_assoc($dataRR)) : ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                  <?php $photoUrl=substr($animes['photo'], 3)?>
                  <a href="watch.php?episodeId=<?php echo $animes['eId'] ?>">
                  <div class="card bg-light">
                    <img class="card-img-top" src="<?php echo $photoUrl ?>">
                    <div class="card-body">
                      <div class="card-title" style="height: 70px;"><?php echo $animes['name1']?></div>
                      <div class="card-text"><?php echo 'Anime '.$animes['animeType'] ?> </div>
                      <?php if ($animes['season']!=0) : ?>
                      <div class="card-text"><?php echo 'Season-'.$animes['season']?></div>                      
                      <?php else : ?>
                      <div class="card-text">&nbsp;</div>
                      <?php endif; ?>
                      <div class="card-text"><?php $tempId=$animes['aId'];$query=mysqli_query($conn, "select * from episodes where active=1 and animeId=$tempId");$epCount=mysqli_num_rows($query); echo 'Episode-'.$animes['episode'].'/'.$epCount; ?></div>  
                    </div>
                  </div>
                  </a>
                </div>
                <?php endwhile; ?>
              </div>
            </div>
            <div class="card-footer text-center">
              <a href="animelists.php" class="btn btn-primary">More Animes</a>
            </div>
          </div>


          <div class="card card-primary card-outline">
            <h5 class="card-header">Popular Anime Series</h5>
            <div class="card-body">
              <div class="row">
                <?php while ($animes = mysqli_fetch_assoc($dataPAS)) : ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                  <?php $photoUrl=substr($animes['photo'], 3)?>
                  <a href="watch.php?animeId=<?php echo $animes['aId'] ?>">
                  <div class="card bg-light">
                    <img class="card-img-top" src="<?php echo $photoUrl ?>">
                    <div class="card-body">
                      <div class="card-title" style="height: 70px;"><?php echo $animes['name1']?></div>
                      <div class="card-text"><?php echo 'Season-'.$animes['season']?></div>
                      <div class="card-text"><?php $tempId=$animes['aId'];$query=mysqli_query($conn, "select * from episodes where active=1 and animeId=$tempId");$epCount=mysqli_num_rows($query);echo "Episodes: ".$epCount;?></div>
                    </div>
                  </div>
                  </a>
                </div>
                <?php endwhile; ?>
              </div>
            </div>
            <div class="card-footer text-center">
              <a href="animeseries.php" class="btn btn-primary">More Anime Series</a>
            </div>
          </div>


          <div class="card card-primary card-outline">
            <h5 class="card-header">Popular Anime Movies</h5>
            <div class="card-body">
              <div class="row">
                <?php while ($animes = mysqli_fetch_assoc($dataPAM)) : ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                  <?php $photoUrl=substr($animes['photo'], 3)?>
                  <a href="watch.php?animeId=<?php echo $animes['aId'] ?>">
                  <div class="card bg-light">
                    <img class="card-img-top" src="<?php echo $photoUrl ?>">
                    <div class="card-body">
                      <div class="card-title" style="height: 70px;"><?php echo $animes['name1']?></div>
                      <div class="card-text"><?php echo ($animes['season']!=0) ? 'Season-'.$animes['season'] : ''?></div>
                      <div class="card-text"><?php $tempId=$animes['aId'];$query=mysqli_query($conn, "select * from episodes where active=1 and animeId=$tempId");$epCount=mysqli_num_rows($query);echo "Episodes: ".$epCount;?></div>
                    </div>
                  </div>
                  </a>
                </div>
                <?php endwhile; ?>
              </div>
            </div>
            <div class="card-footer text-center">
              <a href="animemovies.php" class="btn btn-primary">More Anime Movies</a>
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