<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
include 'tanarell.php';

function teacher_ad ($nev,$iskola_id,$link)

{

	if (tcheck($nev,$iskola_id, $link)==NULL)
	{
		
		$query=sprintf("INSERT INTO iskolai_tanar (nev, iskola_id) VALUES ('%s', '%d')", mysqli_real_escape_string ($link, $nev),mysqli_real_escape_string ($link, $iskola_id));
		mysqli_query($link, $query);
	}
	$tanar_id=tcheck($nev,$iskola_id, $link);
	
	
	return $tanar_id;

}

?>