
<!DOCTYPE html>
<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}

include 'db.php';
$link=opendb();
$vnevErr="";
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
$sql = "SELECT * FROM diak WHERE id = " . $_GET["id"];
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$_SESSION['nev']= $row["masodikkeresztnev"];

$valid=false;
$_SESSION['id']=$_GET["id"];


}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include 'testinput.php';
	$vnev=test_input($_POST["vnev"]);
	$_SESSION['nev']=$vnev;
	$valid=true;



}
if ($valid==true)
{

	
	$sql = "UPDATE diak SET masodikkeresztnev='" . $vnev . "' WHERE id = " . $_SESSION["id"];
	mysqli_query($link, $sql);
	header ("Location: sessionkillerdiakread.php");

	
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
                        <h1>Második keresztnév mmódosítása</h1>
                    </div>
							
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
								<h3>Módosítás: </h3> <input class="form-control" type="text" name="vnev" value="<?php echo $_SESSION['nev']?>"/>  <span class="error">* <?php echo $vnevErr;?></span> 

								

							
							<br></br>
							<input type="submit" class="btn btn-primary" value="Elküld" name="uj" />  <a class="btn btn-default" href="sessionkillerdiakread.php">Mégse</a>
							</form>					
                </div>
            </div>        
        </div>
    </div>
		
		
    </body>




   
   </html>
   