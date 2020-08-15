<html>
<?php
include "header.php";
include "../paginghelper.php";
if ($_SESSION['role'] != 'Admin') {
    header("location:logout.php");
    exit();
}
$title = 'Animes Management';
$data = mysqli_query($conn, "select * from animes where active=1");
//$data = mysqli_query($conn, "select *, animes.id as aId, episodes.id as eId from animes, episodes where animes.id=episodes.animeId=1 and animes.active=1 and episodes.active=1 order by latestDate desc");
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
                            <h3 class="m-0 text-dark">Animes Management</h3>
                            <hr>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
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
                            <a href="animes.php" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle"></i>
                                Add Animes
                            </a>
                            <a href="episodes.php" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle"></i>
                                Add Episodes
                            </a>
                            <p></p>
                            <div class="table-responsive">
                                <table class="table table-striped dt-table" id="tblAnimes">
                                    <thead>
                                        <tr>
                                            <th class="no-sort"></th>
                                            <th>Anime Name 1</th>
                                            <th>Anime Name 2</th>
                                            <th>Anime Name 3</th>
                                            <th>Anime Type</th>
                                            <th>Season</th>
                                            <th>Episodes</th>
                                            <th>Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th>Genre</th>
                                            <th>Released Date</th>
                                            <th>Latest Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($animes = mysqli_fetch_assoc($data)) : ?>
                                            <tr>
                                                <td><img src="<?php echo $animes['photo'] ?>" alt="" class="round listImg" style="height: 100px;"></td>
                                                <td><?php echo $animes['name1'] ?></td>
                                                <td><?php echo $animes['name2'] ?></td>
                                                <td><?php echo $animes['name3'] ?></td>
                                                <td><?php echo $animes['animeType'] ?></td>
                                                <td><?php if($animes['season']!=0){ echo $animes['season'];} ?></td>
                                                <td><?php $tempId=$animes['id'];$query=mysqli_query($conn, "select * from episodes where active=1 and animeId=$tempId");$epCount=mysqli_num_rows($query);echo $epCount;?></td>
                                                <td><?php if($animes['description']!='') echo substr($animes["description"], 0, 100) . " ..." ?></td>
                                                <td><?php echo $animes['genre'] ?></td>
                                                <td><?php echo $animes['releasedDate_Month'].', '.$animes['releasedDate_Year'] ?></td>
                                                <td><?php $tempId=$animes['id'];$query=mysqli_query($conn, "select * from episodes where active=1 and animeId=$tempId order by latestDate desc limit 1");$rows=mysqli_num_rows($query);if($rows!=0){$latestDate=mysqli_fetch_object($query);echo datetostr($latestDate->latestDate);} ?></td>
                                                <td><?php echo $animes['status'] ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <div class="modal fade" id="deletemodel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="deleteTitle">Delete Confirmation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" method="post">
                        <div class="modal-body">
                            <p class="text-danger" id="deleteText">Are you sure you want to delete?</p>
                            <input type="hidden" name="id" id="deletedId">
                        </div>
                        <div class="modal-footer justify-content-between" id="deleteConfirm">
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
    </div>
</body>

</html>