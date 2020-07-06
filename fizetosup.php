<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}

include 'db.php';
$link=opendb();
$sql = "SELECT * FROM diak WHERE id = " . $_GET["id"];
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$fizetos= $row["fizetos"];

if($fizetos==1){$fizetos=0;}else{$fizetos=1;}
$sql = "UPDATE diak SET fizetos='" . $fizetos . "' WHERE id = " . $_GET["id"];
mysqli_query($link, $sql);
header ("Location: diakread.php?id=" . $_GET["id"]);
?>