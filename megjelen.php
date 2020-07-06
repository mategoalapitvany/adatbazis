<?php
session_start();
$link=mysqli_connect ("localhost", "root", "") or die ("Connection error".mysqli_error ());
	mysqli_select_db($link, "matego");
	mysqli_query($link, "set character_set_results='utf-8'");
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
// Check existence of id parameter before processing further

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file

    
    // Prepare a select statement
	$_SESSION['mid']=$_GET['id'];


	




}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$sql2 = "SELECT * FROM valasz WHERE foglalkozas_id = " . $_SESSION["mid"];
$result2 = mysqli_query($link, $sql2);
$row2=mysqli_fetch_array($result2);
$sql = "SELECT * FROM diak ORDER BY evfolyam, vezeteknev, keresztnev";
$result = mysqli_query($link, $sql);
$id="0";
while ($row = mysqli_fetch_array($result)){

	 
	echo $_SESSION['mid'];
	echo $row['id'];
	$sql3 = "UPDATE valasz SET megjelent=" . $_POST ['nev'][$id] . " WHERE foglalkozas_id = " . $_SESSION['mid'] . " AND diak_id=" . $row['id'];
	mysqli_query($link, $sql3);
	$id++;
			
	
	
	
}

header("Location:valaszszer.php");

}



	?>
	
	<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diákok</title>
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
                        <h2 class="pull-left">Diákok</h2>
                   
                    </div>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <?php
                    // Include config file
                    include "db.php";
                    $link=opendb();
					$_SESSION['revf']="2";
                    // Attempt select query execution
                    $sql = "SELECT * FROM diak ORDER BY evfolyam, vezeteknev, keresztnev";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
									echo "<th>Évfolyam</th>";
										echo "<th>Vezetéknév</th>";
                                        echo "<th>Keresztnév</th>";
                                        echo "<th>Iskola cím</th>";
										echo"<th>Aláírás</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
								$id="0";
                                while($row = mysqli_fetch_array($result)){
									
									 $sql2 = "SELECT * FROM iskolai_tanar WHERE ID=" . $row['tanar_id'];
									 $result2 = mysqli_query($link, $sql2);
									 $row2 = mysqli_fetch_array($result2);$sql3 = "SELECT * FROM iskola WHERE ID=" . $row2['iskola_id'];
									 $result3 = mysqli_query($link, $sql3);
									 $row3 = mysqli_fetch_array($result3);
									 if ($row['evfolyam']!=$_SESSION['revf'])
									 {
										 $_SESSION['revf']=$row['evfolyam'];
										 echo "<tr>";
                                        echo "<td>" . $row['evfolyam'] . "</td>";
                                        echo "<td>" . $row['evfolyam'] . "</td>";
                                        echo "<td>" . $row['evfolyam'] . "</td>";
                                        echo "<td>" . $row['evfolyam'] . "</td>";

                                    echo "</tr>";
										 
									 }
									 
                                    echo "<tr>";
                                        echo "<td>" . $row['evfolyam'] . "</td>";
                                        echo "<td>" . $row['vezeteknev'] . "</td>";
                                        echo "<td>" . $row['keresztnev'] . "</td>";
                                        echo "<td>" . $row3['nev'] . "</td>";
                                        echo "<td><input class='form' type='text' name='nev[]' size='1'/>
                                        </td>";
                                    echo "</tr>";
									$id=$id+"1";
									
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
							$_SESSION[' mid2']=$id;
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
					<input type="submit" class="btn btn-primary" value="Elküld" name="uj" /><a href="valaszszer.php" class="btn btn-default pull-right">Vissza</a>
					</form>
					
                </div>
            </div>        
        </div>
    </div>
</body>
</html>