<?php

session_start();


    
$con=mysqli_connect('localhost','root','');

mysqli_select_db($con,'hmsgds');

$docid= $_POST['docid'];
$docname= $_POST['docname'];
$spec = $_POST['specilaization'];
$password = $_POST['password'];
$cpassword = $_POST['confirmpassword'];
$fees = $_POST['consultancyfees'];


    $reg1="insert into doctable(docid,docname,specilaization,password,confirmpassword,consultancyfees) values ('$docid','$docname','$spec','$password','$cpassword','$fees')";
	$reg="delete from deleted_doc where docid='$docid'";
    mysqli_query($con,$reg1);
	mysqli_query($con,$reg);
    echo"<script>window.alert('Details Entered Successfully');</script>";  
	?>
	<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://localhost/gds/doctorlist.php">
	<?php
	

?>