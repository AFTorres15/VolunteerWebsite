<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- custom CSS -->
    <title><?php echo $first_name;?> <?php echo $last_name?>s Profile</title>

</head>
<body>
<?php

session_start();
$user = 'jjjames';
$password = 'utep123';
$db = 'S20pm_team10';
$host = 'ilinkserver.cs.utep.edu';


if (isset($_SESSION['inputEmail'])){

    $email = $_SESSION['inputEmail'];
    $pass = $_SESSION['inputPassword'];
    $link = mysqli_connect($host, $user, $password, $db) or die ("Could not connect to the server");
    mysqli_select_db($link,$db) or die ("That database could not be found");
    $query = "SELECT * FROM user WHERE U_email='$email'";
    $user_query = mysqli_query($link,$query) or die ("The query could not be completed");

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
    $user_query = mysqli_query($link,$query) or die ("The query could not be completed");
    if(mysqli_num_rows($user_query) == 1){
        $isCoordinator = "Event Coordinator";
    }

    session_destroy();

?>
    <h2><?php echo $first_name; ?> <?php echo $last_name; ?></h2><br/>
    <table>
        <tr><td>Firstname:</td><td><?php echo $first_name;?></td></tr>
        <tr><td>Middlename:</td><td><?php echo $middle_name;?></td></tr>
        <tr><td>Lastname:</td><td><?php echo $last_name;?></td></tr>
        <tr><td>Email:</td><td><?php echo $email;?></td></tr>
        <tr><td>Volunteer Status:</td><td><?php echo $status;?></td></tr>
        <tr><td>Admin Status:</td><td><?php echo $isCoordinator;?></td></tr>


    </table>

<?php
}else die ("You need to specify a username!")



?>


</body>
</html>


