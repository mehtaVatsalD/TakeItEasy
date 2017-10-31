<?php
session_start();
if(!isset($_SESSION['login']))
{
	header("Location:index.php");
}
include('config.php');
include('dbconfig.php');
// $flash=md5("flash=true");
// if (isset($_GET[$flash])) {
// 	echo "<script>alert('Welcome to takeItEasy Question Paper Generator.You are successfully registered.Start making question papers and also contribute by adding more questions!')</script>";
// 	// header("Location:main.php");
// }
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
	<link rel="stylesheet" type="text/css" href="vendor/kendo/styles/kendo.common.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/kendo/styles/kendo.silver.min.css">

	<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="vendor/jquery/jquery-ui.min.js"></script>
	<script type="text/javascript" src="vendor/kendo/js/kendo.all.min.js"></script>
</head>
<body>
	<?php include_once('header.php'); ?>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="paperGenerater">
				<form action="generate.php" method="POST" target="_blank" onsubmit="return validateForm()">
					<table cellspacing="10">
						<tr>
							<td colspan="2"><span id="errorStatus2"></span></td>
						</tr>
						<tr>
							<td colspan="2"><span class="labels">Institute Type : </span></td>
						</tr>
						<tr>
							<td colspan="2">
								<select class="selectBox" onchange="changeExamType(this.value)">
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
						</tr>
						<tr>
							<td colspan="2"><span class="labels">Institute Name : </span></td>
						</tr>
						<tr>
							<td colspan="2">
								<select class="selectBox" name="institute" id="instituteBox">
									<?php
										$engClgs=mysqli_query($dbase,"SELECT `code` FROM `institutes` WHERE `type`=\"engineering\" ");
										while($engClg=mysqli_fetch_assoc($engClgs))
										{
											$engClg=$engClg['code'];
											echo "<option value=".$engClg.">".$clgNameCast[$engClg]."</option>";
										}
									?>	
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2"><span class="labels">Exam Name : </span></td>
						</tr>
						<tr>
							<td colspan="2"><input type="text" class="formInput" id="examName" name="examType"></td>
						</tr>
						<!-- <tr>
							<td colspan="2">
								<select class="selectBox" name="examType">
									<option value="mids">Mid Semester Examination</option>	
									<option value="ends">End Semester Examination</option>
									<option value="null">Other</option>	
								</select>
							</td>
						</tr> -->
						<tr>
							<td colspan="2"><span class="labels">Exam Date : </span></td>
						</tr>
						<tr>
							<td colspan="2"><input id="examDate" placeholder="Select Exam Date" name="examDate" value="1/1/2017"></td>
						</tr>
						<tr>
							<td><span class="labels">From : </span></td>
							<td><span class="labels">To : </span></td>
						</tr>
						<tr>
							<td><input id="examFrom" placeholder="From" name="examFrom" value="8:30 AM"></td>
							<td><input id="examTo" placeholder="To" name="examTo" value="9:30 AM"></td>
						</tr>
						<tr>
							<td colspan="2"><span class="labels">Total Marks : </span></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="number" min="1" name="totalMarks" class="formInput" placeholder="Total Marks">
							</td>
						</tr>
						<tr>
							<td colspan="2"><span class="labels">Subject : </span></td>
						</tr>
						<tr>
							<td colspan="2">
								<select class="selectBox" name="subject" id="subjectBox">
									<?php
										$subjects=mysqli_query($dbase,"SELECT `code` FROM `subjects` WHERE `type`=\"engineering\" ");
										while($subject=mysqli_fetch_assoc($subjects))
										{
											$subject=$subject['code'];
											echo "<option value=".$subject.">".$subjectCast[$subject]."</option>";
										}
									?>	
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2"><span class="labels">Paper Style : </span></td>
						</tr>
						<tr>
							<td colspan="2">
								<table class="paperStyleTable" align="center">
									<tr>
										<td colspan="5" id="errorStatus"></td>
									</tr>
									<tr>
										<th><input type="hidden" name="maxQueGone" value="0"></th>
										<th>Marks of Each Question</th>
										<th>Total No. of Questions</th>
										<th>No. of Compulsory Questions</th>
									</tr>
									<tr>
										<td><i class="fa fa-window-close rmvQueBtn" onclick="rmvQue(this.parentElement)"></i></td>
										<td><input type="number" min="1" name="mark0" class="paperInputs mark"></td>
										<td><input type="number" min="1" name="totalQue0" class="paperInputs totalQue"></td>
										<td><input type="number" min="1" name="compQue0" class="paperInputs compQue"></td>
									</tr>
									<tr>
										<td colspan="4" onclick="generatePaperForm(this.parentElement)" class="addQueBtn">Add Question</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" name="generate" target="_blank" value="Generate" class="buttons">
							</td>
						</tr>
					</table>
				</form>	
				</div>
			</div>
		</div>
	</div>

</body>
<script type="text/javascript">
	$(document).ready(function(){
		if ($("#examDate").length) {
			$("#examDate").kendoDatePicker({
				format:"d/M/yyyy",
				animation: {
			   		close: {
						effects: "fadeOut zoom:out",
						duration: 300
					},
					open: {
						effects: "fadeIn zoom:in",
						duration: 300
					}
				}
			});
		}
		$("#examFrom").kendoTimePicker();
		$("#examTo").kendoTimePicker();
	});
</script>
<script type="text/javascript" src="js/config.js"></script>
<script type="text/javascript" src="js/util.js"></script>
<script type="text/javascript" src="js/restapi.js"></script>
</html>