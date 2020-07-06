
<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
include 'db.php';
$link =opendb();
$foglalkozas=mysqli_query($link, "SELECT id FROM foglalkozas ORDER BY id DESC LIMIT 1");
$row = mysqli_fetch_array($foglalkozas);
$zero="0";
if ($_SESSION["evf3"]==1)
{
	$gyerek2=mysqli_query($link, "SELECT id FROM diak WHERE evfolyam=2");
	$gyerek3=mysqli_query($link, "SELECT id FROM diak WHERE evfolyam=3");
	while($row2= mysqli_fetch_array($gyerek2))
	{
		$username=$row2['id'] . $row['id'];
		$token=sha1(uniqid($username, true));
		$query=sprintf("INSERT INTO valasz ( diak_id, foglalkozas_id, megjelent, token ) VALUES ('%d','%d','%d','%s')",mysqli_real_escape_string($link, $row2['id']),mysqli_real_escape_string($link, $row['id']), mysqli_real_escape_string($link, $zero), mysqli_real_escape_string($link, $token));
		mysqli_query($link, $query);
	}
	while ($row3= mysqli_fetch_array($gyerek3))
	{
		$username=$row3['id'] . $row['id'];
		$token=sha1(uniqid($username, true));
		$query=sprintf("INSERT INTO valasz ( diak_id, foglalkozas_id, megjelent, token ) VALUES ('%d','%d','%d','%s')",mysqli_real_escape_string($link, $row3['id']),mysqli_real_escape_string($link, $row['id']), mysqli_real_escape_string($link, $zero), mysqli_real_escape_string($link, $token));
		mysqli_query($link, $query);
		
	}

	
}
if ($_SESSION["evf4"]==1)
{
	$gyerek4=mysqli_query($link, "SELECT id FROM diak WHERE evfolyam=4");
	while($row4= mysqli_fetch_array($gyerek4))
	{
		$username=$row4['id'] . $row['id'];
		$token=sha1(uniqid($username, true));
		$query=sprintf("INSERT INTO valasz ( diak_id, foglalkozas_id, megjelent, token ) VALUES ('%d','%d','%d','%s')",mysqli_real_escape_string($link, $row4['id']),mysqli_real_escape_string($link, $row['id']), mysqli_real_escape_string($link, $zero), mysqli_real_escape_string($link, $token));
		mysqli_query($link, $query);
	}
}
if ($_SESSION["evf5"]==1)
{
	$gyerek5=mysqli_query($link, "SELECT id FROM diak WHERE evfolyam=5");
	while($row5= mysqli_fetch_array($gyerek5))
	{
		$username=$row5['id'] . $row['id'];
		$token=sha1(uniqid($username, true));
		$query=sprintf("INSERT INTO valasz ( diak_id, foglalkozas_id, megjelent, token ) VALUES ('%d','%d','%d','%s')",mysqli_real_escape_string($link, $row5['id']),mysqli_real_escape_string($link, $row['id']), mysqli_real_escape_string($link, $zero), mysqli_real_escape_string($link, $token));
		mysqli_query($link, $query);
	}
}
if ($_SESSION["evf6"]==1)
{
	$gyerek6=mysqli_query($link, "SELECT id FROM diak WHERE evfolyam=6");
	while($row6= mysqli_fetch_array($gyerek6))
	{
		$username=$row6['id'] . $row['id'];
		$token=sha1(uniqid($username, true));
		$query=sprintf("INSERT INTO valasz ( diak_id, foglalkozas_id, megjelent, token ) VALUES ('%d','%d','%d','%s')",mysqli_real_escape_string($link, $row6['id']),mysqli_real_escape_string($link, $row['id']), mysqli_real_escape_string($link, $zero), mysqli_real_escape_string($link, $token));
		mysqli_query($link, $query);
	}
}
if ($_SESSION["evf7"]==1)
{
	$gyerek7=mysqli_query($link, "SELECT id FROM diak WHERE evfolyam=7");
	while($row7= mysqli_fetch_array($gyerek7))
	{
		$username=$row7['id'] . $row['id'];
		$token=sha1(uniqid($username, true));
		$query=sprintf("INSERT INTO valasz ( diak_id, foglalkozas_id, megjelent, token ) VALUES ('%d','%d','%d','%s')",mysqli_real_escape_string($link, $row7['id']),mysqli_real_escape_string($link, $row['id']), mysqli_real_escape_string($link, $zero), mysqli_real_escape_string($link, $token));
		mysqli_query($link, $query);
	}
}
if ($_SESSION["evf8"]==1)
{
	$gyerek8=mysqli_query($link, "SELECT id FROM diak WHERE evfolyam=8");
	while($row8= mysqli_fetch_array($gyerek8))
	{
		$username=$row8['id'] . $row['id'];
		$token=sha1(uniqid($username, true));
		$query=sprintf("INSERT INTO valasz ( diak_id, foglalkozas_id, megjelent, token ) VALUES ('%d','%d','%d','%s')",mysqli_real_escape_string($link, $row8['id']),mysqli_real_escape_string($link, $row['id']), mysqli_real_escape_string($link, $zero), mysqli_real_escape_string($link, $token));
		mysqli_query($link, $query);
	}
}
if ($_SESSION["evf9"]==1)
{
	$gyerek9=mysqli_query($link, "SELECT id FROM diak WHERE evfolyam=9");
	while($row9= mysqli_fetch_array($gyerek9))
	{
		$username=$row9['id'] . $row['id'];
		$token=sha1(uniqid($username, true));
		$query=sprintf("INSERT INTO valasz ( diak_id, foglalkozas_id, megjelent, token ) VALUES ('%d','%d','%d','%s')",mysqli_real_escape_string($link, $row9['id']),mysqli_real_escape_string($link, $row['id']), mysqli_real_escape_string($link, $zero), mysqli_real_escape_string($link, $token));
		mysqli_query($link, $query);
	}
}
if ($_SESSION["evf10"]==1)
{
	$gyerek10=mysqli_query($link, "SELECT id FROM diak WHERE evfolyam=10");
	while($row10= mysqli_fetch_array($gyerek10))
	{
		$username=$row10['id'] . $row['id'];
		$token=sha1(uniqid($username, true));
		$query=sprintf("INSERT INTO valasz ( diak_id, foglalkozas_id, megjelent, token ) VALUES ('%d','%d','%d','%s')",mysqli_real_escape_string($link, $row10['id']),mysqli_real_escape_string($link, $row['id']), mysqli_real_escape_string($link, $zero), mysqli_real_escape_string($link, $token));
		mysqli_query($link, $query);
	}
}
if ($_SESSION["evf11"]==1)
{
	$gyerek11=mysqli_query($link, "SELECT id FROM diak WHERE evfolyam=11");
	while($row11= mysqli_fetch_array($gyerek11))
	{
		$username=$row11['id'] . $row['id'];
		$token=sha1(uniqid($username, true));
		$query=sprintf("INSERT INTO valasz ( diak_id, foglalkozas_id, megjelent, token ) VALUES ('%d','%d','%d','%s')",mysqli_real_escape_string($link, $row11['id']),mysqli_real_escape_string($link, $row['id']), mysqli_real_escape_string($link, $zero), mysqli_real_escape_string($link, $token));
		mysqli_query($link, $query);
	}
}
if ($_SESSION["evf12"]==1)
{
	$gyerek12=mysqli_query($link, "SELECT id FROM diak WHERE evfolyam=12");
	while($row12= mysqli_fetch_array($gyerek12))
	{
		$username=$row12['id'] . $row['id'];
		$token=sha1(uniqid($username, true));
		$query=sprintf("INSERT INTO valasz ( diak_id, foglalkozas_id, megjelent, token ) VALUES ('%d','%d','%d','%s')",mysqli_real_escape_string($link, $row12['id']),mysqli_real_escape_string($link, $row['id']), mysqli_real_escape_string($link, $zero), mysqli_real_escape_string($link, $token));
		mysqli_query($link, $query);
	}
}
$_SESSION["evf3"]=$_SESSION["evf4"]=$_SESSION["evf5"]=$_SESSION["evf6"]=$_SESSION["evf7"]=$_SESSION["evf8"]=$_SESSION["evf9"]=$_SESSION["evf10"]=$_SESSION["evf11"]=$_SESSION["evf12"]="0";
mysqli_close($link);
echo '<script> alert("Sikeresen hozzáadott foglalkozás!"); window.location.href="foglalkozasszer.php"</script>';





?>