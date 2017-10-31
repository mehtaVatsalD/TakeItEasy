<?php
	include('../dbconfig.php');
	$id=$_GET['id'];
	$question=$_GET['question'];
	mysqli_query($dbase,"UPDATE `questions` SET `question`='$question' WHERE `id`='$id'");
	echo "done";
?>