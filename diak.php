<!DOCTYPE html>
<?php session_start();

if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
 header("Location:admin.php");
?>



  







<