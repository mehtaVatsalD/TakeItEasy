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
					<table align="center" cellspacing="10">
						<tr>
							<td colspan="3"><input type='text' class='searchBox' placeholder='Search Question' onkeyup="searchQuestion(this.value)"></td>
						</tr>
						<tr>
							<td><span class="labels">Institute Type</span></td>
							<td><span class="labels">Subject</span></td>
							<td><span class="labels">Marks</span></td>
						</tr>
						<tr>
							<td>
								<select name="instituteType" class="selectBox" onchange="changeExamType(this.value,true);">
									<option value="0all">All</option>
									<?php
										$examTypesAvail=mysqli_query($dbase,"SELECT DISTINCT `type` FROM `institutes` ");
										while($examTypeAvail=mysqli_fetch_assoc($examTypesAvail))
										{
											$examTypeAvail=$examTypeAvail['type'];
											echo "<option value=".$examTypeAvail.">".$examTypeCast[$examTypeAvail]."</option>";
										}
									?>
								</select>
							</td>
							<td>
								<select class="selectBox" name="subject" id="subjectBox" onchange="changeSubject(this.value,true);">
									<option value="0all">All</option>
									<?php
										$subjects=mysqli_query($dbase,"SELECT `code` FROM `subjects`");
										while($subject=mysqli_fetch_assoc($subjects))
										{
											$subject=$subject['code'];
											echo "<option value=".$subject.">".$subjectCast[$subject]."</option>";
										}
									?>	
								</select>
							</td>
							<td>
								<select class="selectBox" name="marks" id="marksBox" onchange="updateShowQuestion();">
									<option value="0all">All</option>
									<?php
										$marks=mysqli_query($dbase,"SELECT DISTINCT `marks` FROM `questions` ");
										while($mark=mysqli_fetch_assoc($marks))
										{
											$mark=$mark['marks'];
											echo "<option value=".$mark.">".$mark."</option>";
										}
									?>	
								</select>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="paperGenerater">
					<table align="center" cellspacing="10" cellpadding="10" class="editQueTable" border="1">
						<thead>
							<tr>
								<th>Sr. No.</th>
								<th>Question</th>
								<th>Marks</th>
								<th>Edit</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody id="questionsToEdit">
						<?php
							$srno=1;
							$allQuestions=mysqli_query($dbase,"SELECT `id`,`question`,`marks` FROM `questions`");
							$toPrint="";
							while($question=mysqli_fetch_assoc($allQuestions))
							{
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