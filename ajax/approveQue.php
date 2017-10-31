<?php
	include('../dbconfig.php');
	$id=$_GET['id'];
	$question=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT * FROM `tempQuestions` WHERE `id`='$id'"));
	mysqli_query($dbase,"DELETE FROM `tempQuestions` WHERE `id`='$id'");
	$marks=$question['marks'];
	$subject=$question['subject'];
	$type=$question['type'];
	$question=$question['question'];
	$id=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT MAX(`id`) FROM `questions`"));
	$id=$id['MAX(`id`)'];
	$id++;
	mysqli_query($dbase,"INSERT INTO `questions` VALUES ('$id','$question','$marks','$subject','$type')");
	echo "done";
?>