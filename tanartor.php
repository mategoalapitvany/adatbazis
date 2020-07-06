<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}

include 'db.php';

if (isset($_GET['id']))
{
	$link =opendb();
	$id= $_GET['id'];
	$query= "DELETE FROM iskolai_tanar WHERE id=" . mysqli_real_escape_string($link, $id);
	mysqli_query($link, $query);
	mysqli_close($link);
	
	

}


?>