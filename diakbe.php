
<?php session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}?>

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
		include 'db.php';
		include 'testinput.php';
		$link =opendb();
		$suli=mysqli_query($link, "SELECT id, nev FROM iskola"); 
		$tanar=mysqli_query($link, "SELECT id, nev, iskola_id FROM iskolai_tanar");
		 $vnevErr = $knevErr = $evfErr = $tanarErr = $lakhelyErr = $emailErr = $telErr =$palyazatErr = $valasztoErr = $ujiskolaErr =$email2Err="";
		 		 
		if ($_SESSION['proba']=="1" and !empty($_SESSION['proba']))
		{
		
			$vnev=$_SESSION['vnev'];$knev = $_SESSION['knev'];$mknev = $_SESSION['mknev'];$evf = $_SESSION['evf'];$valaszto= $_SESSION['valaszto'];$ujiskola = $_SESSION['ujiskola'];$tanar =$_SESSION['tanar'];
			$lakhely = $_SESSION['lakhely']; $email1 = $_SESSION['email1'];$email2 =$_SESSION['email2']; $tel1 = $_SESSION['tel1'];$tel2 = $_SESSION['tel2'];$palyazat = $_SESSION['palyazat'];$eredmeny =$_SESSION['eredmeny'];$iskola	=$_SESSION["iskola"];		
		}else{
		$vnev=$knev = $mknev = $evf = $valaszto= $ujiskola = $tanar = $lakhely = $email1 = $email2 = $tel1 = $tel2 = $palyazat = $eredmeny = "";
		}
		$eredmenyErr = "3 legjobb egyéni eredmény!";
		$valid=false;
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$valid=true;
			if (empty($_POST["vnev"])) {
				$vnevErr = "Vezetéknév megadása kötelező!";
				$valid=false;
				} else {
					$vnev=test_input($_POST["vnev"]);
					$_SESSION["vnev"]=$vnev;
				}
			if (empty($_POST["knev"])) {
				$knevErr = "Keresztnév megadása kötelező!";
				$valid=false;
				} else {
					$knev=test_input($_POST["knev"]);
					$_SESSION["knev"]=$knev;
				}
			$mknev=test_input($_POST["mknev"]);
			$_SESSION["mknev"]=$mknev;
			if (empty($_POST["evf"])) {
				$evfErr = "Évfolyam megadása kötelező!";
				$valid=false;
				} else {
					$evf=test_input($_POST["evf"]);
					$_SESSION["evf"]=$evf;
				}
			if (empty($_POST["valaszto"])) {
				$valasztoErr = "Válasszon egy iskolát vagy adjon meg új intézményt";
				$valid=false;
				} else {
					$valaszto=test_input($_POST["valaszto"]);
					$_SESSION["valaszto"]=$valaszto;
					if($valaszto==2 and empty($_POST["ujiskola"]))
					{
						$ujiskolaErr="Kérem adja meg az új iskola nevét!";
						$valid=false;
					}else{
						$ujiskola=test_input($_POST["ujiskola"]);
						$_SESSION["ujiskola"]=$ujiskola;
					}
					if($valaszto==1 and $_POST["iskola"]==0){
						$valasztoErr = "Válasszon egy iskolát vagy adjon meg új intézményt";
						$valid=false;
					}else{
						$iskola=test_input($_POST["iskola"]);
						$_SESSION["iskola"]=$iskola;
					}
						
				}
			if (empty($_POST["tanar"])) {
				$tanarErr = "Tanár megadása kötelező!";
				$valid=false;
				} else {
					$tanar=test_input($_POST["tanar"]);
					$_SESSION["tanar"]=$tanar;
				}
			if (empty($_POST["lakhely"])) {
				$lakhelyErr = "Település megadása kötelező!";
				$valid=false;
				} else {
					$lakhely=test_input($_POST["lakhely"]);
					$_SESSION["lakhely"]=$lakhely;
				}
				
			if (empty($_POST["email1"])) {
				$emailErr = "Egy e-mail cím megadása kötelező!";
				$valid=false;
				} else {
					$email1=test_input($_POST["email1"]);
					if(!filter_var($email1, FILTER_VALIDATE_EMAIL)){
					$emailErr = "Hibás formátum!";
					$valid=false;}
					else{
						$_SESSION["email1"]=$email1;
					}
				}
				if (!empty($_POST["email2"])) {
				 
					$email2=test_input($_POST["email2"]);
					if(!filter_var($email2, FILTER_VALIDATE_EMAIL)){
					$email2Err = "Hibás formátum!";
					$valid=false;}
					else{
						$_SESSION["email2"]=$email2;
					}
				}
			$email2=test_input($_POST["email2"]);
			$_SESSION["email2"]=$email2;
			if (empty($_POST["tel1"])) {
				$telErr = "Egy telefonszám cím megadása kötelező!";
				$valid=false;
				} else {
					$tel1=test_input($_POST["tel1"]);
					if (!preg_match('~^\+36-\d{2}-\d{3}-\d{2}\d{2}$~', $tel1)){
					$telErr = "Hibás formátum!";
					$valid=false;}
					else{
						$_SESSION["tel1"]=$tel1;
					}
				}
		
		$tel2=test_input($_POST["tel2"]);
		$_SESSION["tel2"]=$tel2;
		if (empty($_POST["eredmeny"])) {
				$eredmenyErr = "Eredmenyek megadása kötelező!";
				$valid=false;
				} else {
					$eredmeny=test_input($_POST["eredmeny"]);
					$_SESSION["eredmeny"]=$eredmeny;
				}
		if (empty($_POST["palyazat"])) {
			echo "bent vagyok";
				$palyazatErr = "Kérem válasszon!";
				$valid=false;
				} else {
					$palyazat=test_input($_POST["palyazat"]);
					if ($palyazat=="2")
					{
						echo "vagyok";
						$palyazatErr = "Kérem válasszon!";
						$valid=false;
					}
					else{
					$_SESSION["palyazat"]=$palyazat;
					}
					
				}
		
		}

		?>
		
		<?php if($valid==true): ?>
		<?php $_SESSION['proba']="1";?>
			<html>
				<body>
					<div class="wrapper">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<div class="page-header">
										<h1>Adatok megerősítése:</h1>
									</div>
									<div class=".progress-striped .progress-bar">
										<h4>Név:  <?php echo $vnev; echo " "; echo $knev; echo " "; echo $mknev;?> </h4>
										<h4>Évfolyam: <?php echo $evf;?></h4>
										<h4>E-mail elsődleges: <?php echo $email1;?></h4>
										<h4>Telefonszám elsődleges: <?php echo $tel1;?></h4>
										 <p>
                                <a name ="yes" value="1" href="diakhozza.php" class="btn btn-success">Egyeznek az adatok.</a> <a href="diakbe.php" class="btn btn-danger">Módosítani szeretnék</a>
                            </p>
									</div>
								</div>
							</div>        
						</div>
					</div>
				</body>
			</html>

		
		<?php endif; ?>
