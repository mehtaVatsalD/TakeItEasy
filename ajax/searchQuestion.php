<?php
	include('../dbconfig.php');
	$data=$_GET['data'];
	$subject=$_GET['subject'];
	$examType=$_GET['examType'];
	$marks=$_GET['marks'];
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
	
	$srno=1;
	$srno2=1;
	$found=false;
	$toPrint="";
	$toPrint2="";
	while($question=mysqli_fetch_assoc($allQuestions))
	{
		if(stripos($question['question'], $data)!==false)
		{
			$found=true;
			$toPrint.="
			<tr>
				<td>$srno</td>
				<td>".$question['question']."</td>
				<td>".$question['marks']."</td>
				<td><i class='fa fa-pencil editBtnQue' onclick=\"editQuestion(event,$srno,".$question['id'].")\"></i></td>
				<td><i class='fa fa-window-close deleteBtnQue' onclick=\"deleteQuestion(event,$srno,".$question['id'].")\"></i></td>
			</tr>
			";
			$srno++;
		}
		$toPrint2.="
		<tr>
			<td>$srno2</td>
			<td>".$question['question']."</td>
			<td>".$question['marks']."</td>
			<td><i class='fa fa-pencil editBtnQue' onclick=\"editQuestion(event,$srno2,".$question['id'].")\"></i></td>
			<td><i class='fa fa-window-close deleteBtnQue' onclick=\"deleteQuestion(event,$srno2,".$question['id'].")\"></i></td>
		</tr>
		";
		$srno2++;
	}
	if($srno2==1)
	{
		$toPrint2="<tr><td colspan='5'>No Questions Found!</td></tr>";
		$toPrint="<tr><td colspan='5'>No Questions Found!</td></tr>";
	}
	if($found)
		echo "$toPrint";
	else
	{
		if($srno2!=1)
		{
			$error="<tr><td colspan='5'><span style=\"color:red\">No. Searched Question Found.Showing All Questions.</span></td></tr>";
			echo "$error"."$toPrint2";
		}
		else
			echo "$toPrint2";
	}
?>