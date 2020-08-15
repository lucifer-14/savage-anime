<html>
<?php
include "header.php";
$title = 'Watch';
$id;
$data;
$dataA;
$episode;
$error="";
$userId;
$totalEpisodes;
$url;
$animeEp;
if(isset($_GET['animeId'])) {
    $id = $_GET['animeId'];
    $queryResult = mysqli_query($conn, "select *, animes.id as aId, episodes.id as eId from animes, episodes where animes.id=episodes.animeId and animes.active=1 and episodes.active=1 and animes.id='$id' order by episode");
    if(mysqli_num_rows($queryResult)!=0)
    {
        $data = mysqli_query($conn, "select *, animes.id as aId, episodes.id as eId from animes, episodes where animes.id=episodes.animeId and animes.active=1 and episodes.active=1 and animes.id='$id' order by episode");
        $totalEpisodes = mysqli_num_rows($data);
    }else{
         $data = mysqli_query($conn, "select * from animes where active=1 and id='$id'");
         $totalEpisodes = 0;
    }


    $visitCountQuery = mysqli_query($conn, "select * from visits where animeId='$id'");
    $visitCountQueryDraw = mysqli_fetch_object($visitCountQuery);
    $visitCount = $visitCountQueryDraw->monthlyVisits;
    $visitCount += 1;
    mysqli_query($conn, "update visits set monthlyVisits='$visitCount' where animeId='$id'");

    $dataA = mysqli_query($conn, "select *, animes.id as aId, episodes.id as eId from animes, episodes where animes.id=episodes.animeId and animes.active=1 and episodes.active=1 and animes.id='$id' order by episode");
}
if(isset($_GET['episodeId'])) {
    $id = $_GET['episodeId'];
    $data = mysqli_query($conn, "select *, animes.id as aId, episodes.id as eId from animes, episodes where animes.id=episodes.animeId and animes.active=1 and episodes.active=1 and episodes.id='$id'");

    $visitCountQuery = mysqli_query($conn, "select *, visits.animeId as aId from visits, episodes where episodes.animeId=visits.animeId and episodes.id='$id'");
    $visitCountQueryDraw = mysqli_fetch_object($visitCountQuery);
    $visitAnimeId = $visitCountQueryDraw->aId;
    $visitCount = $visitCountQueryDraw->monthlyVisits;
    $visitCount += 1;
    mysqli_query($conn, "update visits set monthlyVisits='$visitCount' where animeId='$visitAnimeId'");

    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
        mysqli_query($conn,"insert into watchhistory (episodeId, userId, processedDate) values ('$id','$userId',now())");
    }
    $animeEp = mysqli_query($conn, "select *, animes.id as aId, episodes.id as eId from animes, episodes where animes.id=episodes.animeId and animes.active=1 and episodes.active=1 and animes.id='$visitAnimeId' order by episode");
    $totalEpisodes = mysqli_num_rows($animeEp);
}
$animes = mysqli_fetch_object($data);
$title .= " ".$animes->name1;
if(isset($_GET['episodeId'])){
    $episode = $animes->episode;
    $title .= " | Episode ".$episode;
    $url = $animes->url;
}
$animePhoto = $animes->photo;
$animeMainName = $animes->name1;
$animeAltName = ($animes->name2)? ($animes->name3)? $animes->name2.', '.$animes->name3 : $animes->name2 : '';
$season = $animes->season;
$genre = $animes->genre;
$status = $animes->status;
$releasedDate = $animes->releasedDate_Month.', '.$animes->releasedDate_Year;
$description = $animes->description;


