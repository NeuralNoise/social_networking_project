<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
<?php
include("connect.php");
if(!empty($_SESSION['admin']))
{   $val=$_SESSION['admin'];
	$q1="select * from user_detail where user_id='$val';";
	$res1=mysqli_query($con,$q1)or exit($q1);
	$row=mysqli_fetch_row($res1);
}
else{
	header("location:index.php");
	exit();
} 
$id=$_GET['id'];
$q_user="select * from user_detail where user_id='$id'";
		$result_user=mysqli_query($con,$q_user)or exit($q_user);
	    $res_user=mysqli_fetch_row($result_user); 
$q_user_msg="select * from message where (sender_id='$id' and destination_id='$val') or(sender_id='$val' and destination_id='$id')";
		$result_user_msg=mysqli_query($con,$q_user_msg)or exit($q_user_msg);
		$count_msg=mysqli_num_rows($result_user_msg);
		if($count_msg==0)
		{
		 echo "<div class='conversation'>you have no conversation with ".Ucwords($res_user[17])." yet.Start Conversation</div>";	
		}
		while($r_user_msg=mysqli_fetch_array($result_user_msg))
		{
		  if($r_user_msg[1]==$val)
		  {
		echo "<div style='clear:both;'><div style='float:right;padding-right:10%'><div class='msg_chat'><h5 style='word-break: break-all;'>".
			$r_user_msg[3]."</h5></div><h6 style='float:right;'>".date_format(date_create($r_user_msg[4]),'h:ia');
			if($r_user_msg[5]=='r')
			{
				echo "<i class='fa fa-check'></i>";
			}echo"</h6></div></div>";  
		  }
		  if($r_user_msg[1]==$id)
		  {
		echo "<div style='clear:both;'><div style='float:left'>
		<div class='msg_chat'><h5 style='word-break: break-all;'>".
			$r_user_msg[3]."</h5></div><h6>".date_format(date_create($r_user_msg[4]),'h:ia');
			if($r_user_msg[5]=='r')
			{
				echo "<i class='fa fa-check'></i>";
			}echo "</div></div>";  
		  }
           			 
		}
?>		