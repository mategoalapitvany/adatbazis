<?php
session_start();
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}?>

<!DOCTYPE html>
<html>
<head>
<title>Főoldal</title>
<link rel="stylesheet" type="text/css" href="admin1.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript" src="admin2.js"></script>

</head>
<header class="header-area overlay">
    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
			<a href="admin.php" class="navbar-brand">Matego Adatbázis</a>
            
            <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#main-nav">
                <span class="menu-icon-bar"></span>
                <span class="menu-icon-bar"></span>
                <span class="menu-icon-bar"></span>
            </button>
            
            <div id="main-nav" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li><a href="admin.php" class="nav-item nav-link active">Főodal</a></li>
					<li class="dropdown">
                        <a href="#" class="nav-item nav-link" data-toggle="dropdown">Diák</a>
                        <div class="dropdown-menu">
                            <a href="diakszer.php" class="dropdown-item">Szerkesztése</a>
                            <a href="diakstat.php" class="dropdown-item">Statisztika</a>
							<a href="evfolyamvaltas.php" class="dropdown-item">Évfolyamváltás</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="nav-item nav-link" data-toggle="dropdown">Foglalkozás</a>
                        <div class="dropdown-menu">
                            <a href="foglalkozasszer.php" class="dropdown-item">Szerkesztés</a>
                            <a href="foglalkozasgener.php" class="dropdown-item">Generálás</a>
                            <a href="foglstat.php" class="dropdown-item">Statisztika</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="nav-item nav-link" data-toggle="dropdown">Válasz</a>
                        <div class="dropdown-menu">
                            <a href="valaszszer.php" class="dropdown-item">Szerkesztés</a>
                        </div>
                    </li>
                    <li><a href="logout.php" class="nav-item nav-link">Kijelentkezés</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="banner">
        <div class="container">
            <h1>Adatbázis</h1>
            <p>Adatok könnyű kezelése az Önök kényelméért.</p>
            <a href="#content" class="button button-primary">Lásd még</a>
        </div>
    </div>
</header>

<main>
    <section id="content" class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Diákok</h3>
					<p>Ezen menüpont alatt tud hozzádani, szerekeszetni és az adatbázisból törölni diákokat . Fontos statisztikai adatokhoz juthat hozzá, melyek megkönnyítik az Ön munkáját.</p>
                </div>
                <div class="col-md-4">
                    <h3>Foglalkozás</h3>
					<p>Ezen menüpont alatt tud hozzádani, törölni és szerkeszteni foglalkozásokat. Itt tud meghívókat, egyedi url címeket lekérni a diákokhoz, melyk segítségével a diákok az adot foglalkozásokra tudnak jelentkezni.
					Emelett a regisztrációs ív, E ticket címkéhez hazsnálatos táblázat is innen tölthető le.</p>
                </div>
                <div class="col-md-4">
                    <h3>Válasz</h3>
					<p>A diákok válaszát itt lehet manuálisan szerkeszteni, illetve ezen menüpont alatt lehet bevini azt is, hogy ki vett részt az adott foglakozásokon.</p>
                </div>
            </div>
        </div>
    </section>
</main>
</html>
Resources1×0.5×0.25×Rerun