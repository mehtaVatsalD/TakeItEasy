<?php
	if (isset($_GET['logout'])) {
		session_start();
		session_unset();
		session_destroy();
		header("location:index.php");
	}
	include('config.php');
?>
<div class="row header">
	<div class="col-3 col-sl-6">
		<img src="extra/img/logo.png" class="logoImg" onclick="location.href='index.php'"><span class="logo" onclick="location.href='index.php'">TakeItEasy</span>
	</div>
	<div class="col-6"></div>
	<div class="col-3 col-sl-6">
	<?php
	if (isset($_SESSION['login'])) {
		$location='propics/';
		$userName=$_SESSION['login'];
		$propic=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT `propic` FROM `users` WHERE `userName`='$userName'"));
		$propic=$propic['propic'];
		$locationProfilePic=$location.$propic;
		
		echo "<img class='headerPic' onclick='dropDownShower()' src='$locationProfilePic'></img><span class='loggedUser' onclick='dropDownShower()'>".$userName." <i class='fa fa-caret-down'></i></span>";
	}
	?>
	</div>
</div>
<div class="dropDown">
	<ul>
		<?php
			if ($userName==$adminName) {
				echo "<li onclick=\"location.href='newQuePermission.php'\">New Questions</li>
						<li onclick=\"location.href='editQuestions.php'\">Edit Questions</li>
						<li onclick=\"location.href='blockPanel.php'\">Block Panel</li>"; ;
			}
			else{
				echo "<li onclick=\"location.href='main.php'\">Set Paper</li>
					<li onclick=\"location.href='history.php'\">History</li>
					<li onclick=\"location.href='upload.php'\">Upload</li>";
			}
		?>
		<li><form method="GET" action="header.php"><input type="submit" value="Logout" name="logout"></form></li>
	</ul>
</div>
<div class="dropDownBack" onclick="hideDropDown()"></div>
<script type="text/javascript" src="js/util.js"></script>