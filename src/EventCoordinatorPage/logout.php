<?php
session_start();
require_once('..\config.php');
unset($_SESSION['inputEmail']);


header('Location: ../../index.php');
session_destroy();
?>
