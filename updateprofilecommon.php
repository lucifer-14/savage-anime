<?php
$error = '';
$passwordError = '';
$editState = false;
$passwordChanged = false;
$result = mysqli_query($conn, "select * from users where id='$currentUser'");
$user = mysqli_fetch_object($result);
$username = $user->username;
$gender = $user->gender;
$email = $user->email;
$phone = $user->phone;
$photo = $user->photo;
$SessionRole = $_SESSION['role'];


if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $redirectUrl = $_POST['redirect_url'];

    if (!$_FILES['photo']['name'] == "") {
        $photo = $_POST['photo'];
    }
    if (!$_POST['photo_cropped']== "") {
        $photo = $_POST['photo_cropped'];
    }

    $editState = true;
    if (isValidFields()) {
        $query = "
        update users
        set 
        username='$username',
        email='$email',
        phone='$phone',
        gender='$gender',
        photo='$photo'
        where id='$currentUser';
        ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['photo'] = $photo;
            header("location:$redirectUrl?message=Update successful.");
        } else {
            $error = mysqli_error($conn);
        }
    }
}
if (isset($_POST['changepassword'])) {
    $passwordChanged = true;
    $isvalid = true;
    $currentPassword = $_POST['current_password'];
    $newpassword = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $redirectUrl = $_POST['redirect_url'];

    $currentPasswordHash = md5($currentPassword);
    $result = mysqli_query($conn, "select * from users where password='$currentPasswordHash' and id='$currentUser'");
    if (mysqli_num_rows($result) == 0) {
        $passwordError = "Inncorrect current password.";
        $isvalid = false;
    }
    if ($isvalid && $newpassword == '') {
        $passwordError = "Password cannot be empty.";
        $isvalid = false;
    }
    if ($isvalid && $newpassword != $confirm_password) {
        $passwordError = "Password and confirm password did not match.";
        $isvalid = false;
    }
    if ($isvalid) {
        $newpasswordHash = md5($newpassword);
        $query = "
            update users
            set 
            password='$newpasswordHash'
            where id='$currentUser';
            ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header("location:$redirectUrl?message=Password changed successful.");
        } else {
            $passwordError = mysqli_error($conn);
        }
    }
}
function isValidFields()
{

    global $conn, $currentUser, $error, $username, $email, $gender;
    $result = mysqli_query($conn, "select * from users where username='$username' and id<>'$currentUser'");
    if (mysqli_num_rows($result) > 0) {
        $error = "Username is alerady exist.";
        return false;
    }

    $result = mysqli_query($conn, "select * from users where and email='$email' and id<>'$currentUser'");
    if (mysqli_num_rows($result) > 0) {
        $error = "Email is alerady taken.";
        return false;
    }
    $gender=ucfirst($gender);
    if(!($gender=="Male"||$gender=="Female"||$gender=="Other")){
        $error = "Invalid gender.";
        return false;
    }
    return true;
}
