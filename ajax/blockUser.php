<?php
	include_once('../dbconfig.php');
	$userName=$_GET['userName'];

	$blockStatus=mysqli_fetch_assoc(mysqli_query($dbase,"SELECT `block` FROM `users` WHERE `userName`='$userName'"));
	$blockStatus=$blockStatus['block'];
	if($blockStatus==0)
	{
		mysqli_query($dbase,"UPDATE `users` SET `block`='1' WHERE `userName`='$userName'");
	}
	else
	{
		mysqli_query($dbase,"UPDATE `users` SET `block`='0' WHERE `userName`='$userName'");
	}
?>