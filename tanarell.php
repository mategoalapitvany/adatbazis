<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
function tcheck ($nev, $id, $link)

{
	$eredmeny=mysqli_query($link, "SELECT * FROM iskolai_tanar" ) or die("Die");
	
	while ($row=mysqli_fetch_array($eredmeny))
		{
			if ($nev==$row['nev']and $id==$row['iskola_id'])
				return($row['ID']);
			
		}
	
	return NULL;
	
	
}



?>