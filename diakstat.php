
<!DOCTYPE html>

<html>
   <head>
    <meta charset="UTF-8">
    <title>Statisztika</title>
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



</html>
<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}


$datumErr="";
$valid=false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include 'testinput.php';
	include 'evfolyamell.php';
	$datumErr="";
	$valid=true;
					if (empty($_POST["date"])) {
				$datumErr = "Dátum megadása kötelező!";
				$valid=false;
				} else {
					$_SESSION['sdatum']=$date=test_input($_POST["date"]);
					if (validateDate($date, 'Y-m-d'))
					{
						$currentDate = date('Y-m-d');
						if ($date>$currentDate)
						{
							$datumErr = "Mai napnál későbbi dátum!";
							$valid=false;
						}
						
						
					}else{
						$datumErr ="Nem megfelelő formátum!";
						$valid=false;
					}
				}



}
?>
<?php if($valid==true): ?>
			<html>
				<body>
					<div class="wrapper">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<div class="page-header">
										<h1>Válasszon</h1>
									</div>
									<div class=".progress-striped .progress-bar">
										 <a class="btn btn-default" href="reszstat.php">Részvételi statisztika generálás</a><br></br>
										 <a class="btn btn-default" href="hianystat.php">Hiányzási statisztika generálás</a><br></br>
										 <a class="btn btn-default" href="norequeststat.php">Nem válaszoló statisztika generálás</a><br></br>
										 
										 <a href="admin.php" value="Mégse" class="btn btn-danger">Mégse</a>
									</div>
								</div>
							</div>        
						</div>
					</div>
				</body>
			</html>

		
		<?php endif; ?>



<?php if($valid==false): ?>
<html>
    

  
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
                        <h1>Dátum megadása</h1>
						<p>Adjon meg egy dátumot, melytől elkezdve a mai napig a rendszer regenerálja a kért statisztikákat.</p>
                    </div>
							
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
								<h3>Dátum: </h3><input type="date" class="form-control" name="date" value="<?php echo $_SESSION['sdatum'];?>"/><span class="error">* <?php echo $datumErr;?></span> 

								

							
							<br></br>
							<input type="submit" class="btn btn-primary" value="Elküld" name="uj" />  <a class="btn btn-default" href="admin.php">Mégse</a>
							</form>					
                </div>
            </div>        
        </div>
    </div>
		
		
    </body>




   
   </html>
   <?php endif; ?>