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
    $sql = "SELECT * FROM valasz WHERE foglalkozas_id = " . $_GET["id"];
	$result = mysqli_query($link, $sql);
	while ($row = mysqli_fetch_array($result))
	{
		$sql = "UPDATE valasz SET tstamp='" . $_SERVER["REQUEST_TIME"] . "' WHERE foglalkozas_id = " . $_GET["id"];
		mysqli_query($link, $sql);
		
	}
	




}
	
	
	
	
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meghívó</title>
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
                   $sql = "SELECT * FROM valasz WHERE foglalkozas_id = " . $_GET["id"];
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
										echo "<th>Név</th>";
                                        echo "<th>E-mail</th>";
										echo"<th>URL</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
									$sql2 = "SELECT * FROM diak WHERE id = " . $row["diak_id"];
									$diak = mysqli_query($link, $sql2);
									$row2 = mysqli_fetch_array($diak);
									$nev= $row2['vezeteknev'] . " " . $row2['keresztnev'] . " " . $row2['masodikkeresztnev'];
									$url = "http://localhost/h%C3%A1zi/activate.php?token=" . $row['token'];
                                    echo "<tr>";
                                        echo "<td>" . $nev . "</td>";
                                        echo "<td>" . $row2['email1'] . "</td>";
										echo "<td>" . $url . "</td>";
										
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
					<a href="foglalkozasgener.php" class="btn btn-default pull-right">Vissza</a>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>