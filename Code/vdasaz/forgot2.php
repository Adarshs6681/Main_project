<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

{	
   
   $email=$_POST['email']; 
   $password=md5($_POST['password']);
$query=mysqli_query($conn,"SELECT * FROM admin WHERE email='$email'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="index.php";
mysqli_query($conn,"update admin set password='$password' WHERE email='$email'");
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>	
     <div class="form-row">
     <input type="email" name="email" placeholder="enter your email" id="email" required class="box" required maxlength="25" onchange="Validata();">
	  </div>
	  <span id="msg15" style="color:red;"></span>
	  
<script>		
function Validata() 
{
    var val = document.getElementById('email').value;

    if (!val.match(/([A-z0-9_\-\.]){1,}\@([A-z0-9_\-\.]){1,}\.([A-Za-z]){2,4}$/)) 
    {
        document.getElementById('msg15').innerHTML="Enter a Valid Email";
		
		     document.getElementById('email').value = "";
        return false;
    }
document.getElementById('msg15').innerHTML=" ";
    return true;
}

</script>

      <div class="form-row">
      <input type="password" name="password" placeholder="enter your password" id="pwd" required class="box" required maxlength="20" onchange="return Validp();">
	  </div>
	  <span id="msg9" style="color:red;"></span>
	  
<script>		
function Validp() 
{
    var val = document.getElementById('pwd').value;

    if (!val.match(/^[A-Za-z0-9!-*]{6,15}$/)) 
    {
        document.getElementById('msg9').innerHTML="Enter strong password";
		
		     document.getElementById('pwd').value = "";
        return false;
    }
document.getElementById('msg9').innerHTML=" ";
    return true;
}
</script>
	 	  <div class="form-row">
      <input type="password" name="cpassword" placeholder="confirm your password" id="confirm" required class="box" required onchange="return check();">
      </div>
	  <span id="msg17" style="color:red;"></span>

     <script>
function check()
{
var pas1=document.getElementById("pwd");
var pas2=document.getElementById("confirm");
							
	if(pas1.value=="")
	{
		document.getElementById('msg17').innerHTML="Password can't be null!!";
		pas1.focus();
		return false;
	}
	if(pas2.value=="")
	{
		document.getElementById('msg17').innerHTML="Please confirm password!!";
		pass2.focus();
		return false;
	}
	if(pas1.value!=pas2.value)
	{
		document.getElementById('msg17').innerHTML="Passwords does not match!!";
		pas1.focus();
		return false;
      exit;
	}
     document.getElementById('msg17').innerHTML=" "; 
	return true;
	
}
</script>     

      <input type="submit" name="submit" value="Reset Now" class="btn">
     
   </form>

</div>



</body>
</html>