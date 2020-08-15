<html>
<?php
include "header.php";
include "../paginghelper.php";
$title = 'Animes';
$editState = false;
$data = mysqli_query($conn, "select * from animes where active=1 order by id");
if (isset($_GET["editId"])) {
    $id = $_GET["editId"];
    $editState = true;
    $editQuery = "select * from animes where id='$id'";
    $result = mysqli_query($conn, $editQuery);
    $ani = mysqli_fetch_assoc($result);
    $name1 = $ani['name1'];
    $name2 = $ani['name2'];
    $name3 = $ani['name3'];
    $season = $ani['season'];
    $animeType = $ani['animeType'];
    $description = $ani['description'];
    $genre = $ani['genre'];
    $releasedDate_Month = $ani['releasedDate_Month'];
    $releasedDate_Year = $ani['releasedDate_Year'];
    $status = $ani['status'];
    $photo = $ani['photo'];
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
                            <h3 class="m-0 text-dark">Animes Setup</h3>
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
                                    <form action="<?php echo $editState ? 'animes_update.php' :'animes_add.php' ?>" method="post" id="animesForm" enctype="multipart/form-data">
                                        <input hidden id="animesId" name="animesId" value="<?php echo $id ?? '' ?>" />
                                        <div class="form-group">
                                            <label>Anime Name 1</label>
                                            <input type="text" class="form-control" placeholder="Most Wellknown Name" name="name1" id="txtName1" value="<?php echo $name1 ?? '' ?>" required autocomplete="off"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Anime Name 2</label>
                                            <input type="text" class="form-control" placeholder="Wellknown Name" name="name2" id="txtName2" value="<?php echo $name2 ?? '' ?>" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Anime Name 3</label>
                                            <input type="text" class="form-control" placeholder="Other Name" name="name3" id="txtName3" value="<?php echo $name3 ?? '' ?>" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Anime Type</label>
                                            <select class="form-control select2" name="animeType" id="txtAnimeType">
                                                <option>-Select Anime Type-</option>
                                                <?php
                                                    $animeTypeA = array("Series", "Movie", "OVA");
                                                    for ($i=0;$i<3;$i++) {
                                                        $selected = getSelectedText($animeType, $animeTypeA[$i]);
                                                        $opt = "<option value='$animeTypeA[$i]' $selected>$animeTypeA[$i]</option>";
                                                        echo $opt;
                                                    }
                                                
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Season</label>
                                            <input type="text" class="form-control" placeholder="Season No" name="season" id="txtSeason" value="<?php echo $season ?? '' ?>" autocomplete="off" />
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" placeholder="Description" name="description" id="txtDescription" rows="4"><?php echo $description ?? '' ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Genre</label>
                                            <input type="text" class="form-control" placeholder="Genre" name="genre" id="txtGenre" value="<?php echo $genre ?? '' ?>" autocomplete="off" required />
                                        </div>
                                        <div class="form-group">
                                            <label>Released Date</label>
                                            <div class="row" id="released-date">
                                                <div class="col-md-6">
                                                    <select class="form-control select2" name="released-date-month" id="released-date-month">
                                                    <option>-Select Month-</option>
                                                        <?php
                                                            $month = array("January", "February", "March", "April", "May", "June", "July", "August", "Sceptember", "October", "November", "December");
                                                            for ($i=0;$i<12;$i++) {
                                                                $selected = getSelectedText($releasedDate_Month, $month[$i]);
                                                                $opt = "<option value='$month[$i]' $selected>$month[$i]</option>";
                                                                echo $opt;
                                                            }
                                                        
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-control select2" name="released-date-year" id="released-date-year">
                                                    <option>-Select Year-</option>
                                                        <?php
                                                            $year = 1990;
                                                            for ($i=(int)date("Y");$i>=$year;$i--) {
                                                                $selected = getSelectedText($releasedDate_Year, $i);
                                                                $opt = "<option value='$i' $selected>$i</option>";
                                                                echo $opt;
                                                            }
                                                        
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control select2" name="status" id="status">
                                                <option>-Select Status-</option>
                                                <?php
                                                    $statusA = array("On Going", "Completed");
                                                    for ($i=0;$i<2;$i++) {
                                                        $selected = getSelectedText($status, $statusA[$i]);
                                                        $opt = "<option value='$statusA[$i]' $selected>$statusA[$i]</option>";
                                                        echo $opt;
                                                    }
                                                
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Photo</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="animePhoto" name="photo">
                                                <input type="hidden" id="animePhoto_cropped" name="animePhoto_cropped" value="<?php echo $photo ?? '' ?>">
                                                <label class="custom-file-label" for="animePhoto">Choose file</label>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-sm btn-primary" id="btnSave" value="<?php echo $editState ? 'Update' : 'Save' ?>" />
                                        <a href="animes.php" class="btn btn-sm btn-danger">Cancel</a>
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
                                        <table class="table table-striped dt-table" id="tblAnimes">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort"></th>
                                                    <th>Anime Name 1</th>
                                                    <th>Anime Name 2</th>
                                                    <th>Anime Name 3</th>
                                                    <th>Anime Type</th>
                                                    <th>Season</th>
                                                    <th>Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <th>Genre</th>
                                                    <th>Released Date</th>
                                                    <th>Status</th>
                                                    <th class="no-sort" style="display: none"></th>
                                                    <th class="no-sort"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($animes = mysqli_fetch_assoc($data)) : ?>
                                                    <tr>
                                                        <td><img src='<?php echo $animes["photo"] ?>' alt="" class="round listImg" style="height: 100px;"></td>
                                                        <td><?php echo $animes["name1"] ?></td>
                                                        <td><?php echo $animes["name2"] ?></td>
                                                        <td><?php echo $animes["name3"] ?></td>
                                                        <td><?php echo $animes['animeType'] ?></td>
                                                        <td><?php if($animes["season"]!='0'){ echo $animes["season"];} ?></td>
                                                        <td><?php if($animes["description"]!="") echo substr($animes["description"], 0, 40) . " ..." ?></td>
                                                        <td><?php echo $animes["genre"] ?></td>
                                                        <td><?php
                                                            if($animes["releasedDate_Year"]!=""&&$animes["releasedDate_Month"]!="")
                                                                echo $animes["releasedDate_Month"] . ", " . $animes["releasedDate_Year"];
                                                             ?></td>
                                                        <td><?php echo $animes["status"] ?></td>
                                                        <td style="display: none;"><?php echo $animes["description"] ?></td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                <a href="animes.php?editId=<?php echo $animes['id'] ?>" class="btn btn-sm btn-primary" title="Edit" id="btnEdit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button type="button" id="btnDelete" data-id="<?php echo $animes["id"] ?>" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletemodel">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        </div><!-- /.container-fluid -->
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
                    <form action="animes_delete.php" method="post">
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
        <div id="uploadimageModal" class="modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crop Image</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div id="image_demo" style=""></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center" style="padding-top:30px;">
                                <button class="btn btn-success crop_image">Crop Image</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php" ?>
        <script src="js/animes.js"></script>
    </div>
</body>
<script>
    $(document).ready(function(){
        
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
              width:310,
              height:430,
              type:'square' //circle
            },
            boundary:{
              width:430,
              height:440
            }
        });
        $('#animePhoto').on('change', function(){
            var reader = new FileReader();
            reader.onload = function (event) {
              $image_crop.croppie('bind', {
                url: event.target.result
              })
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });
        $('.crop_image').click(function(event){
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response){
                $.ajax({
                    url:"adminupload.php",
                    type: "POST",
                    data:{"image": response},
                    success:function(data) {
                       $('#uploadimageModal').modal('hide');
                        $('#animePhoto_cropped').val(data);
                 }
                });
            })
            $('#uploadimageModal').modal('hide');
        });
    })
</script>

</html>