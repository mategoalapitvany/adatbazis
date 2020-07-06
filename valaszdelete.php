<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}

function valasz_diak_delete($diak_id,$link)
{
	$sql = "DELETE FROM valasz WHERE diak_id = " . $diak_id;
	$result = mysqli_query($link, $sql);
	return;

	
	
	
}

function valasz_foglakozas_delete($foglalkozas_id,$link){
	
	$sql = "DELETE FROM valasz WHERE foglalkozas_id = " . $foglalkozas_id;
	$result = mysqli_query($link, $sql);
	return;
}



?>