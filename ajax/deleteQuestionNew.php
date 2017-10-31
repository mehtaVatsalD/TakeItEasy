<?php
	include('../dbconfig.php');
	$id=$_GET['id'];
	mysqli_query($dbase,"DELETE FROM `tempQuestions` WHERE `id`='$id'");
	echo "done";
?>