<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
// Check existence of id parameter before processing further

    // Include config file
    include "db.php";
	$link=opendb();
    $vissza="SELECT* FROM diak";
	$visszaresult = mysqli_query($link, $vissza);
		while ($row0 = mysqli_fetch_array($visszaresult)){
			$seged="0";
			$sql4="UPDATE diak SET seged=" . $seged . " WHERE id = " . $row0["id"];
		mysqli_query($link, $sql4);
			
		}
    // Prepare a select statement
	$currentDate = date('Y-m-d');
    $sql = "SELECT * FROM foglalkozas WHERE datum > '" . $_SESSION["sdatum"] . "' AND datum<'" . $currentDate  . "'";
	$result = mysqli_query($link, $sql);
	$foglalkozasdb="0";
	while ($row = mysqli_fetch_array($result)){
	$sql2="SELECT * FROM valasz WHERE foglalkozas_id=" . $row['id'];
	$result2 = mysqli_query($link, $sql2);
	while ($row2 = mysqli_fetch_array($result2)){
	if($row2['valasz']===null)
	{
	
		$sql3="SELECT * FROM diak WHERE id=" . $row2['diak_id'];
		$result3 = mysqli_query($link, $sql3);
		$row3 = mysqli_fetch_array($result3);
		$seged=$row3['seged'];
		$seged++;

		$sql4="UPDATE diak SET seged=" . $seged . " WHERE id = " . $row2["diak_id"];
		mysqli_query($link, $sql4);
		
		
	}
	}
	
	$foglalkozasdb++;
	
	}





	
	
	
	
	?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nem válaszolók</title>
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
                        <h2 class="pull-left">Nem válaszoló statisztika</h2>
						
                   
                    </div>
                    <?php
                    // Include config file
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
										 echo "<th>E-mail1</th>";
										 echo "<th>E-mail2</th>";
                                        echo "<th>Hiányzás</th>";
										echo"<th>Fogalkozások száma</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
									 
									 
                                    echo "<tr>";
                                        echo "<td>" . $row['evfolyam'] . "</td>";
                                        echo "<td>" . $row['vezeteknev'] . "</td>";
                                        echo "<td>" . $row['keresztnev'] . "</td>";
                                        
										echo "<td>" . $row['email1'] . "</td>";
										echo "<td>" . $row['email2'] . "</td>";
										echo "<td>" . $row['seged'] . "</td>";
										echo "<td>" . $foglalkozasdb. "</td>";
                                    echo "</tr>";
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
					<a href="diakstat.php" class="btn btn-default pull-right">Vissza</a>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>