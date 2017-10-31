<?php
session_start();
if(isset($_SESSION['login']))
{
	$userName=$_SESSION['login'];
	$result="<span class='notice' style='color:green;'>Successfully Logged In!</span>";
	header("location:main.php");
}
else
{
	include_once('dbconfig.php');
	$result="";
	$userName="";
	if (isset($_POST['login'])) {
		$userName=$_POST['userName'];
		$password=$_POST['password'];
		$password=md5($password);
		$user=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT `userName`,`password` FROM `users` WHERE `userName`='$userName'"));
		if($user==""){
			$result="<span class='notice'>User not found! <a href='signup.php'>Sign Up Here</a></span>";
		}
		else {
			$dbasePassword=$user['password'];
			if($dbasePassword!=$password){
				$result="<span class='notice'>Incorrect Password!</span>";
			}
			else
			{
				$result="<span class='notice' style='color:green;'>Successfully Logged In!</span>";
				$_SESSION['login']=$userName;
				header("location:main.php");
			}
		}
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
				<div class="login">
					<?php echo $result; ?>
					<form method="POST" action="index.php" class="loginForm">
						<table border="0">
							<tr>
								<td>
									<i class="fa fa-user fontIcons"></i>
								</td>
								<td>
									<input type="text" name="userName" class="inputs userName" placeholder="Enter User Name" value=<?php echo $userName ?>>
								</td>
							</tr>
							<tr>
								<td>
									<i class="fa fa-lock fontIcons"></i>
								</td>
								<td>
									<input type="password" name="password" class="inputs password" placeholder="Enter Password">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="submit" name="login" class="buttons" value="Login">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<input type="button" name="signup" class="buttons" value="Sign Up" onclick="location.href='signup.php'">
									<!-- <input type="button" name="forgot" class="buttons" value="Forgot Password?"> -->
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
	"loginForm"
];

setValidatorFunction(validate);
</script>
</html>