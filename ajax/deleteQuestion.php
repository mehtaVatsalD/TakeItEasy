<?php
	include('../dbconfig.php');
	$id=$_GET['id'];
	mysqli_query($dbase,"DELETE FROM `questions` WHERE `id`='$id'");
	echo "done";
?>