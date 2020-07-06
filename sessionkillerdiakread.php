<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}

$id=$_SESSION["id"];

$_SESSION['nev']=$_SESSION['id']="";
header ("Location: diakread.php?id=" . $id);
?>