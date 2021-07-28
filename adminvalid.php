<?php

session_start();


if(isset($_POST['submit']))
{   
$con=mysqli_connect('localhost','root','');

mysqli_select_db($con,'hmsgds');

$adminid= $_POST['adminid'];
$password = $_POST['password'];

$s = "select * from  admin where adminid='$adminid' && password='$password'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num==1)
{
    $_SESSION['adminid']=$adminid;
    header('location:adminpage.html');
}
else
{
	echo "login failed";
}
}

?>