<?php if($valid==false):?>
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
		
		

						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						
					
							<span class="error">* <?php echo "Kötelező mezők";?></span>
							<h3>
								Vezetéknév: </h3> <input class="form-control" type="text" name="vnev" value="<?php echo $vnev?>"/>  <span class="error">* <?php echo $vnevErr;?></span>  
								

							
							<h3>
								Keresztnév:</h3> <input class="form-control" type="text" name="knev" value="<?php echo $knev;?>"/>  
								<span class="error">* <?php echo $knevErr;?></span>
							
							<h3>
								Második Keresztnév: </h3><input class="form-control" type="text" name="mknev" value="<?php echo $mknev;?>"/>    
							
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
							
							
							<h3>Iskola neve:</h3> <br />
								<input name="valaszto" type="radio" value="1" /> Már regisztrált iskola:
								<select class="form-control" name="iskola" size=”1” required>
									<option value="0" selected>Kérem válaszon</option>
									<?php while ($row = mysqli_fetch_array($suli)) : ?>
									<option value="<?php echo $row['id']; ?>"><?php echo $row['nev']; ?></option>
									<?php endwhile; ?>

								</select>
								<span class="error">* <?php echo $valasztoErr;?></span>
								<br />
								<input name="valaszto" type="radio" value="2" />Új iskola <input  class="form-control" type="text" name="ujiskola" value="<?php echo $ujiskola;?>" /><span class="error">* <?php echo $ujiskolaErr;?></span>
							
							<h3>
								Felkészítő tanár:</h3> <input class="form-control" type="text" name="tanar" value="<?php echo $tanar;?>"/>  
								<span class="error">* <?php echo $tanarErr;?></span>				
							
							<h3>
								Lakhely: </h3><input class="form-control" type="text" name="lakhely" value="<?php echo $lakhely;?>"/>  
								<span class="error">* <?php echo $lakhelyErr;?></span>				
							
							<h3>
								Elsőszámú e-mail:</h3> <input class="form-control" type="text" name="email1" value="<?php echo $email1;?>" /> 
								<span class="error">* <?php echo $emailErr;?></span>
							
							
							<h3>
								Másodikszámú e-mail:</h3> <input class="form-control" type="text" name="email2" value="<?php echo $email2;?>"/>
								<span class="error"> <?php echo $email2Err;?></span>
							
							<h3>
								Elsőszámú telefon: </h3>(+36-xx-xxx-xxxx): <input class="form-control" type="text" name="tel1"  value="<?php echo $tel1;?>" />   
								<span class="error">* <?php echo $telErr;?></span>
							
							
							<h3>
								Másodikszámú telefon: </h3> <input class="form-control" type="text" name="tel2" value="<?php echo $tel2;?>"/>    
							
							<h3>
								Versenyeredmények:
							</h3>
							<textarea class="form-control" cols="64" name="eredmeny" rows="5" ><?php echo $eredmeny;?></textarea>
							<span class="error">* <?php echo $eredmenyErr;?></span>
							<h3>
							Pályázat:
							</h3>
							<select class="form-control" name="palyazat" size=”1”>
								<option value="3">Nem</option>
								<option value="1">igen</option>
								<option value="2" selected>Kérem válaszon</option>
							</select>
							<span class="error">* <?php echo $palyazatErr;?></span>
							
							
								
							
							<br></br>
							<input type="submit" class="btn btn-primary" value="Elküld" name="uj" />  <a  class="btn btn-default" href="diakszer.php">Vissza</a>
						</form>
                </div>
            </div>        
        </div>
    </div>
		
		
    </body>




   
   </html>
   
   <?php endif;?>