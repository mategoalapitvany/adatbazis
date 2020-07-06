//Itt elnneörizzük, hogy az adott xx bent van e az adatbázisban
<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
function icheck ($nev, $link)

{
	$eredmeny=mysqli_query($link, "SELECT * FROM iskola" )or die("Die");
	
	while ($row=mysqli_fetch_array($eredmeny))
		{
			if ($nev==$row['nev'])
				return($row['id']);
			
		}
	
	return NULL;
	
	
}



?>