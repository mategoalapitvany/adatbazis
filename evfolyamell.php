
<?php
if($_SESSION['go']!=true){
echo '<script> alert("Nem megfelelő jogosultság!"); window.location.href="index.php"</script>';}
 function evf_ell($evf)
 
 {
	 if ($evf=="3")
	 {
		 $_SESSION["evf3"]="1";
		 return;
	 }
	if ($evf=="4")
		 {
		 $_SESSION["evf4"]="1";
		 return;
	 }
	 if ($evf=="5")
		 {
		 $_SESSION["evf5"]="1";
		 return;
	 }
	  if ($evf=="6")
		{
		 $_SESSION["evf6"]="1";
		 return;
	 }
	  if ($evf=="7")
		 {
		 $_SESSION["evf7"]="1";
		 return;
	 }
	  if ($evf=="8")
		{
		 $_SESSION["evf8"]="1";
		 return;
	 }
	  if ($evf=="9")
		 {
		 $_SESSION["evf9"]="1";
		 return;
	 }
	  if ($evf=="10")
		 {
		 $_SESSION["evf10"]="1";
		 return;
	 }
	  if ($evf=="11")
		{
		 $_SESSION["evf11"]="1";
		 return;
	 }
	  if ($evf=="12")
		 {
		 $_SESSION["evf12"]="1";
		 return;
	 }
	 
	 
	 
 }
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

?>