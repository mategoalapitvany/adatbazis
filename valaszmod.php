<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
		$url = "http://localhost/h%C3%A1zi/valaszmod.php?id=" . $_GET['id'];
    // Include config file
    include "db.php";
	$link=opendb();
    
    // Prepare a select statement
    $sql = "SELECT * FROM valasz WHERE foglalkozas_id = " . $_GET["id"];
	$result = mysqli_query($link, $sql);
	$evfErr="";
	$valid=false;
	$evf="";




}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include'testinput.php';
	$valid=true;
					if(empty($_POST['evf']))
					{
						$evfErr="Kötelező mező, kérem válasszon legalább egyet!";
						$valid=false;
					}
					else{$evf=test_input($_POST['evf']);}
}

?>
<?php if($valid==true): ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Foglalkozások</title>
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
	<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Foglalkozások</h2>
                    </div>
                    <?php
                    // Include config file
                    // Attempt select query execution
                   $sql = "SELECT * FROM valasz WHERE foglalkozas_id = " . $_GET["id"] ;
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
										echo "<th>Név</th>";
                                        echo "<th>Válasz</th>";
                                        echo "<th>Módosítás</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
									$sql2 = "SELECT * FROM diak WHERE id = " . $row["diak_id"];
									$diak = mysqli_query($link, $sql2);
									$row2 = mysqli_fetch_array($diak);
									$nev= $row2['vezeteknev'] . " " . $row2['keresztnev'] . " " . $row2['masodikkeresztnev'];
									if ($row['valasz']==1){$valasz="Igen";}else {$valasz="Nem";}
									if ($row2['evfolyam']==$evf){
                                        echo "<td>" . $nev . "</td>";
                                        echo "<td>" . $valasz . "</td>";
										 echo "<td>";
                                            echo "<a href='valaszup.php?id=". $_GET['id'] ." &id2=". $row2['id'] ."'title='Változtatás' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                        echo "</td>";
										
										echo "</tr>";
									}
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
					<a href="valaszszer.php" class="btn btn-default pull-right">Vissza</a>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

		
		<?php endif; ?>
<?php if($valid==false):?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Foglalkozások</title>
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
 <body>
	
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Melyik évfolyam adatait mutatsam?</h1>
                    </div>
					<span class="error">* <?php echo "Kötelező mezők!";?></span>
					<form method="post" action="<?php echo $url;?>">
								<h3>
							Évfolyam: </h3>
							<select class="form-control" name="evf" size=”1” required>
								<option value="0" selected>Kérem válaszon</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11" >11</option>
							</select>
							<span class="error">* <?php echo $evfErr;?></span>
		
		

						
						
							<br></br>
							<input type="submit" class="btn btn-primary" value="Elküld" name="uj" />  <a  class="btn btn-default" href="valaszszer.php">Vissza</a>
						</form>
                </div>
            </div>        
        </div>
    </div>
		
		
    </body>




   
   </html>
   
   <?php endif; ?>