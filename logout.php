<?php

include 'db.php';
$link=opendb();
mysqli_close($link);
session_start();
session_destroy();
header("Location:index.php");

?>