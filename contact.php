<?php
	session_start();
	include('dbconfig.php');
	if (isset($_POST['send'])) {
		$from=$_POST['email'];
		$subject=$_POST['subject'];
		$message=$_POST['message'];
		$message="<pre>".$message."</pre>";
		$headers="From: ".$from."\r\n";
		$headers.="Reply-To: ".$from."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$mail=mail("comebackgogo7@gmail.com", $subject, $message,$headers);
		if($mail)
		{
			$result="<span style='color:green;display:block;text-align:center;'>Successfully got your message.We will reply you soon!</span>";
		}
		else
		{
			$result="<span style='color:red;display:block;text-align:center;'>We are having some problem in sending mail.Try after some time.Sorry!</span>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Take It Easy</title>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">
	<link rel="stylesheet" href="vendor/fonts/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<?php include_once('header.php'); ?>
	<div class="container">
		<div class="row">
			<div class="col-12">
			<form action="contact.php" method="POST">
				<table class="contactTable" align="center">
					<?php
					if (isset($result)) {
						echo "<tr>
						<td>
							$result
						</td>
						</tr>";
					}
					?>
					<tr>
						<td><input type="text" name="email" class="inputs" placeholder="Enter Your Email Id"></td>
					</tr>
					<tr>
						<td><input type="text" name="subject" class="inputs" placeholder="Enter Subject of Email"></td>
					</tr>
					<tr>
						<td>
							<textarea onkeyup="handleHeight(this,50)" class="contactMessage" placeholder="Enter Your Message..." name="message"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" value="Send Messsage" name="send" class="buttons">
						</td>
					</tr>
				</table>
			</form>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript">
var validate=[
	{
		"class":"userName",
		"null": "true",
		"length":"atleast 6"
	},
	{
		"class":"password",
		"null":"true",
		"length":"atleast 6"
	},
	{
		"class":"confirmPassword",
		"null":"true",
		//"length":"atleast 6",
		"matchWith":"password,password"//class, word
	},
	{
		"class":"mail",
		"null":"true",
		"type":"mail"
	},
	// {
	// 	"class":"uploadButton",
	// 	"null":"true"
	// },
	"signupForm"
];

setValidatorFunction(validate);
</script>
</html>