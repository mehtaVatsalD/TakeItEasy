<?php
session_start();
if(!isset($_SESSION['login']) || !isset($_POST['examType']))
{
	header("location:index.php");
}
$userName=$_SESSION['login'];
require('vendor/fpdf/fpdf.php');
include('config.php');
include('dbconfig.php');

$institute=$_POST['institute'];
$examType=$_POST['examType'];
$examDate=$_POST['examDate'];
$examFrom=$_POST['examFrom'];
$examTo=$_POST['examTo'];
$totalMarks=$_POST['totalMarks'];
$subject=$_POST['subject'];

$id=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT MAX(`id`) FROM `questionpapers`"));
$id=$id['MAX(`id`)'];
$id++;
mysqli_query($dbase,"INSERT INTO `questionpapers` (`id`,`userName`,`examName`,`institute`,`examDate`,`fromTime`,`toTime`,`totalMarks`,`subject`) VALUES ('$id','$userName','$examType','$institute','$examDate','$examFrom','$examTo','$totalMarks','$subject') ");
$documentName=$id.$userName;

$diffQueAvail=mysqli_query($dbase,"SELECT DISTINCT `marks` FROM `questions` WHERE `subject`='$subject'");
$hashes=array();
while($markQue=mysqli_fetch_assoc($diffQueAvail))
{
	$markQue=$markQue['marks'];
	$totalQuestions=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT COUNT(`id`) FROM `questions` WHERE `subject`='$subject' AND `marks`='$markQue'"));
	$totalQuestions=$totalQuestions['COUNT(`id`)'];
	$hashes[$markQue]=array_fill(0, $totalQuestions, 0);
}

// print_r($hashes);

class PDF extends FPDF
{
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Times italic 8
    $this->SetFont('Times','I',8);
    // Page number
    $this->Cell(1,10,'Page '.$this->PageNo().'/{nb}',0,0,'L');
    // $this->Cell(0,10,'takeiteasy.com',0,0,'C');
    $this->Cell(0,10,'Paper By: Vatsal Mehta-Jasmin Nasit',0,0,'R');
}
}


// switch ($institute) {
// 	case "svnit":
// 		$institute="Sardar Vallabhbhai National Institute of Technology";
// 		break;
// 	case "nirma":
// 		$institute="Nirma Institute of Technology";
// 		break;
// 	default:
// 		$institute="Default Institute";
// 		break;
// }

// switch ($subject) {
// 	case "daa":
// 		$subject="Design and Analysis of Algorithms";
// 		break;
// 	case "mit":
// 		$subject="Microprocessor and Interfacing Techniques";
// 		break;
// 	default:
// 		$subject="";
// 		break;
// }

// switch ($examType) {
// 	case 'mids':
// 		$examType="Mid Semester Examination";
// 		break;
// 	case 'ends':
// 		$examType="End Semester Examination";
// 		break;
// 	default:
// 		$examType="General Test";
// 		break;
// }

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle('Question Paper');
$pdf->SetFont('Times','B',20);
$pdf->Cell(0,10,$clgNameCast[$institute],0,1,'C');

$pdf->SetFont('Times','B',16);
$pdf->Cell(0,10,$subjectCast[$subject],0,1,'C');

$pdf->SetFont('Times','',15);
$pdf->Cell(0,10,$examType,0,1,'C');

$pdf->SetFont('Times','B',12);
$pdf->Cell(26,10,"Exam Date : ",0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,10,$examDate,0,0);

$pdf->SetFont('Times','B',12);
$pdf->Cell(26,10,"Exam Time : ",0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(56,10,$examFrom." to ".$examTo,0,0);

$pdf->SetFont('Times','B',12);
$pdf->Cell(28,10,"Total Marks : ",0,0);
$pdf->SetFont('Times','',12);
$pdf->Cell(35,10,$totalMarks,0,1);

$pdf->SetFont('Times','B',12);
$pdf->Cell(26,10,"Instructions : ",0,1);
$pdf->SetFont('Times','',12);
$pdf->Cell(26,5,"1. Write your roll no. and other necessary details clearly on Answer book and Question Paper.",0,1,'L');
$pdf->Cell(26,5,"2. Assume necessary data but give proper justification.",0,1,'L');
$pdf->Cell(26,5,"3. Be precise and clear in answering all questions.",0,1,'L');
$pdf->Cell(26,5,"4. Figure to the right indicate full marks of that question.",0,1,'L');
$pdf->Cell(26,5,"5. Please start answer to new question on new page.",0,1,'L');
$pdf->Line(10, 90, 200, 90);
$pdf->Ln();
$pdf->Ln();
// $pdf->SetFont('Times','B',15);
$j=1;
for($i=0;$i<=$_POST['maxQueGone'];$i++)
{
	if (isset($_POST['mark'.$i])) {
		$marks=$_POST['mark'.$i];
		$totalQue=$_POST['totalQue'.$i];
		$compQue=$_POST['compQue'.$i];
		$totalMarks=(int)$marks*(int)$compQue;
		$pdf->SetFont('Times','B',15);
		$pdf->Cell(62,10,"Q-".$j."  Answer the Following",0,0,'L');
		if($totalQue>$compQue)
			$pdf->Cell(0,10,"[Any ".$compQue."]",0,0,'L');
		$pdf->Cell(0,10,"[$totalMarks]",0,1,'R');
		$j++;

		$pdf->SetFont('Times','',12);
		$questionSelected=getRandomQuestions($marks,$totalQue);
		$l='1';
		for($k=0;$k<$totalQue;$k++)
		{
			$pdf->Cell(5,5);
			$pdf->MultiCell(0,5,$l.")  ".$questionSelected[$k],0,'L',false);
			$pdf->Ln(1);
			$l++;
		}
		
	}
}

$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Times','BIU',12);
$pdf->Cell(0,10,"ALL THE BEST!",0,1,'C');

// $pdf->Output('I','doc.pdf');

$pdf->Output('history/'.$userName.'/'.$documentName.'.pdf','F');
$pdf->Output('I','doc.pdf');


function getRandomQuestions($marks,$noofque)
{
	global $subject,$dbase,$hashes;
	// $totalQuestions=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT COUNT(`id`) FROM `questions` WHERE `subject`='$subject' AND `marks`='$marks'"));
	// $totalQuestions=(int)$totalQuestions['COUNT(`id`)'];
	$questions=mysqli_query($dbase,"SELECT `question` FROM `questions` WHERE `subject`='$subject' AND `marks`='$marks'");
	$dataBaseQue=array();
	while($question=mysqli_fetch_assoc($questions))
	{
		$dataBaseQue[count($dataBaseQue)]=$question['question'];
	}
	$questionSelected=array();
	for($i=0;$i<$noofque;$i++)
	{
		$rand=rand(0,count($hashes[$marks])-1);
		if($hashes[$marks][$rand]==1)
		{
			$i--;
			continue;
		}
		else
		{
			$questionSelected[$i]=$dataBaseQue[$rand];
			$hashes[$marks][$rand]=1;
		}
	}
	return $questionSelected;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ok</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>

</body>
</html>