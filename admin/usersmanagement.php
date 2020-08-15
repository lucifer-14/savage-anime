<html>
<?php
include "header.php";
include "../paginghelper.php";
if ($_SESSION['role'] != 'Admin') {
    header("location:logout.php");
    exit();
}
$title = 'Users Management';
$data = mysqli_query($conn, "select * from users where active=1 order by registeredDate desc");
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
                            <h3 class="m-0 text-dark">Users Management</h3>
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
                            <a href="users_edit.php" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle"></i>
                                Add User
                            </a>
                            <p></p>
                            <div class="table-responsive">
                                <table class="table table-striped dt-table" id="tblUsers">
                                    <thead>
                                        <tr>
                                            <th class="no-sort"></th>
                                            <th>Username</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Registered Date</th>
                                            <th>Role</th>
                                            <th class="no-sort">Is Deactived</th>
                                            <th class="no-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($user = mysqli_fetch_assoc($data)) : ?>
                                            <tr>
                                                <td><img src="<?php echo $user['role']!="Admin" ? '../'.$user['photo']: $user['photo'] ?>" alt="" class="round listImg"></td>
                                                <td><?php echo $user['username'] ?></td>
                                                <td><?php echo $user['gender'] ?></td>
                                                <td><?php echo $user['email'] ?></td>
                                                <td><?php echo $user['phone'] ?></td>
                                                <td><?php echo datetostr($user['registeredDate']) ?></td>
                                                <td><?php echo $user['role'] ?></td>
                                                <td><input type="checkbox" disabled <?php if ($user['isDeactivated']) echo 'checked' ?> /></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="users_edit.php?editId=<?php echo $user['id'] ?>" class="btn btn-sm btn-primary" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-danger" id="btnDelete" title="Delete" data-id="<?php echo $user['id'] ?>" data-toggle="modal" data-target="#deletemodel">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
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
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <div class="modal fade" id="deletemodel">
            <div class="modal-dialog" id="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="deleteTitle">Delete Confirmation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="users_delete.php" method="post">
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
<script>
    $(function() {
        $("#tblUsers").on("click", "#btnDelete", function() {
            var tableData = $(this).closest('tr')
            .find('td')
            .map(function () {
                return $(this).text();
            });
            if(tableData[6]=="Admin"){
                $("#deleteTitle").text("Delete Information");
                $("#deleteText").text("Unable to Delete Admin Account.");
                $("#deleteConfirm").css("display", "none");
                $("#modal").addClass("modal-dialog-centered");
            }else{
                $("#deletedId").val($(this).data('id'))
                $("#deleteTitle").text("Delete Confirmation");
                $("#deleteText").text("Are you sure you want to Delete?");
                $("#deleteConfirm").css("display", "");
                $("#modal").removeClass("modal-dialog-centered");
            }
        })
    })
</script>

</html>