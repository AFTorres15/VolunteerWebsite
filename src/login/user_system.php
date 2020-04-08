<?php
//check if the form has been submitted

if(isset($_GET['submit'])){

}

?>

<html lang="en">
<head>

    <title>
        Search for a user
    </title>

</head>
<body>
<h2>
    Search for a user below
</h2>
<br></br>
<form action="profile.php" method="GET">
    <table>
        <tr><td>Username:</td><td><input type="text" id="inputEmail" name="inputEmail"></td></tr>
        <tr><td><input type="submit" id="submit" name="submit" value="View Profile"></td></tr>
    </table>
</form>
</body>
</html>
