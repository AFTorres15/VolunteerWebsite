<?php
//Syntax for mysqli_connect("host name", "username", "password", "database name");
// for windows mysqli_connect("localhost", "root", "", "test_db")

$user = 'jay';
$password = 'Eptx79934!';
$db = 'test_db';
$host = 'localhost:3307';



$conn = mysqli_connect($host, $user, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])){
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $inputEmail = $_POST['inputEmail'];
    $inputPassword = $_POST['inputPassword'];

    $query = "select * from user where U_email='$inputEmail'";
    $result = mysqli_query($conn,$query);

    if(!$result){
        die('Query FAILED');
    }else{
        // Check to see if an email already exists.
        $found = mysqli_fetch_assoc($result);
        if($found['U_email']!= null) {
            echo '<script>alert("An account already exists for this email")</script>';
        }else{
            $query = " INSERT INTO user VALUES('{$inputEmail}','{$firstName}','{$middleName}','{$lastName}','{$inputPassword}',0) ";
            $result = mysqli_query($conn,$query);
            if(!$result){
                die('<script>alert("User Could not be posted at this time.")</script>');
            }else{
                echo '<script>alert("Account created successfully")</script>';
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
    <link rel="stylesheet" href="login.css">
    <title>Volunteer Login Page</title><!--This is what the tab is-->
</head>

<body class="text-center">
<div class="cccontainer", style="margin:auto">
    <form class="login.php" method="post">
        <img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Create new account</h1>
        <label for="firstName" class="sr-only">First Name</label>
        <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First Name" required>
        <label for="middleName" class="sr-only">Middle Name</label>
        <input type="text" id="middleName" name="middleName" class="form-control" placeholder="Middle Name">
        <label for="lastName" class="sr-only">Last Name</label>
        <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last Name" required>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Submit</button>
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






