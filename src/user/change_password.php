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
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    if($newPassword != $confirmPassword){
        echo '<script>alert("Passwords do not match")</script>';
    }
    else{
        $sql = "UPDATE user set U_password='{$confirmPassword}' WHERE U_email='{$email}'";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Success")</script>';
            header('Location: ../user/userProfile.php');
        } else {
            echo '<script>alert("Update Failed")</script>';
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
    <form class="change_password.php" action ="change_password.php" method="POST">
        <h1 class="h3 mb-3 font-weight-normal">Change Password</h1>
        <label for="email" class="sr-only">email</label>
        <input type="text" id="email" name="email" class="form-control" placeholder="Email" required>
        <label for="newPassword" class="sr-only">New Password</label>
        <input type="text" id="newPassword" name="newPassword" class="form-control" placeholder="New Password" required>
        <label for="confirmPassword" class="sr-only">Confirm Password</label>
        <input type="text" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm Password" required>
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







