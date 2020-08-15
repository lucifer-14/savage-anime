<html>
<?php 
include "header.php";
include "../paginghelper.php";
$title = 'Episodes';
$data = mysqli_query($conn, "select *, episodes.id as eId, animes.id as aId from animes, episodes where animes.id=episodes.animeId and animes.active=1 and episodes.active=1 order by latestDate desc");
$editState=false;
$animesName1;

if (isset($_GET["editId"])) {
    $id = $_GET["editId"];
    $editState = true;
    $editQuery = "select * from episodes where id='$id' order by latestDate desc";
    $result = mysqli_query($conn, $editQuery);
    $eps = mysqli_fetch_assoc($result);
    $sAnimeId = $eps['animeId'];
    $episode = $eps['episode'];
    $url = $eps['url'];
    
}
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
                            <h3 class="m-0 text-dark">Episodes Setup</h3>
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
                        <div class="col-md-4">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <form action="<?php echo $editState ? 'episodes_update.php' : 'episodes_add.php'; ?>" method="post" id="episodesForm" enctype="multipart/form-data">
                                  		<input id="episodesId" name="episodesId" value="<?php echo $editState ? $id: ''?>" hidden>
                                        <div class="form-group">
                                            <label>Anime</label>
                                            <select class="form-control select2" name="anime" id="anime">
                                                <option>-Select Anime-</option>
                                                <?php
                                                $animesQuery = "select * from animes where active=1 order by name1";
                                                $animes = mysqli_query($conn, $animesQuery);
                                                while ($anime = mysqli_fetch_assoc($animes)) {
                                                    // $optionData = ($anime['name2'] ? $anime['name1'].' ('.$anime['name2'].')' : $anime['name1']);
                                                    $type=$anime['animeType'];
                                                    if($anime['animeType']=="Series")
                                                        $type="Season";
                                                    if($anime['season']!='0')
                                                        $optionData = $anime['name1'].' ('.$type.'-'.$anime['season'].')';
                                                    else
                                                        $optionData = $anime['name1'].' ('.$type.')';
                                                    $animeId = $anime['id'];
                                                    $selected = getSelectedText($sAnimeId, $animeId);
                                                    $opt = "<option value='$animeId' $selected> $optionData </option>";
                                                    echo $opt;
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Episode No</label>
                                            <input type="text" class="form-control" placeholder="Episode No" name="episode" id="txtEpisode" value="<?php echo $episode ?? '' ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Episode URL</label>
                                            <input type="text" class="form-control" placeholder="Episode URL" name="url" id="txtUrl" value="<?php echo $url ?? ''?>" />
                                        </div>
                                        <input type="submit" class="btn btn-sm btn-primary" id="btnSave" value="<?php echo $editState ? 'Update' : 'Save'; ?>" />
                                        <a href="episodes.php" class="btn btn-sm btn-danger">Cancel</a>
                                    </form>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <div class="col-md-8">
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
                                    <div class="table-responsive">
                                        <table class="table table-striped dt-table" id="tblEpisodes">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort"></th>
       	                                            <th>Anime</th>
                                                    <th>Anime Type</th>
                                                    <th>Season</th>
                                                    <th>Episode No</th>
                                                    <th>Episode URL</th>
                                                    <th>Latest Date</th>
                                                    <th class="no-sort"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($episodes = mysqli_fetch_assoc($data)) : ?>
                                                    <tr>
                                                        <td><img src='<?php echo $episodes["photo"] ?>' alt="" class="round listImg" id="img" style="height: 100px;"></td>
                                                        <td><?php if($episodes['name2']!=""){echo $episodes["name1"].' ('.$episodes["name2"].')';}else{echo $episodes["name1"];} ?></td>
                                                        <td><?php echo $episodes["animeType"] ?></td>
                                                        <td><?php if($episodes['season']!=0){ echo $episodes["season"];} ?></td>
                                                        <td><?php echo $episodes["episode"] ?></td>
                                                        <td><?php echo $episodes["url"] ?></td>
                                                        <td><?php echo datetostr($episodes["latestDate"])?></td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                <a href="episodes.php?editId=<?php echo $episodes['eId'] ?>" class="btn btn-sm btn-primary" title="Edit" id="btnEdit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button type="button" id="btnDelete" data-id="<?php echo $episodes["eId"] ?>" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletemodel">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                        <!-- <ul class="pagination">
                                        <?//getPager("select * from operator where active=1")?>
                                        </ul> -->
                                    </div>
                                </div>
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
                        <h4 class="modal-title">Delete Confirmation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="episodes_delete.php" method="post">
                        <div class="modal-body">
                            <p class="text-danger">Are you sure you want to delete?</p>
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
        <script src="js/episodes.js"></script>
        <script type="text/javascript">
            // $(document).on('change', '#anime', function() {
            //     document.cookie="animeNameValue =" + $('#anime option:selected').text();
            // });
            // function getAnimeName1(){
            //     document.cookie="animeNameValue =" + $('#anime option:selected').text();
            // }
        </script>
    </div>
</body>

</html>