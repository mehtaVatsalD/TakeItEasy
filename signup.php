<?php
session_start();
include_once('dbconfig.php');
if(isset($_SESSION['login']))
{
	header("Location:main.php");
}
if(isset($_POST['signup']))
{
	$userName=$_POST['userName'];
	$existing=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT `userName` FROM `users` WHERE `userName`='$userName'"));
	if($existing=="")
	{
		$password=$_POST['password'];
		$password=md5($password);
		$mail=$_POST['mail'];
		$id=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT max(`id`) FROM `users`"));
		$id=$id['max(`id`)'];
		$id=$id+1;
		if($_FILES['propic']['tmp_name']!='')
		{
			$location='propics/';
			$tmpName=$_FILES['propic']['tmp_name'];
			$name=$_FILES['propic']['name'];
			$name=explode('.', $name);
			$name=$name[count($name)-1];
			$name=$userName.'.'.$name;
			move_uploaded_file($tmpName,$location.$name);
		}
		else
		{
			$name='default.png';
		}
		$vercode="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$vercode=str_shuffle($vercode);
		$vercode=substr($vercode,0,8);
		mysqli_query($dbase,"INSERT INTO `users` VALUES ('$id','$userName','$password','$mail','$name','','$vercode')");
		mkdir('history/'.$userName);

		$subject = 'Verification for BlogFlog';

		$headers = "From: admin@blogflog.com\r\n";
		$headers .= "Reply-To: comebackgogo7@gmail.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($mail,$subject, "Your verification code is $vercode.<br><br>Regards,<br>Team BlogFlog",$headers);
		$_SESSION['login']=$userName;	
		header("Location:verifyUser.php");
	}
	else
	{
		$errorLog="<span style='color:red; display:block; text-align: center;'>Such User Name already exists!</span>";
		
	// $_SESSION['login']=$userName;
	// header("Location:index.php");
	}
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
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
	<?php include_once('header.php'); ?>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="signup">
					<?php
						if(isset($errorLog))
							echo "$errorLog";
					?>
					<form method="POST" action="signup.php" class="signupForm" enctype="multipart/form-data">
						<table border="0">
							<tr>
								<td>
									<i class="fa fa-user fontIcons"></i>
								</td>
								<td>
									<input type="text" name="userName" class="inputs userName" placeholder="Enter User Name">
								</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-lock fontIcons"></i>
								</td>
								<td>
									<!-- <span class="error">Enter Password</span> -->
									<input type="password" name="password" class="inputs password" placeholder="Enter Password">
								</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-lock fontIcons"></i>
								</td>
								<td>
									<input type="password" name="confirmPassword" class="inputs confirmPassword" placeholder="Confirm Password">
								</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-envelope fontIcons"></i>
								</td>
								<td>
									<input type="text" name="mail" class="inputs mail" placeholder="Enter E-mail Id">
								</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-picture-o fontIcons"></i>
								</td>
								<td>
									<div class="uploadDiv">
										Upload Profile Picture
										<input type="file" accept=".jpg,.jpeg,.png" name="propic" class="uploadButton" onchange="readURL(this)">
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<img src="propics/default.png" id="showProPic">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="submit" name="signup" class="buttons" value="Sign Up">
								</td>
							</tr>
						</table>
					</form>
				</div>
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