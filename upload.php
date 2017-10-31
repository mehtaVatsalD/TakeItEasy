<?php
session_start();
if(!isset($_SESSION['login']))
{
	header("Location:index.php");
}
$userName=$_SESSION['login'];
include('config.php');
include('dbconfig.php');
$flash="";
if (isset($_POST['upload'])) {
	$instituteType=$_POST['instituteType'];
	$subject=$_POST['subject'];
	$question=$_POST['question'];
	$marks=$_POST['marks'];
	$id=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT MAX(`id`) FROM `tempQuestions`"));
	$id=$id['MAX(`id`)'];
	$id++;
	// mysqli_query($dbase,"INSERT INTO `questions` VALUES ('$id','$question','$marks','$subject','$instituteType')");
	mysqli_query($dbase,"INSERT INTO `tempQuestions` (`id`,`uploader`,`question`,`marks`,`subject`,`type`) VALUES ('$id','$userName','$question','$marks','$subject','$instituteType')");
	$flash="<span style='color:green;'>Successfully got your question.After Reviewing it we will add it to our database.Upload next question if you wish.</span>";
}
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
				<form action="upload.php" method="POST">
					<table cellspacing="10">
						<tr>
							<td colspan="2"><?php echo $flash ?></td>
						</tr>
						<tr>
							<td colspan="2"><span class="labels">Institute Type : </span></td>
						</tr>
						<tr>
							<td colspan="2">
								<select name="instituteType" class="selectBox" onchange="changeExamType(this.value)">
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
							<td colspan="2"><span class="labels">Question : </span></td>
						</tr>
						<tr>
							<td>
								<textarea placeholder="Write Your Question Here..." onkeyup="handleHeight(this,50)" maxlength="10000" class="questionInput" name='question'></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2"><span class="labels">Marks : </span></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="number" min="1" name="marks" class="formInput marks" placeholder="Total Marks">
							</td>
						</tr>
						<tr>
							<?php
							$block=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT `block` FROM `users` WHERE `userName`='$userName'"));
							$block=$block['block'];
							if($block==1)
							{
								echo "<td><span style='color:red;'>You are blocked by admin because of uploading invalid question.</span></td>";
							}
							else
							{
								echo "<td colspan=\"2\">
								<input type=\"submit\" name=\"upload\" value=\"Add Question\" class=\"buttons\">
							</td>";
							}
							?>
							
						</tr>
						
					</table>
				</form>
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