<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    include "db.php";
	$link=opendb();
    
    // Prepare a select statement
    $sql = "SELECT * FROM diak WHERE id = " . $_GET["id"];
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($result);
    $sql2 = "SELECT * FROM iskolai_tanar WHERE ID = " . $row["tanar_id"];
	$result2 = mysqli_query($link, $sql2);
	$row2 = mysqli_fetch_array($result2);
	$sql3 = "SELECT * FROM iskola WHERE ID = " . $row2["iskola_id"];
	$result3 = mysqli_query($link, $sql3);
	$row3 = mysqli_fetch_array($result3);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Részletes adatok</h1>
                    </div>
                    <div class="form-group">
                        <label>Név </label>
						(Vezetéknév<a href="vezetekup.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a> Keresztnév <a href="keresztup.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a> Második keresztnév <a href="mkeresztup.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a>) 
                        <p class="form-control-static"><?php echo $row["vezeteknev"]; echo " ";echo $row["keresztnev"]; echo " "; echo $row["masodikkeresztnev"]; ?> </p>
                    </div>
                
					<div class="form-group">
                        <label>Évfolyam <a href="evfup.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a></label>
                        <p class="form-control-static"><?php echo $row["evfolyam"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Lakhely <a href="lakhelyup.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a></label>
                        <p class="form-control-static"><?php echo $row["lakhely"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Elsődleges e-mail cím <a href="email1up.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a></label>
                        <p class="form-control-static"><?php echo $row["email1"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Biztonsági e-mail cím <a href="email2up.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a></label>
                        <p class="form-control-static"><?php if ($row["email2"]==""){echo "Nem adta meg.";} else{echo $row["email2"];} ?></p>
                    </div>
					<div class="form-group">
                        <label>Elsődleges telefonszám <a href="tel1up.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a></label>
                        <p class="form-control-static"><?php echo $row["telefonszam1"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Biztonsági telefonszám <a href="tel2up.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a></label>
                        <p class="form-control-static"><?php if ($row["telefonszam2"]==""){echo "Nem adta meg.";} else{echo $row["telefonszam2"];} ?></p>
                    </div>
					<div class="form-group">
                        <label>Felkészítő tanár és iskola <a href="fsup.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a></label>
                        <p class="form-control-static"><?php echo $row2["nev"]; ?><br><?php echo $row3["nev"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Eredmények </label>
                        <p class="form-control-static"><?php echo $row["versenyeredmeny"]; ?></p>
                    </div>
					<div class="form-group">
                        <label>Pályázat</label>
                        <p class="form-control-static"><?php if ($row["palyazat"]=="1"){echo "igen";} else{echo "nem";} ?></p>
                    </div>
					<div class="form-group">
                        <label>Fizetős <a href="fizetosup.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a></label>
                        <p class="form-control-static"><?php if ($row["fizetos"]=="1"){echo "igen";} else{echo "nem";} ?></p>
                    </div>
                    <p><a href="diakszer.php" class="btn btn-primary">Vissza</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>