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

if(isset($_POST['submit'])){
    $event_name = $_POST['eventName'];
    $event_start = $_POST['eventStart'];
    $event_end = $_POST['eventEnd'];
    $event_description = $_POST['eventDescription'];
//    $event_pp_info = $_POST['parkingPassInformation'];
//    $active_status = $_POST['activeStatus'];
//    $event_location = $_POST['eventLocation'];
//    $target_demographic = $_POST['targetDemographic'];
//    $event_expenses = $_POST['eventExpenses'];
//    $event_sponsor = $_POST['eventSponsor'];
//    $volunteer_limit = $_POST['eventVolunteerLimit'];

    $query = "select * from event where E_name='$event_name'";
    $result = mysqli_query($conn,$query);

    if(!$result){
        die('Query FAILED');
    }else{
        // Check to see if an email already exists.
        $found = mysqli_fetch_assoc($result);
        if(isset($found['U_email'])) {
            echo '<script>alert("This event already exists")</script>';
        }else{
            $query = " INSERT INTO event (E_name,E_start_time,E_end_time, E_description) 
                VALUES('{$event_name}','{$event_start}','{$event_end}','{$event_description}') ";
            $result = mysqli_query($conn,$query);
            if(!$result){
                die('<script>alert("Error posting this event. Please make sure this event does not already exist." +
                     "or that the information entered is correct")</script>');
            }else{
//                session_start();
//                $_SESSION = $_POST;
//                session_write_close();
                header('Location: ../user/Events.php');
                echo '<script>alert("Event Created Successfully")</script>';


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
    <form class="new_event.php" action ="new_event.php" method="POST">
        <img class="mb-4" src="/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Create new account</h1>
        <label for="eventName" class="sr-only">Event Name</label>
        <input type="text" id="eventName" name="eventName" class="form-control" placeholder="Event Name" required>
        <label for="eventStart" class="sr-only">Event Start Date</label>
        <input type="date" id="eventStart" name="eventStart" class="form-control" required>
        <label for="eventEnd" class="sr-only">Event End Date</label>
        <input type="date" id="eventEnd" name="eventEnd" class="form-control" required>
        <label for="eventDescription" class="sr-only">Event Description</label>
        <input type="text" id="eventDescription" name="eventDescription" class="form-control" placeholder="Event Description">
<!--        <label for="parkingPassInformation" class="sr-only">Parking Pass Information</label>-->
<!--        <input type="text" id="parkingPassInformation" name="parkingPassInformation" class="form-control"-->
<!--               placeholder="Parking Pass Information">-->
<!--        <label for="activeStatus" class="sr-only">Active Status</label>-->
<!--        <input type="text" id="activeStatus" name="activeStatus" class="form-control" placeholder="Active Status">-->
<!--        <label for="eventLocation" class="sr-only">Event Location</label>-->
<!--        <input type="text" id="eventLocation" name="eventLocation" class="form-control" placeholder="Event Location">-->
<!--        <label for="targetDemographic" class="sr-only">Target Demographic</label>-->
<!--        <input type="text" id="targetDemographic" name="targetDemographic" class="form-control" placeholder="Target Demographic">-->
<!--        <label for="eventExpenses" class="sr-only">Event Expenses</label>-->
<!--        <input type="text" id="eventExpenses" name="eventExpenses" class="form-control" placeholder="Event Expenses">-->
<!--        <label for="eventSponsor" class="sr-only">Event Sponsor</label>-->
<!--        <input type="text" id="eventSponsor" name="eventSponsor" class="form-control" placeholder="Event Sponsor">-->
<!--        <label for="eventVolunteerLimit" class="sr-only">Volunteer Limit</label>-->
<!--        <input type="text" id="eventVolunteerLimit" name="eventVolunteerLimit" class="form-control" placeholder="Volunteer Limit">-->
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






