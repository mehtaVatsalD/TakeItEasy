<?php
session_start();
include_once('dbconfig.php');
if (!isset($_SESSION['login'])) {
	header("Location:index.php");
}
$userName=$_SESSION['login'];
$vercode=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT `verified` FROM `users` WHERE `userName`='$userName'"));
$vercode=$vercode['verified'];
if($vercode=="verified")
{
	header("Location:main.php");
}
if (isset($_POST['verify'])) {
	$code=$_POST['code'];
	if($code==$vercode)
	{
		mysqli_query($dbase,"UPDATE `users` SET `verified`='verified' WHERE `userName`='$userName'");
		header("Location:main.php");
	}
	else
	{
		$errorLog="<span style='color:red; display:block; text-align: center;'>Haha! We are not dumb...your code's incorrect.</span>";
	}
}
if (isset($_POST['resend'])) {
	$mail=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT `mail` FROM `users` WHERE `userName`='$userName'"));
	$mail=$mail['mail'];

	// $vercode="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	// $vercode=str_shuffle($vercode);
	// $vercode=substr($vercode,0,8);
	// mysqli_query($dbase,"UPDATE `users` SET `verified`='$vercode' WHERE `userName`='$userName'");
	$subject = 'Verification for BlogFlog';
	$headers = "From: admin@blogflog.com\r\n";
	$headers .= "Reply-To: comebackgogo7@gmail.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	mail($mail,$subject, "Your verification code is $vercode.<br><br>Regards,<br>Team BlogFlog",$headers);
	$errorLog="<span style='color:green; display:block; text-align: center;'>Successfully resent verification code...</span>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Take It Easy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">
	<link rel="stylesheet" href="vendor/fonts/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<?php include_once('header.php'); ?>
	<div class="container">
		<div>
			<form class="verifyForm" method="POST" action="verifyUser.php">
				<table class="verifyTable" align="center">
					<tr>
						<td colspan="2">
							<?php
								if (isset($errorLog)) {
									echo "$errorLog";
								}
							?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<span>We have sent you mail to verify.Enter code sent to you via mail.</span>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="text" name="code" class="inputs vercode" placeholder="Enter Verification Code">
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" class="buttons" name="verify">
						</td>
					</tr>
				</table>
			</form>
			<form method="POST" action="verifyUser.php">
				<table class="verifyTable" align="center">
					<tr>
						<td>Want Verification code Again?</td>
						<td>
							<button type="submit" class="buttons" name="resend">Resend</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript">
var validate=[
	{
		"class":"vercode",
		"null": "true",
		"length":"equals 8"
	},
	"verifyForm"
];

setValidatorFunction(validate);
</script>
</body>
</html>