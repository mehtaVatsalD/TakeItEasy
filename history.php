<?php
session_start();
if (!isset($_SESSION['login'])) {
	header("location:index.php");
}
$userName=$_SESSION['login'];
include('dbconfig.php');
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>History</title>
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
	<?php include('header.php'); ?>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1 style="text-align: center; color: #333;">History</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-12 historyDiv">
				<table cellspacing="4" align="center">
					<thead>
						<tr>
							<th>Sr. No.</th>
							<th>Exam Name</th>
							<th>Institute</th>
							<th>Subject</th>
							<th>Exam Date</th>
							<th>From</th>
							<th>To</th>
							<th>Total Marks</th>
							<th>Created On</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$papers=mysqli_query($dbase,"SELECT * FROM `questionpapers` WHERE `userName`='$userName' ORDER BY `createdOn` DESC");
							$srno=1;
							$foundRecord=false;
							while($paper=mysqli_fetch_assoc($papers))
							{
								$foundRecord=true;
								$toPrint="
								<tr>
									<td>".$srno."</td>
									<td>".$paper['examName']."</td>
									<td>".$clgNameCast[$paper['institute']]."</td>
									<td>".$subjectCast[$paper['subject']]."</td>
									<td>".$paper['examDate']."</td>
									<td>".$paper['fromTime']."</td>
									<td>".$paper['toTime']."</td>
									<td>".$paper['totalMarks']."</td>
									<td>".$paper['createdOn']."</td>
									<td><a href=\"history/".$userName."/".$paper['id'].$userName.".pdf\" target='_blank'>View</a></td>
								</tr>
								";
								echo $toPrint;
								$srno++;
							}
							if(!$foundRecord)
							{
								echo "<td colspan='10'>No papers made by you!</td>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>