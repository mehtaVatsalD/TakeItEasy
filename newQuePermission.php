<?php
session_start();
include('config.php');
if(!isset($_SESSION['login']) && $_SESSION['login']!=$adminName)
{
	header("Location:index.php");
}
include('dbconfig.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Take It Easy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">
	<link rel="stylesheet" href="vendor/fonts/css/font-awesome.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css">

</head>
<body>
	<?php include_once('header.php'); ?>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="paperGenerater">
					<table align="center" cellspacing="10" cellpadding="10" class="editQueTable" border="1">
						<thead>
							<tr>
								<th>Sr. No.</th>
								<th>Question</th>
								<th>Uploader</th>
								<th>Marks</th>
								<th>Subject</th>
								<th>Approve</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody id="questionsToEdit">
						<?php
							$srno=1;
							$allQuestions=mysqli_query($dbase,"SELECT `id`,`uploader`,`question`,`marks`,`subject` FROM `tempQuestions` ORDER BY `time` ASC");
							$toPrint="";
							while($question=mysqli_fetch_assoc($allQuestions))
							{
								$toPrint.="
								<tr>
									<td>$srno</td>
									<td>".$question['question']."</td>
									<td>".$question['uploader']."</td>
									<td>".$question['marks']."</td>
									<td>".$subjectCast[$question['subject']]."</td>
									<td><i class='fa fa-check approvBtnQue' onclick=\"approveQue(event,$srno,".$question['id'].")\"></i></td>
									<td><i class='fa fa-window-close deleteBtnQue' onclick=\"deleteQuestion(event,$srno,".$question['id'].",true)\"></i></td>
								</tr>
								";
								$srno++;
							}
							if($srno==1)
								$toPrint="<tr><td colspan='6'>No New Questions to Approve</td></tr>";
							echo $toPrint;
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</body>
<script type="text/javascript" src="js/config.js"></script>
<script type="text/javascript" src="js/util.js"></script>
<script type="text/javascript" src="js/restapi.js"></script>
</script>
</html>