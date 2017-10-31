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
					<table align="center" cellspacing="10" style="color: #555;">
						<tr>
							<td colspan="4"><input type='text' class='searchBox' placeholder='Search User' onkeyup="searchUser(this.value)"></td>
						</tr>
					</table>
					<table align="center" cellspacing="10" style="color: #555;" id="usersList">
						<?php
							$users=mysqli_query($dbase,"SELECT * FROM `users` WHERE `userName`<>'$adminName' ORDER BY `userName` ASC");
							$toPrint="";
							$location="propics/";
							$srno=0;
							while($user=mysqli_fetch_assoc($users))
							{
								$toPrint.="
									<tr class='userBlockRow'><td><img class='propicDisplay' src='$location".$user['propic']."'></td>
									<td>".$user['userName']."</td>
									<td>".$user['mail']."</td>
								";
								if($user['block']==1)
								{
									$toPrint.="<td><button type='button' class='buttons' onclick=\"blockUser('".$user['userName']."',$srno,'blocked')\">Unblock</button></td>";
								}
								else
								{
									$toPrint.="<td><button type='button' class='buttons' onclick=\"blockUser('".$user['userName']."',$srno,'notBlocked')\">Block</button></td>";	
								}
								$srno++;
								$toPrint.="</tr>";
							}
							echo "$toPrint";
						?>
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