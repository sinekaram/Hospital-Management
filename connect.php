<?php
$connect = mysqli_connect("localhost", "root", "", "hmsgds");
if($connect)
{
    die("Connection failed: " .mysqli_connect_error());
}
?>