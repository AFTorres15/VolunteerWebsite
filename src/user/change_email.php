<?php
//Syntax for mysqli_connect("host name", "username", "password", "database name");
// for windows mysqli_connect("localhost", "root", "", "test_db")

/*$user = 'jjjames';
$password = 'utep123';
$db = 'S20pm_team10';
$host = 'ilinkserver.cs.utep.edu';
*/
require_once('..\config.php');
//$conn = mysqli_connect($host, $user, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



if(isset($_POST['update'])) {

    $email = $_POST['oldEmail'];
    $newEmail = $_POST['newEmail'];
    $confirmEmail = $_POST['confirmEmail'];

if($newEmail != $confirmEmail){
    echo '<script>alert("Emails do not match")</script>';
}
else{
    $query = "UPDATE user SET U_email='{$confirmEmail}' WHERE U_email='{$email}'";
    $result = mysqli_query($conn,$query);
    if($result !=null){
        echo '<script>alert("Query Successful")</script>';
        $query = "SELECT U_email from eventcordinator WHERE U_email='{$email}'";
        $result = mysqli_query($conn,$query);
        if(isset($result['U_email'])){
            $query = "UPDATE eventcordinator SET U_Email='{$confirmEmail}' WHERE U_email='{$email}' ";
            $result = mysqli_query($conn,$query);
        }
    else{
        echo '<script>alert("Update could not be posted at this time")</script>';
        header('Location: ../user/userProfile.php');

    }

    }
}
}
?>


<!DOCTYPE HTML>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- custom CSS -->
    <title>Volunteer Login Page</title><!--This is what the tab is-->
</head>

<body class="text-center">
<div class="cccontainer", style="margin:auto">
    <form class="change_email.php" action ="userProfile.php" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">Change Email</h1>
        <label for="oldEmail" class="sr-only">Old Email</label>
        <input type="text" id="oldEmail" name="oldEmail" class="form-control" placeholder="Old Email" required>
        <label for="newEmail" class="sr-only">New Email</label>
        <input type="text" id="newEmail" name="newEmail" class="form-control" placeholder="New Email" required>
        <label for="confirmEmail" class="sr-only">Confirm Email</label>
        <input type="text" id="confirmEmail" name="confirmEmail" class="form-control" placeholder="Confirm Email" required>
        <button class="btn btn-lg btn-primary btn-block" name="update" type="submit">Submit</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>







