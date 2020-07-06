<?php session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}?>
<?php
include 'iskolabe.php';
include 'tanarbe.php';
include 'db.php';
$link=opendb();
if($_SESSION["valaszto"]==2)
{
	$iskola_id=school_ad($_SESSION["ujiskola"],$link);
}else{
	$iskola_id=$_SESSION["iskola"];
}

$tanar_id=teacher_ad($_SESSION["tanar"],$iskola_id,$link);

if ($_SESSION["evf"]>7)
{
	$fizetos=0;	
}else{
	$fizetos=1;
}
if ($_SESSION["palyazat"]==3)
{
	$palyazat=0;
	
}else{
	$palyazat=1;
}

$query=sprintf("INSERT INTO diak (vezeteknev, keresztnev,masodikkeresztnev, evfolyam, lakhely, email1, email2, telefonszam1, telefonszam2, tanar_id , versenyeredmeny, palyazat, fizetos) VALUES ('%s','%s','%s','%d','%s','%s','%s','%s','%s','%d','%s','%d','%d')",
 mysqli_real_escape_string($link, $_SESSION["vnev"]),mysqli_real_escape_string($link, $_SESSION["knev"]),mysqli_real_escape_string($link, $_SESSION["mknev"]),mysqli_real_escape_string($link, $_SESSION["evf"]),mysqli_real_escape_string($link, $_SESSION["lakhely"]),
 mysqli_real_escape_string($link, $_SESSION["email1"]),mysqli_real_escape_string($link, $_SESSION["email2"]),mysqli_real_escape_string($link, $_SESSION["tel1"]),mysqli_real_escape_string($link, $_SESSION["tel2"]),mysqli_real_escape_string($link, $tanar_id),
 mysqli_real_escape_string($link, $_SESSION["eredmeny"]),mysqli_real_escape_string($link, $palyazat),mysqli_real_escape_string($link, $fizetos));

mysqli_query($link, $query);
mysqli_close($link);
$_SESSION['vnev'] = $_SESSION['knev']=$_SESSION['mknev']=$_SESSION['evf']= $_SESSION['valaszto']= $_SESSION['ujiskola']=$_SESSION['tanar']= $_SESSION['lakhely'] = $_SESSION['email1']=$_SESSION['email2']= $_SESSION['tel1'] = $_SESSION['tel2'] = $_SESSION['palyazat'] =$_SESSION['eredmeny']=$_SESSION["iskola"]="";

header("Location:diakszer.php");

?>