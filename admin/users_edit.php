<html>
<?php
include "header.php";
include "../registercommon.php";
if ($_SESSION['role'] != 'Admin') {
    header("location:logout.php");
    exit();
}
$title = 'User Entry';
$isDeactivated=0;
//check edit user
//fetch all respective user data to bind to controls
if (isset($_GET["editId"])) {
    $id = $_GET["editId"];
    $editState = true;
    $editQuery = "select * from users where id='$id'";
    $result = mysqli_query($conn, $editQuery);
    $user = mysqli_fetch_assoc($result);
    $username = $user['username'];
    $gender = $user['gender'];
    $email = $user['email'];
    $phone = $user['phone'];
    $role = $user['role'];
    $isDeactivated = $user['isDeactivated'];
}

//check insert state
if (isset($_POST["save"])) {

    $role = $_POST['role'];
    $result = register($role);
    if ($result) {
        header("location:usersmanagement.php?message=Saving successful.");
    }
}

if (isset($_POST["update"])) {

    //keep edit state for validation
    $editState = true;

    //get post data
    getPostRequest();

    //check validation
    if (isValidFields()) {
        //hash password with md5
        $passwordhash = md5($password);

        //checking password reseting process. 
        //if user did not reset password it will be skip
        $updatePassword = $password != '' ? ",password = '$passwordhash' " : " ";
        $Deactivated = $_POST['isDeactivated'] == "yes" ? 1 : 0;
        $id = $_POST["id"];
        $query = "update users
        set
        username = '$username',
        email = '$email',
        phone = '$phone',
        gender = '$gender',
        role = '$role',
        isDeactivated = '$Deactivated'"
            . $updatePassword
            . "where id='$id'";

        //update user data
        if (post_db($query)) {
            header("location:usersmanagement.php?message=Update successful.");
        }
    }
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
                            <h3 class="m-0 text-dark">User Entry</h3>
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
                        <div class="col-md-8">
                            <?php
                            if ($error) : ?>
                                <div class='alert alert-danger'>
                                    <?php print_r($error) ?>
                                </div>
                            <?php endif; ?>
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <form action="users_edit.php" method="post">
                                        <input name="id" hidden value="<?php echo $id ?? '' ?>" />
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $username ?? '' ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" id="" class="form-control select2">
                                                <option value="-Select Gender-">-Select Gender-</option>
                                                <option value="Male" <?php echo getSelectedText($gender, "Male") ?>>Male</option>
                                                <option value="Female" <?php echo getSelectedText($gender, "Female") ?>>Female</option>
                                                <option value="Other" <?php echo getSelectedText($gender, "Other") ?>>Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $email ?? '' ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="tel" class="form-control" placeholder="Phone Number" name="phone" value="<?php echo $phone ?? '' ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select name="role" id="" class="form-control select2">
                                                <option value="-Select Role-">-Select Role-</option>
                                                <option value="User" <?php echo getSelectedText($role, "User") ?>>User</option>
                                                <option value="Admin" <?php echo getSelectedText($role, "Admin") ?>>Admin</option>
                                            </select>
                                        </div>
                                        <?php if ($role!="Admin") :?>
                                            <div class="form-group">
                                                <label for="isDeactivated">Deactivated</label>
                                                <div class="icheck-primary d-inline">
                                                    <?php $checker= $isDeactivated==1 ? 'checked' : ''; ?>
                                                    <input type="checkbox" id="isDeactivated" name="isDeactivated" value="yes" <?php echo $checker ?>>
                                                    <label for="isDeactivated">
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($editState) : ?>
                                            <div class="card-body p-0">
                                                <p>
                                                    <a class="btn btn-sm btn-primary" data-toggle="collapse" href="#changePasswordForm" role="button" aria-expanded="false" aria-controls="changePasswordForm">
                                                        Reset Password
                                                    </a>
                                                </p>
                                                <div class="collapse" id="changePasswordForm">
                                                    <div class="card card-body">
                                                        <div>
                                                            <div class="form-group p-0">
                                                                <label>New Password</label>
                                                                <input type="password" class="form-control" placeholder="New Password" name="password" />
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Confirm Password</label>
                                                                <input type="password" class="form-control" placeholder="Confirm Password" name="confirmpassword" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" placeholder="Password" name="password" />
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" placeholder="Confrim Password" name="confirmpassword" />
                                            </div>
                                        <?php endif; ?>

                                        <input type="submit" name="<?php echo $editState ? 'update' : 'save'; ?>" class="btn btn-sm btn-primary" value="<?php echo $editState ? 'Update' : 'Save'; ?>" />
                                        <a href="usersmanagement.php" class="btn btn-sm btn-danger">Cancel</a>

                                    </form>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                    </div>
                </div>
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <?php include "footer.php" ?>
    </div>
</body>

</html>