<?php
session_start();
require_once('..\config.php');

if (isset($_SESSION['inputEmail'])){

$email = $_SESSION['inputEmail'];
$pass = $_SESSION['inputPassword'];
//$link = mysqli_connect($host, $user, $password, $db) or die ("Could not connect to the server");
mysqli_select_db($conn,$db) or die ("That database could not be found");
$query = "SELECT * FROM user WHERE U_email='$email'";
$user_query = mysqli_query($conn,$query) or die ("The query could not be completed");

if(mysqli_num_rows($user_query) != 1){
    die("That username could not be found");
}
while($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)){
    $first_name = $row['U_first_name'];
    $middle_name = $row['U_middle_name'];
    $last_name = $row['U_last_name'];
    $db_email = $row['U_email'];
    $approval_status = $row['U_is_approved'];
}
if($email != $db_email){
    die("There has been a fatal error. Please try again.");
}
if($approval_status == 0){
    $status = "Not approved";
}else{
    $status = "Approved";
}
$isCoordinator = null;
$query = "SELECT *FROM eventcordinator WHERE U_email ='$email'";
$user_query = mysqli_query($conn,$query) or die ("The query could not be completed");
if(mysqli_num_rows($user_query) == 1){
    $isCoordinator = "Event Coordinator";
}

if(isset($_POST['createEvent'])){
    echo '<script>alert("ok")</script>';
    header('Location: ../user/new_event.php');
}

if(isset($_POST['approveUsers'])){
    echo '<script>alert("ok")</script>';
    header('Location: ../user/approve_pending_users.php');
}

//session_destroy();

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
    <title><?php
        if($isCoordinator){
            echo 'Event Coordinator';
        }
        else{
            echo 'Volunteer';
        }
        ?></title><!--This is what the tab is-->
    <!-- EmbedFont-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <?php include ('sidebar.php');?>

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
                    <h1 class="text-center"> Events </h1>
                    <h2 class="small text-center">Second Header</h2>
                    <p class="text-left">This is a very basic visual of what the website will look like for event
                        coordinators. Currently the only button that works is the hamberger menue button. None of the
                        links work currently but will soon be populated and editable. We are having technical
                        difficulites with php and linking our database. Eventually the table below will be interactive
                        allowing the user to sort filter and add events. This webpage follow the utep graphic identity
                        with its font, and colors.</p>
                    <?php
                    $query= ("SELECT * FROM event");
                   $result=$conn->query($query);
                    echo "<table class=\"table\">
                        <tr>
                        <th>Event</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        </tr>";
                    if($result->num_rows>0){
                        while ($row=$result->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>".$row["E_name"]."</td>";
                            echo "<td>".$row["E_description"]."</td>";
                            echo "<td>".$row["E_start_time"]."</td>";
                            echo "<td>".$row["E_end_time"]."</td>";
                            if($isCoordinator == "Event Coordinator"){
                                echo "<td><input type=\"submit\" class=\"btn btn-primary\" value=\"Edit\"></td>";
                            }else{
                                echo'<td><input type="submit" class="btn btn-primary" value="Apply"></td>';
                            }

                            echo"</tr>";
                        }
                      }else {
                        echo "";
                    }
                    echo"</table>";
                    ?>
                    <form class="user.php" method="POST">
                        <?php
                        if($isCoordinator == "Event Coordinator"){
                            echo'<button class="btn btn-lg btn-primary btn-block" name="createEvent" type="submit">Create Event</button>';
                            echo'<button class="btn btn-lg btn-primary btn-block" name="approveUsers" type="submit">View Pending Users</button>';
                        }
                        ?>
                    </form>
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
}else die ("You are not logged in.")
?>
</body>
</html>