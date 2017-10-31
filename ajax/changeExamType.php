<?php
	include('../dbconfig.php');
	$examType=$_GET['examType'];
	$colleges=mysqli_query($dbase,"SELECT `code` FROM `institutes` WHERE `type`='$examType'");
	$respCollege=array();
	while($college=mysqli_fetch_assoc($colleges))
	{
		$respCollege[count($respCollege)]=$college['code'];
	}
	if($examType=="0all")
	{
		$subjects=mysqli_query($dbase,"SELECT `code` FROM `subjects`");	
	}
	else
	{
		$subjects=mysqli_query($dbase,"SELECT `code` FROM `subjects` WHERE `type`='$examType'");	
	}
	$respSubject=array();
	$firstSubject='';
	while($subject=mysqli_fetch_assoc($subjects))
	{
		if($firstSubject=='')
			$firstSubject=$subject['code'];
		$respSubject[count($respSubject)]=$subject['code'];
	}

	if($examType=="0all")
	{
		$marks=mysqli_query($dbase,"SELECT DISTINCT `marks` FROM `questions`");
	}
	else
	{
		$marks=mysqli_query($dbase,"SELECT DISTINCT `marks` FROM `questions` WHERE `subject`='$firstSubject' ");
	}
	$respMarks=array();
	while($mark=mysqli_fetch_assoc($marks))
	{
		$respMarks[count($respMarks)]=$mark['marks'];
	}

	$response=array($respCollege,$respSubject,$respMarks);
	$response=json_encode($response);
	echo "$response";
?>