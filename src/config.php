<?php
/**
 * CS 4342 Database Management
 * @author Kevin Apodaca
 * @since 2/12/20
 * @version 1.0
 * Description: The purpose of this file is to serve as the configuration settings for the database connection. Here we configure the host, db, username, and password and initiate the connection.
 */

$host = "ilinkserver.cs.utep.edu";
$db = 'S20pm_team10';   # enter your team database here.

$username = 'jjjames';  # enter your username here.
$password ='utep123';  # enter your password here.

/**
 * Making the connection to the database.
 * Parameters - host, username, password, team database.
 */
$conn = new mysqli($host, $username, $password, $db);

/**
 * Validating the connection to server.
 */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>