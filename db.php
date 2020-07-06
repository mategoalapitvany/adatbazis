<?php
 function opendb()
 {
	 $link=mysqli_connect ("localhost", "root", "") or die ("Connection error".mysqli_error ());
	mysqli_select_db($link, "matego");
	mysqli_query($link, "set character_set_results='utf-8'");
	return $link;
	 
	 
 }

?>