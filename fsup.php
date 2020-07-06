
<!DOCTYPE html>
<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}

include 'db.php';
$link=opendb();
$tanarErr=$valasztoErr=$ujiskolaErr="";
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
$sql = "SELECT * FROM diak WHERE id = " . $_GET["id"];
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($result);
    $sql2 = "SELECT * FROM iskolai_tanar WHERE ID = " . $row["tanar_id"];
	$result2 = mysqli_query($link, $sql2);
	$row2 = mysqli_fetch_array($result2);
	$sql3 = "SELECT * FROM iskola WHERE ID = " . $row2["iskola_id"];
	$result3 = mysqli_query($link, $sql3);
	$row3 = mysqli_fetch_array($result3);
	$sql4 = "SELECT * FROM iskola";
	$result4 = mysqli_query($link, $sql4);
$_SESSION['inev']= $row3["nev"];
$_SESSION['tnev']=$row2["nev"];
$valid=false;
$_SESSION['id']=$_GET["id"];


}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$sql4 = "SELECT * FROM iskola";
	$result4 = mysqli_query($link, $sql4);
	include 'testinput.php';
	$vnevErr="";
	$valid=true;
	if (empty($_POST["valaszto"])) {
				$valasztoErr = "Válasszon egy iskolát vagy adjon meg új intézményt";
				$valid=false;
				} else {
					$valaszto=test_input($_POST["valaszto"]);
					$_SESSION["valaszto"]=$valaszto;
					if($valaszto==2 and empty($_POST["ujiskola"]))
					{
						$ujiskolaErr="Kérem adja meg az új iskola nevét!";
						$valid=false;
					}else{
						$ujiskola=test_input($_POST["ujiskola"]);
						$_SESSION["ujiskola"]=$ujiskola;
					}
					if($valaszto==1 and $_POST["iskola"]==0){
						$valasztoErr = "Válasszon egy iskolát vagy adjon meg új intézményt";
						$valid=false;
					}else{
						$iskola=test_input($_POST["iskola"]);
						$_SESSION["iskola"]=$iskola;
					}
						
				}
			if (empty($_POST["tanar"])) {
				$tanarErr = "Tanár megadása kötelező!";
				$valid=false;
				} else {
					$tanar=test_input($_POST["tanar"]);
					$_SESSION["tanar"]=$tanar;
				}


}
if ($valid==true)
	
{	
	include 'tanarbe.php';
	
	if($_SESSION["valaszto"]==2)
	{
		$iskola_id=school_ad($_SESSION["ujiskola"],$link);
	}else{
		$iskola_id=$_SESSION["iskola"];
	}

	$tanar_id=teacher_ad($_SESSION["tanar"],$iskola_id,$link);


	
	$sql = "UPDATE diak SET tanar_id='" . $tanar_id . "' WHERE id = " . $_SESSION["id"];
	mysqli_query($link, $sql);
	header ("Location: diakread.php?id=" . $_SESSION["id"]);

	
}
?>




<html>
    
   <head>
    <meta charset="UTF-8">
    <title>Update</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
    <title>Diák be</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
	<style>.error {color: #FF0000;} </style>
    <body>
	
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Módosítása</h1>
						<h4>Jelenlegi iskola:<?php echo $_SESSION['inev'];?></h4>
						<h4>Jelenlegi tanár:<?php echo $_SESSION['tnev'];?></h4>
						
						
                    </div>
							
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
								<h3>Iskola neve:</h3> <br />
								<input name="valaszto" type="radio" value="1" /> Már regisztrált iskola:
								<select class="form-control" name="iskola" size=”1” required>
									<option value="0" selected>Kérem válaszon</option>
								
									<?php while ($row4 = mysqli_fetch_array($result4)) : ?>
									<option value="<?php echo $row4['id']; ?>"><?php echo $row4['nev']; ?></option>
									<?php endwhile; ?>

								</select>
								<span class="error">* <?php echo $valasztoErr;?></span>
								<br />
								<input name="valaszto" type="radio" value="2" />Új iskola <input  class="form-control" type="text" name="ujiskola"  /><span class="error">* <?php echo $ujiskolaErr;?></span>
							
							<h3>
								Felkészítő tanár:</h3> <input class="form-control" type="text" name="tanar" value="<?php echo $_SESSION['tnev'];?>"/>  
								<span class="error">* <?php echo $tanarErr;?></span>				
							
							<h3>

								

							
							<br></br>
							<input type="submit" class="btn btn-primary" value="Elküld" name="uj" />  <a class="btn btn-default" href="sessionkillerdiakread.php">Mégse</a>
							</form>					
                </div>
            </div>        
        </div>
    </div>
		
		
    </body>




   
   </html>
   