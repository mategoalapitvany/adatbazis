<?php session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}?>

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
                    include "db.php";
                    $link=opendb();
                    // Attempt select query execution
                    $sql = "SELECT * FROM foglalkozas  ORDER BY datum";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
										echo "<th>Név</th>";
                                        echo "<th>Dátum</th>";
										echo"<th>Műveletek</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['nev'] . "</td>";
                                        echo "<td>" . $row['datum'] . "</td>";

                                        echo "<td>";
                                            echo "<a href='freszstat.php?id=". $row['id'] ."' title='Részvételi statisztika' data-toggle='tooltip'>Részvételi statisztika<br>\n</a>";
                                            echo "<a href='tavolstat.php?id=". $row['id'] ."' title='Távolmaradási staztisztika' data-toggle='tooltip'>Távolmaradási staztisztika<br>\n</a>";
											 echo "<a href='nemvalazsolo.php?id=". $row['id'] ."' title='Nem válaszoló staztisztika' data-toggle='tooltip'>Nem válaszoló staztisztika<br>\n</a>";
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