<?php
	include('../dbconfig.php');
	$subject=$_GET['subject'];
	$examType=$_GET['examType'];
	if($subject=="0all" && $examType=="0all")
	{
		$marks=mysqli_query($dbase,"SELECT DISTINCT `marks` FROM `questions`");
	}
	else if($examType!="0all" && $subject=="0all")
	{
		$marks=mysqli_query($dbase,"SELECT DISTINCT `marks` FROM `questions` WHERE `type`='$examType' ");
	}
	else
	{
		$marks=mysqli_query($dbase,"SELECT DISTINCT `marks` FROM `questions` WHERE `subject`='$subject' ");
	}
	$respMarks=array();
	while($mark=mysqli_fetch_assoc($marks))
	{
		$respMarks[count($respMarks)]=$mark['marks'];
	}
	$response=json_encode($respMarks);
	echo "$response";
?>