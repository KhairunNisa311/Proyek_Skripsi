<?php
session_start();
include ("connect.php");
global $con;

$username=$_REQUEST['username'];
$password=$_REQUEST['password'];

$sql=mysqli_query($con,"select username,password from user 
where username='$username' and password=md5('$password')");

if(mysqli_num_rows($sql)==1){
	$_SESSION['user']=$username;
}
header("location: index.php");
?>