<?php
//Syntax for mysqli_connect("host name", "username", "password", "database name");
// for windows mysqli_connect("localhost", "root", "", "test_db")


// Change these to your utep login before running. These are credentials for my MAMP server databases.
$user = 'jay';
$password = 'Eptx79934!';
$db = 'test_db';
$host = 'localhost:3307';
$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])){

    $inputEmail = $_POST['inputEmail'];
    $inputPassword = $_POST['inputPassword'];

    $query = "select * from user where U_email='$inputEmail' and U_password='$inputPassword'";
    //$query = "INSERT INTO USER VALUES('{$txtUsername}','{$txtPass}')";
    $result = mysqli_query($conn,$query); // Executing and storing the incoming data in result
    //Now we need to check whether the data has been retrieved or not. If the data si retrieved the login
    // is successful otherwise it failed.

    if(!$result){
        die('Query FAILED');
    }else{

        $found = mysqli_fetch_assoc($result);
        if($found != null) {
            session_start();
            $_SESSION = $_POST;
            session_write_close();
            echo '<script>alert("Login Successful")</script>';
            header('Location: profile.php');

        }else{
            echo '<script>alert("Login Failed")</script>';
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
    <form class="login.php" method="POST">
        <img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="register" type="submit" onclick="window.location.href
        ='register.php';">Register</button>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
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





