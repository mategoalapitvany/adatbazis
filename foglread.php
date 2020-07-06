
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
    $sql = "SELECT * FROM foglalkozas WHERE id = " . $_GET["id"];
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($result);
	if ($row["evf3"]==1){$evf3="van";}else{$evf3="nincs";}
	if ($row["evf4"]==1){$evf4="van";}else{$evf4="nincs";}
	if ($row["evf5"]==1){$evf5="van";}else{$evf5="nincs";}
	if ($row["evf6"]==1){$evf6="van";}else{$evf6="nincs";}
	if ($row["evf7"]==1){$evf7="van";}else{$evf7="nincs";}
	if ($row["evf8"]==1){$evf8="van";}else{$evf8="nincs";}
	if ($row["evf9"]==1){$evf9="van";}else{$evf9="nincs";}
	if ($row["evf10"]==1){$evf10="van";}else{$evf10="nincs";}
	if ($row["evf11"]==1){$evf11="van";}else{$evf11="nincs";}
	if ($row["evf12"]==1){$evf12="van";}else{$evf12="nincs";}
	if (isset($_POST['szerk'])){echo "győzelem";}
	
	

   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 500px;
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
                        <h1>Részletes adatok</h1>
                    </div>
                    <div class="form-group">
                        <h3>Név </h3>
                        <p class="form-control-static"><?php echo $row["nev"]; ?> <a href="foglnevup.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a> </p>
                    </div>
                    <div class="form-group">
                        <h3>Dátum</h3>
                        <p class="form-control-static"><?php echo $row["datum"]; ?> <a href="fogldatumup.php?id=<?=$row['id']?>"<span class='glyphicon glyphicon-pencil'></span></a> </p>
                    </div>
                    <div class="form-group">
                        <h3>Évfolyamok:</h3>
                    </div>
					<?php
                    
                    
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
										echo "<th>Évfolyam</th>";
                                        echo "<th>Meghirdetett kurzus</th>";
									echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                          
                                    echo "<tr>";
                                        echo "<td>" . "3. évfolyam" . "</td>";
                                        echo "<td>" .  $evf3 . "</td>";

                                        
                                    echo "</tr>";
									echo "<tr>";
                                        echo "<td>" . "4. évfolyam" . "</td>";
                                        echo "<td>" .  $evf4 . "</td>";
                                    echo "</tr>";
									echo "<tr>";
                                        echo "<td>" . "5. évfolyam" . "</td>";
                                        echo "<td>" .  $evf5 . "</td>";


                                    echo "</tr>";
									echo "<tr>";
                                        echo "<td>" . "6. évfolyam" . "</td>";
                                        echo "<td>" .  $evf6 . "</td>";


                                    echo "</tr>";
									echo "<tr>";
                                        echo "<td>" . "7. évfolyam" . "</td>";
                                        echo "<td>" .  $evf7 . "</td>";


                                    echo "</tr>";
									echo "<tr>";
                                        echo "<td>" . "8. évfolyam" . "</td>";
                                        echo "<td>" .  $evf8 . "</td>";


                                    echo "</tr>";
									echo "<tr>";
                                        echo "<td>" . "9. évfolyam" . "</td>";
                                        echo "<td>" .  $evf9 . "</td>";


                                    echo "</tr>";
									echo "<tr>";
                                        echo "<td>" . "10. évfolyam" . "</td>";
                                        echo "<td>" .  $evf10 . "</td>";


                                    echo "</tr>";
									echo "<tr>";
                                        echo "<td>" . "11. évfolyam" . "</td>";
                                        echo "<td>" .  $evf11 . "</td>";


                                    echo "</tr>";
									echo "<tr>";
                                        echo "<td>" . "12. évfolyam" . "</td>";
                                        echo "<td>" .  $evf12 . "</td>";


                                        
                                    echo "</tr>";
									
                                
                                echo "</tbody>";                            
                            echo "</table>";
                            
                    ?>
					
					
                    <p><a href="sessionkillerfogl.php" class="btn btn-primary">Vissza</a></p>
                </div>
            </div>        
        </div>
    </div>
<script>

</script>

</body>

</html>