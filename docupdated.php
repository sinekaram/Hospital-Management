<?php

$con=mysqli_connect('localhost','root','');
mysqli_select_db($con,'hmsgds');

$docid=$_POST['docid'];

if (isset($_POST['docid']))
{
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];
	$query="update doctable set password='$password',confirmpassword='$confirmpassword' WHERE docid='$docid'";
	$data=mysqli_query($con,$query);
	
if($data)
{
	
	echo"<script>window.alert('RECORD IS UPDATED FROM DATABASE')</script>";
    header("location: updatedoctor.php");
?>
	
	<?php
}
else
{
 echo"<script>window.alert('FAILED TO UPDATED THE RECORD FROM DATABASE')</script>";	
}
}
?>