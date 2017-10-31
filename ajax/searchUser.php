<?php
	include_once('../dbconfig.php');
	include_once('../config.php');
	$data=$_GET['data'];
	$found=false;
	$users=mysqli_query($dbase,"SELECT * FROM `users` WHERE `userName`<>'$adminName' ORDER BY `userName` ASC");
	$toPrint="";
	$toPrint2="";
	$location="propics/";
	$srno=0;
	$srno2=0;
	while($user=mysqli_fetch_assoc($users)){
		$userName=$user['userName'];
		if(stripos($userName,$data)!==false)
		{
			$found=true;
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
		$toPrint2.="
				<tr class='userBlockRow'><td><img class='propicDisplay' src='$location".$user['propic']."'></td>
				<td>".$user['userName']."</td>
				<td>".$user['mail']."</td>
			";
		if($user['block']==1)
		{
			$toPrint2.="<td><button type='button' class='buttons' onclick=\"blockUser('".$user['userName']."',$srno2,'blocked')\">Unblock</button></td>";
		}
		else
		{
			$toPrint2.="<td><button type='button' class='buttons' onclick=\"blockUser('".$user['userName']."',$srno2,'notBlocked')\">Block</button></td>";	
		}
		$srno2++;
		$toPrint2.="</tr>";
	}
	if($found)
		echo "$toPrint";
	else
		echo "$toPrint2";
	
?>