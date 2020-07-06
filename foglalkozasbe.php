<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}?>

<!DOCTYPE html>
<html>
    
   <head>
    <meta charset="UTF-8">
    <title>Foglalkozásbe</title>
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
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
  
	<style>.error {color: #FF0000;} </style>
</html>

<?php
include 'testinput.php';
include 'db.php';
include 'evfolyamell.php';
$link=opendb();
$nev=$date="";
$nevErr=$datumErr=$evfErr="";
$_SESSION["evf3"]=$_SESSION["evf4"]= $_SESSION["evf5"]=$_SESSION["evf6"]=$_SESSION["evf7"]=$_SESSION["evf8"]=$_SESSION["evf9"]=$_SESSION["evf10"]=$_SESSION["evf11"]=$_SESSION["evf12"]="0";

$valid=false;
$i=0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$valid=true;
			if (empty($_POST["nev"])) {
				$nevErr = "Név megadása kötelező!";
				$valid=false;
				} else {
					$nev=test_input($_POST["nev"]);
				}
				if (empty($_POST["date"])) {
				$datumErr = "Dátum megadása kötelező!";
				$valid=false;
				} else {
					$date=test_input($_POST["date"]);
					if (validateDate($date, 'Y-m-d'))
					{
						$currentDate = date('Y-m-d');
						if ($date<$currentDate)
						{
							$datumErr = "Mai napnál korábbi dátum!";
							$valid=false;
						}
						
						
					}else{
						$datumErr ="Nem megfelelő formátum!";
						$valid=false;
					}
				}
				if(empty($_POST['evf_list']))
					{
						$evfErr="Kötelező mező, kérem válasszon legalább egyet!";
						$valid=false;
					}
					


}

if ($valid==true)
{
	foreach($_POST['evf_list'] as $selected){
					evf_ell($selected);
					

					}
		
	$evf3=$_SESSION['evf3'];$evf4=$_SESSION['evf4'];$evf5=$_SESSION['evf5'];$evf6=$_SESSION['evf6'];$evf7=$_SESSION['evf7'];$evf8=$_SESSION['evf8'];$evf9=$_SESSION['evf9'];
	$evf10=$_SESSION['evf10'];$evf11=$_SESSION['evf11'];$evf12=$_SESSION['evf12'];	
	$query= "INSERT INTO foglalkozas (datum, nev,evf3,evf4,evf5,evf6,evf7,evf8,evf9,evf10,evf11,evf12 ) VALUES ('$date','$nev','$evf3','$evf4','$evf5','$evf6','$evf7','$evf8','$evf9','$evf10','$evf11','$evf12')";
	mysqli_query($link, $query);
	
	header("Location:valaszbe.php");
	
	


	
}

?>
	




<html>
    <body>
	
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Regisztráció</h1>
                    </div>
                    <p>Kérem figyeljen oda, hogy helyes adatokat adjon meg!</p>
					<span class="error">* <?php echo "Kötelező mezők!";?></span>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
								<h3>
								Név: </h3> <input class="form-control" type="text" name="nev" value="<?php echo $nev?>"/>  <span class="error">* <?php echo $nevErr;?></span> 
								
								<h3>
								Dátum: </h3><input type="date" class="form-control" name="date" value="<?php echo $date;?>"/><span class="error">* <?php echo $datumErr;?></span>
								<h3>
								Évfolyamok:
								</h3>
									<input   class="form" type="checkbox"  name="evf_list[]" value="3"> <label>3.évfolyam</label><br/>
									<input   class="form" type="checkbox"  name="evf_list[]" value="4"> <label>4.évfolyam</label><br/>
									<input   class="form" type="checkbox"  name="evf_list[]" value="5"> <label>5.évfolyam</label><br/>
									<input   class="form" type="checkbox"  name="evf_list[]" value="6"> <label>6.évfolyam</label><br/>
									<input   class="form" type="checkbox"  name="evf_list[]" value="7"> <label>7.évfolyam</label><br/>
									<input   class="form" type="checkbox"  name="evf_list[]" value="8"> <label>8.évfolyam</label><br/>
									<input   class="form" type="checkbox"  name="evf_list[]" value="9"> <label>9.évfolyam</label><br/>
									<input   class="form" type="checkbox"  name="evf_list[]" value="10"> <label>10.évfolyam</label><br/>
									<input   class="form" type="checkbox"  name="evf_list[]" value="11"> <label>11.évfolyam</label><br/>
									<input   class="form" type="checkbox"  name="evf_list[]" value="12"> <label>12.évfolyam</label><br/>

								<span class="error">* <?php echo $evfErr;?></span>
		
		

						
						
							<br></br>
							<input type="submit" class="btn btn-primary" value="Elküld" name="uj" />  <a  class="btn btn-default" href="sessionkillerfogl.php">Vissza</a>
						</form>
                </div>
            </div>        
        </div>
    </div>
		
		
    </body>




   
   </html>