<?php

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
    <title>Volunteer Login Page</title><!--This is what the tab is-->
    <!-- EmbedFont-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li><a href="#">Profile</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">New Event</a></li>
        </ul>
    </div>

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
                    <h1 class="text-center">Event Coordinator Home Page</h1>
                    <h2 class="small text-center">Second Header</h2>
                    <p class="text-left">This is a very basic visual of what the website will look like for event
                        coordinators. Currently the only button that works is the hamberger menue button. None of the
                        links work currently but will soon be populated and editable. We are having technical
                        difficulites with php and linking our database. Eventually the table below will be interactive
                        allowing the user to sort filter and add events. This webpage follow the utep graphic identity
                        with its font, and colors.</p>
                    <h2 class="small text-left">The following table is currently hardcoded</h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Event Name</th>
                            <th>Event Description</th>
                            <th>Event Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>HS Hack</td>
                            <td>Cyber security hackacthon for highschool students</td>
                            <td>April 25</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Hour of Code</td>
                            <td>Participate in nation wide hour of code teaching elementary students.</td>
                            <td>April 21-24</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Technology Training Class</td>
                            <td>Server community seniors by helping them connect to the world wide web. Introduce them
                                to facebook and reunite them with loved ones.
                            </td>
                            <td>April 11</td>
                        </tr>
                        </tbody>
                    </table>
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
</body>
</html>