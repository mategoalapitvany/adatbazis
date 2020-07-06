<?php

if (isset($_GET["token"]) && preg_match('/^[0-9A-F]{40}$/i', $_GET["token"])) {
    $token= $_GET["token"];
	$url = "http://localhost/h%C3%A1zi/activate.php?token=" . $token;
		include 'db.php';
		$link =opendb();
		$keres="SELECT * FROM valasz WHERE token = '" . $token . "'";
		$valasz=mysqli_query($link, $keres);
		$row = mysqli_fetch_array($valasz);
		$did=$row['diak_id'];
		$fid=$row['foglalkozas_id'];
		if ($row==NULL)
			{echo '<script> alert("Nem valós vagy már használt URL."); window.location.href="http://matego.eu/"</script>';
			}
			// Check to see if link has expired
			$delta = 345600; // 4*60*60*24
		if ($_SERVER["REQUEST_TIME"] - $row['tstamp']> $delta) {
			echo '<script> alert("Nem valós vagy már használt URL."); window.location.href="http://matego.eu/"</script>';
		
		}
}
else {
	if ($_SESSION)
   echo '<script> alert("Nem valós vagy már használt URL."); window.location.href="http://matego.eu/"</script>';
   
}




?>
<!DOCTYPE html>
<html>
    
   <head>
    <meta charset="UTF-8">
    <title>Regisztráció</title>
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
    
    
    
	<style>.error {color: #FF0000;} </style>
</html>
<?php
		$megj="";
		 $megjErr= "Pl.: Kések, várhatóan kilenc órára érkezem.";
		 $valaszErr="";
		 $valid=false;
		 echo $valid;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
				include 'testinput.php';
				$valid=true;
				$megj=test_input($_POST["megj"]);
			if (empty($_POST["valasz"])) {
				$valaszErr = "Kérem válasszon!";
				$valid=false;
				} else {
					$valasz=test_input($_POST["valasz"]);
					if ($valasz=="2")
					{
						$palyazatErr = "Kérem válasszon!";
						$valid=false;
					}
					
				}
		
		}
				if ($valid==true)
		{
			$token=NULL;
			
			if ($valasz=="3")
			{$valasz1="0";}else{$valasz1="1";}
			$sql = "UPDATE valasz SET valasz=" . $valasz1 . ", megjelent=" . $valasz1 . ", megjegyzes='" .$megj. "', token='" .$token. "', tstamp='" .$token. "' WHERE diak_id = " . $did . " AND foglalkozas_id=" .$fid;
			mysqli_query($link, $sql);		
			echo '<script> alert("Sikeres visszajelzés."); window.location.href="http://matego.eu/"</script>';
			
			
		}
			
		
		
// do one-time action here, like activating a user account
// ...

// delete token so it can't be used again

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
                    <p>Kérem figyelmesen töltse ki az alábbi mezőket!</p>
		
		

						<form method="post" action="<?php echo $url;?>">
						
					
							<span class="error">* <?php echo "Kötelező mezők";?></span>
							<h3>
							Résztveszek a foglalkozáson:
							</h3>
							<select class="form-control" name="valasz" size=”1”>
								<option value="3" >Nem</option>
								<option value="1">igen</option>
								<option value="2" selected>Kérem válaszon</option>
							</select>
							<span class="error">* <?php echo $valaszErr;?></span>
							 <h3>
								Megjegyzés </h3> <input class="form-control" type="text" name="megj" value="<?php echo $megj?>"/> <span ><?php echo $megjErr;?></span></span>  
							
							
							
							<br></br>
							<input type="submit" class="btn btn-primary" value="Elküld" name="uj" /> 
						</form>
                </div>
            </div>        
        </div>
    </div>
		
		
    </body>