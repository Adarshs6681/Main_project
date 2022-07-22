<?php
require_once "config.php";

session_start();
if(isset($_POST['change']))
{
   $number=$_POST['number'];
   $email=$_POST['email']; 
   $password=md5($_POST['password']);

$query=mysqli_query($link,"SELECT * FROM doc WHERE email='$email' and number='$number'");
$query=mysqli_query($link,"SELECT * FROM admin WHERE email='$email' and number='$number'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="index.php";

mysqli_query($link,"update doc set password='$password' WHERE email='$email' and number='$number' ");
mysqli_query($link,"update admin set password='$password' WHERE email='$email' and number='$number' ");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Password Changed Successfully";
exit();
}
else
{
$extra="resetpassword1.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']="Invalid email id or Phone no";
exit();
}
}