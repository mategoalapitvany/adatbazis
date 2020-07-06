<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
if(isset($_POST["id"]) && !empty($_POST["id"])){
include 'db.php';
$link=opendb();

$sql= "SELECT * from diak";
$result=mysqli_query($link, $sql);
while($row = mysqli_fetch_array($result))
	 {
		 
		 $evf=$row['evfolyam']+"1";
		  $sql2 = "UPDATE diak SET evfolyam=" . $evf . " WHERE id=" . $row['id'];
			mysqli_query($link, $sql2);
			
		 
		 
	 }
	 //header("Location: admin.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Évfolyamváltás</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Évfolyamváltás</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Biztosan meg szeretné növelni az ÖSSZES diák évfolyamát eggyel?</p><br>
                            <p>
                                <input type="submit" value="Igen" class="btn btn-danger">
                                <a href="admin.php" class="btn btn-default">Nem</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>