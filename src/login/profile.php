<html lang="en">
<head>
    <title><?php echo $first_name;?> <?php echo $last_name?>s Profile</title>
</head>
<body>
<?php

$user = 'jay';
$password = '';
$db = 'test_db';
$host = 'localhost:3307';


if (isset($_GET['inputEmail'])){
    $email = $_GET['inputEmail'];
    $pass = $_GET['inputPassword'];
    $link = mysqli_connect($host, $user, $password, $db) or die ("Could not connect to the server");
    mysqli_select_db($link,$db) or die ("That database could not be found");
    $query = "SELECT * FROM user WHERE U_email='$email'  and U_password='$pass'";
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
        die("There ahs been a fatal error. Please try again.");
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


