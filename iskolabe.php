// A feladat az, hogy beszúrjunk egy iskolá, ha még nem létezik ilyen.

<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
include 'iskolaell.php';

function school_ad ($nev,$link)

{

	if (icheck($nev, $link)==NULL)
	{
		 $query=sprintf("INSERT INTO iskola (nev) VALUES ('%s')", mysqli_real_escape_string ($link, $nev));
			mysqli_query($link, $query);
	}
	$id=icheck($nev, $link);
	
	return $id;

}

?>