<?php
require_once "config.php";

session_start();
if(isset($_POST['change']))
{
   
   $email=$_POST['email']; 
   $password=md5($_POST['password']);

$query=mysqli_query($link,"SELECT * FROM admin WHERE email='$email'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="index.php";

mysqli_query($link,"update admin set password='$password' WHERE email='$email'");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Password Changed Successfully";
exit();
}
else
{
$extra="resetpassword2.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Phone no";
exit();
}
}