?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include "navbar.php" ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h3 class="m-0 text-dark"><i class="fa fa-paw"></i>&nbsp;<?php echo $animeMainName ?></h3>
                            <hr>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <?php if(isset($_GET['message'])):?>
                        <div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                            <?php echo $_GET['message']?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif;?>
                    </div>
                    
                    <div class="card card-primary card-outline">
                        <div class="card-header">Anime Information</div>
                        <div class="card-body box-profile">
                            <?php if ($error != '') : ?>
                                <div class='alert alert-danger'>
                                    <?php print_r($error) ?>
                                 </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <img class="img-fluid img-thumbnail" src="<?php echo substr($animePhoto, 3); ?>" alt="Anime Cover Photo">
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <div class="row">
                                            <b class="col-md-5 col-4">Anime Name </b>
                                            <a class="col-md-7 col-8">
                                                <p class="dataField float-right"><?php echo $animeMainName ?></p>
                                            </a>
                                            </div>
                                        </li>
                                        <?php if($animeAltName!=""): ?>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <b class="col-md-5 col-4">Other Names </b>
                                                <a class="col-md-7 col-8">
                                                    <p class="dataField float-right"><?php echo $animeAltName ?></p>
                                                </a>
                                            </div>
                                        </li>
                                        <?php endif; ?>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <b class="col-md-5 col-4">Season</b>
                                                <a class="col-md-7 col-8">
                                                    <p class="dataField float-right"><?php echo $season ?></p>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <b class="col-md-5 col-4">Episodes</b>
                                                <a class="col-md-7 col-8">
                                                    <p class="dataField float-right"><?php echo $totalEpisodes ?></p>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <b class="col-md-5 col-4">Genre</b>
                                                <a class="col-md-7 col-8">
                                                    <p class="dataField float-right"><?php echo $genre?></p>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <b class="col-md-5 col-4">Released Date</b>
                                                <a class="col-md-7 col-8">
                                                    <p class="dataField float-right"><?php echo $releasedDate ?></p>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <b class="col-md-5 col-4">Status</b>
                                                <a class="col-md-7 col-8">
                                                    <p class="dataField float-right"><?php echo $status ?></p>
                                                </a>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <b class="col-md-5 col-4">Description</b>
                                                <a class="col-md-7 col-8">
                                                    <p class="dataField float-right"><?php echo $description ?></p>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <?php if(isset($_GET['episodeId'])) : ?>
                            <div class="row">
                                <div class="card-title" style="font-size: 1.2rem;">&nbsp;&nbsp;&nbsp;<b>Episode - <?php echo $episode ?></b></div>
                            </div>
                            <p></p>
                            <div class="row">
                                <video class="col-12" controls> 
                                    <source src="<?php echo $url ?>" type="video/mp4">
                                </video>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div> <!-- /.card -->

                    <div class="card card-primary card-outline">
                        <div class="card-header">Episodes Information</div>
                        <div class="card-body box-profile">
                            
                            <div class="row">
                                <?php if(isset($_GET['episodeId'])) : ?>
                                    <?php while ($episodes=mysqli_fetch_assoc($animeEp)) : ?>
                                        <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                                            <?php $selectEpisode = ($episodes['episode']==$episode) ? 'btn-primary' : 'btn-info'?>
                                            <a class="btn <?php echo $selectEpisode ?>" href="watch.php?episodeId=<?php echo $episodes['eId']?>" style="margin-top: 15px; min-width: 100px;">
                                            
                                                Ep - <?php echo strlen($episodes['episode'])>99? $episodes['episode'] : strlen($episodes['episode'])>9? "0".$episodes['episode'] : "00".$episodes['episode'] ?>
                                            </a>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <?php if(isset($_GET['animeId'])) : ?>
                                    <?php while ($episodesA=mysqli_fetch_assoc($dataA)) : ?>
                                        <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                                            <a class="btn btn-info" href="watch.php?episodeId=<?php echo $episodesA['eId']?>" style="margin-top: 15px; min-width: 100px;">
                                            
                                                Ep - <?php echo strlen($episodesA['episode'])>99? $episodesA['episode'] : strlen($episodesA['episode'])>9? "0".$episodesA['episode'] : "00".$episodesA['episode'] ?>
                                            </a>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div> <!-- /.card -->



                </div>
            </section>
        </div><!-- /.container-fluid -->
        
        <!-- /.content -->

        <?php include "footer.php" ?>
        <style type="text/css">
            .dataField{
                text-align: justify;
            }
            #btnEpisode:hover{
                background-color: #17a2b8;
                color: #fff;
            }
        </style>
    </div>
</body>

</html>
