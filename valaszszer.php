<?php session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
$_SESSION["evf3"]=$_SESSION["evf4"]=$_SESSION["evf5"]=$_SESSION["evf6"]=$_SESSION["evf7"]=$_SESSION["evf8"]=$_SESSION["evf9"]=$_SESSION["evf10"]=$_SESSION["evf11"]=$_SESSION["evf12"]="0";
$evf="0";
$url="http://localhost/h%C3%A1zi/valaszmod.php?id=" . $evf;?>

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
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$evf=$_POST['evf'];
	$url="http://localhost/h%C3%A1zi/valaszmod.php?id=" . $evf;
}
?>

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
                    include "db.php";
                    $link=opendb();
                    // Attempt select query execution
                    $sql = "SELECT * FROM foglalkozas ORDER BY datum DESC";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
										echo "<th>Név</th>";
                                        echo "<th>Dátum</th>";
										echo"<th>Válasszon</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['nev'] . "</td>";
                                        echo "<td>" . $row['datum'] . "</td>";
										echo "<td>";
                                            echo "<a href='valaszmod.php?id=". $row['id'] ."' title='Válasz módosítása' data-toggle='tooltip'> Válasz módosítása</a><br>";
                                            echo "<a href='megjelen.php?id=". $row['id'] ."' title='Megjelent állapot módosítása' data-toggle='tooltip'>Megjelent állapot módosítása</a>";
                                        echo "</td>";
                                    
                                      
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
					<a href="foglalkozas.php" class="btn btn-default pull-right">Vissza</a>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>