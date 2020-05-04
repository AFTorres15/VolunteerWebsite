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
    $approval_status = $row['U_isApproved'];
}
if($email != $db_email){
    die("There has been a fatal error. Please try again.");
}
if($approval_status == 0){
    $status = "Not approved";
}else{
    $status = "Approved";
}
$isCoordinator = "None";
$query = "SELECT *FROM eventcordinator WHERE U_email ='$email'";
$user_query = mysqli_query($conn,$query) or die ("The query could not be completed");
if(mysqli_num_rows($user_query) == 1){
    $isCoordinator = "Event Coordinator";
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
    <title>Volunteer Events Page</title><!--This is what the tab is-->
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
                    <h1 class="text-center">Enlisted Events</h1>

                    <?php
                    $query= (" SELECT E_id FROM volunteerevent WHERE U_email='$db_email' AND VE_is_approved=1");
                    $result=$conn->query($query);
                    echo "<table class=\"table\">
                       <tr><th colspan='4'>Approved Events</th></tr>
                        <tr>
                        <th>Event</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        </tr>";

                    if($result->num_rows>0){
                        while ($row=$result->fetch_assoc()){
                            $query=("SELECT * FROM event WHERE E_id= $row[E_id]");
                            $event_query = mysqli_query($conn, $query) or die ("The query could not be completed");
                            $EventResult=$conn->query($query);
                            while ($Erow=$EventResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $Erow["E_name"] . "</td>";
                                echo "<td>" . $Erow["E_description"] . "</td>";
                                echo "<td>" . $Erow["E_start_time"] . "</td>";
                                echo "<td>" . $Erow["E_end_time"] . "</td>";
                                echo "</tr>";
                            }

                        }
                    }else {
                        //echo "0 Results";
                        echo "<tr><td>"."No Approved Events."."</td></tr>";
                    }
                    echo"</table>";
                    ?>


                    <?php
                    $query= (" SELECT E_id FROM volunteerevent WHERE U_email='$db_email'AND VE_is_approved=0 ");
                    $result=$conn->query($query);
                    echo "<table class=\"table\">
                       <tr><th colspan='4'>Pending Approval</th></tr>
                        <tr>
                        <th>Event</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        </tr>";

                    if($result->num_rows>0){
                        while ($row=$result->fetch_assoc()){
                            $query=("SELECT * FROM event WHERE E_id= $row[E_id] ");
                            $event_query = mysqli_query($conn, $query) or die ("The query could not be completed");
                            $EventResult=$conn->query($query);
                            while ($Erow=$EventResult->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $Erow["E_name"] . "</td>";
                                echo "<td>" . $Erow["E_description"] . "</td>";
                                echo "<td>" . $Erow["E_start_time"] . "</td>";
                                echo "<td>" . $Erow["E_end_time"] . "</td>";
                                echo "</tr>";
                            }

                        }
                    }else {
                        //echo "0 Results";
                        echo "<tr><td>"."No pending Events."."</td></tr>";
                    }
                    echo"</table>";
                    ?>
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