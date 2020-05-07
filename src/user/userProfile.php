<?php
session_start();
require_once('..\config.php');


if (isset($_SESSION['inputEmail'])){

    $email = $_SESSION['inputEmail'];
    $pass = $_SESSION['inputPassword'];
    //$link = mysqli_connect($host, $user, $password, $db) or die ("Could not connect to the server");
    mysqli_select_db($conn, $db) or die ("That database could not be found");
    $query = "SELECT * FROM user WHERE U_email='$email'";
    $user_query = mysqli_query($conn, $query) or die ("The query could not be completed");

    if (mysqli_num_rows($user_query) != 1) {
        die("That username could not be found");
    }
    while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
        $first_name = $row['U_first_name'];
        $middle_name = $row['U_middle_name'];
        $last_name = $row['U_last_name'];
        $db_email = $row['U_email'];
        $approval_status = $row['U_is_approved'];
    }
    if ($email != $db_email) {
        die("There has been a fatal error. Please try again.");
    }
    if ($approval_status == 0) {
        $status = "Not approved";
    } else {
        $status = "Approved";
    }
    $isCoordinator = "None";
    $query = "SELECT *FROM eventcordinator WHERE U_email ='$email'";
    $user_query = mysqli_query($conn, $query) or die ("The query could not be completed");
    if (mysqli_num_rows($user_query) == 1) {
        $isCoordinator = "Event Coordinator";
    }



if(isset($_POST['changePassword'])){
    echo '<script>alert("Change Password")</script>';
    header('Location: ../user/change_password.php');

}


$query = "SELECT U_email FROM eventcordinator WHERE U_email='$db_email'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 1) {
    //header('Location: ../EventCoordinatorPage/EventCoordinator.php');
    // header('Location: profile.php');
    $accountType = "Event Coordinator";
} else {
    $query = "SELECT U_email FROM volunteer WHERE U_email='$db_email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $accountType = "Volunteer";
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="sidebar.css">
    <title><?php echo $accountType ?> </title><!--This is what the tab is-->
    <!-- EmbedFont-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include('sidebar.php'); ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container" onclick="myFunction(this)">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                    <div class="col mb-3">
                        <h1 class="text-center"><?php echo $accountType ?> Information Page</h1>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width: 140px;">
                                            <div class="d-flex justify-content-center align-items-center rounded"
                                                 style="height: 140px; background-color: rgb(233, 236, 239);">
                                                <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $first_name . " " . $middle_name . " " . $last_name ?></h4>
                                            <p class="mb-0"><?php echo $db_email?></p>
                                            <div class="mt-2">
                                                <button disabled class="btn btn-primary" type="button">
                                                    <i class="fa fa-fw fa-camera"></i>
                                                    <span>Change Photo</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-center text-sm-right">

                                            <span class="badge badge-secondary"><?php echo $accountType ?></span>
                                            </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                                </ul>

                                <div class="tab-content pt-3">
                                    <div class="tab-pane active">
                                        <form class="form" novalidate="" method="POST">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Full Name:</label><br>
                                                                <label><?php echo $first_name." ".$middle_name." ".$last_name;  ?></label>
<!--                                                                <input class="form-control" type="text" name="name"-->
<!--                                                                      value =--><?php //echo $first_name." ".$middle_name." ".$last_name;  ?><!--disable>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Email</label><br>
                                                                <label><?php echo $db_email; ?></label>

<!--                                                                <input class="form-control" id="input_Email" name="input_Email" type="text"-->
<!--                                                                       value=--><?php //echo $db_email;?><!-- disable >-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>Skills</label><br>
                                                                <label>
                                                                    <?php

                                                                    $query = "select VS_skill from volunteerskills where U_email='$db_email'";
                                                                    $result = mysqli_query($conn,$query);
                                                                    $found = mysqli_fetch_assoc($result);
                                                                    if(isset($found['VS_skill'])){
                                                                        echo $found['VS_skill'];
                                                                    }
                                                                    ?>

                                                                </label>


                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6 mb-3">
<!--                                                    <div class="mb-2"><b>Change Password</b></div>-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="col">-->
<!--                                                            <div class="form-group">-->
<!--                                                                <label>Current Password</label>-->
<!--                                                                <input class="form-control" name="current_password" id="current_password" type="password"-->
<!--                                                                       placeholder="••••••">-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="col">-->
<!--                                                            <div class="form-group">-->
<!--                                                                <label>New Password</label>-->
<!--                                                                <input class="form-control" type="password" name="new_password" id="new_password"-->
<!--                                                                       placeholder="••••••">-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <div class="row">-->
<!--                                                        <div class="col">-->
<!--                                                            <div class="form-group">-->
<!--                                                                <label>Confirm <span-->
<!--                                                                            class="d-none d-xl-inline">Password</span></label>-->
<!--                                                                <input class="form-control" type="password" name="confirm_password" id="confirm_password"-->
<!--                                                                       placeholder="••••••">-->
<!--                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col d-flex justify-content-end">
                                                    <p id="demo"></p>

                                                    <script>
                                                        function myFunction() {
                                                            var txt;
                                                            var r = confirm("Press a button!");
                                                            if (r == true) {
                                                                <?php

                                                                $sql = "DELETE FROM user WHERE U_email='{$email}'";
                                                                if ($conn->query($sql) === TRUE) {
                                                                    echo '<script>alert("Success")</script>';
                                                                    header('Location: ../login/login.php');
                                                                } else {
                                                                    echo '<script>alert("Update Failed")</script>';
                                                                }
                                                                ?>
                                                            } else {
                                                            }
                                                            document.getElementById("demo").innerHTML = txt;
                                                        }
                                                    </script>
                                                    <button class="btn btn-primary" name="changePassword" type="submit">Change Password</button>
                                                    <button class="btn btn-primary" name="deleteAccount" type="submit" onclick="myFunction()">Delete Account</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<script>
    function myFunction(x) {
        x.classList.toggle("change");
        $("#wrapper").toggleClass("menuDisplayed");
    }
</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<?php
}else die ("You need to specify a username!")
?>
</body>
</html>
