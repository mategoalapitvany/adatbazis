<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))&&isset($_GET["id2"])&&!empty(trim($_GET["id2"]))){
    // Include config file
    include "db.php";
	$link=opendb();
    
    // Prepare a select statement
    $sql = "SELECT * FROM valasz WHERE foglalkozas_id = " . $_GET["id"];
	$result = mysqli_query($link, $sql);
	 while($row = mysqli_fetch_array($result))
	 {
		 if ($row['diak_id']==$_GET['id2'])
		 {
			$valasz=$row["valasz"];

			if($valasz=="1"){$valasz="0";}else{$valasz="1";}

			 $sql2 = "UPDATE valasz SET valasz=" . $valasz . " WHERE foglalkozas_id = " . $_GET['id'] . " AND diak_id=" . $_GET['id2'];
			mysqli_query($link, $sql2);
			header ("Location: valaszmod.php?id=" . $_GET["id"]);
			 
		 }
		 
		 
	 }





}

?>




