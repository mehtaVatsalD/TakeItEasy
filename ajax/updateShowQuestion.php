<?php
	include('../dbconfig.php');
	$subject=$_GET['subject'];
	$examType=$_GET['examType'];
	$marks=$_GET['marks'];
	$questionResp=array();
	$marksResp=array();
	$idResp=array();
	if($subject=="0all" && $examType=="0all" && $marks=="0all")
	{
		$allQuestions=mysqli_query($dbase,"SELECT `id`,`question`,`marks` FROM `questions`");
	}
	else if ($examType=="0all" && $subject=="0all" && $marks!="0all") 
	{
		$allQuestions=mysqli_query($dbase,"SELECT `id`,`question`,`marks` FROM `questions` WHERE `marks`='$marks'");
	}
	else if (($examType=="0all" && $subject!="0all" && $marks=="0all") || ($examType!="0all" && $subject!="0all" && $marks=="0all")) {
		$allQuestions=mysqli_query($dbase,"SELECT `id`,`question`,`marks` FROM `questions` WHERE `subject`='$subject'");
	}
	else if (($examType=="0all" && $subject!="0all" && $marks!="0all") || ($examType!="0all" && $subject!="0all" && $marks!="0all")) {
		$allQuestions=mysqli_query($dbase,"SELECT `id`,`question`,`marks` FROM `questions` WHERE `subject`='$subject' AND `marks`='$marks'");
	}
	else if ($examType!="0all" && $subject=="0all" && $marks=="0all") 
	{
		$allQuestions=mysqli_query($dbase,"SELECT `id`,`question`,`marks` FROM `questions` WHERE `type`='$examType'");
	}
	else if ($examType!="0all" && $subject=="0all" && $marks!="0all") 
	{
		$allQuestions=mysqli_query($dbase,"SELECT `id`,`question`,`marks` FROM `questions` WHERE `type`='$examType' AND `marks`='$marks'");
	}
	while($question=mysqli_fetch_assoc($allQuestions))
	{
		$questionResp[count($questionResp)]=$question['question'];
		$marksResp[count($marksResp)]=$question['marks'];
		$idResp[count($idResp)]=$question['id'];
	}
	$response=array($questionResp,$marksResp,$idResp);
	$response=json_encode($response);
	echo "$response";
?>