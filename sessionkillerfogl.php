<?php

session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}

include 'db.php';
$link=opendb();

mysqli_close($link);

header("Location:foglalkozasszer.php");
?>