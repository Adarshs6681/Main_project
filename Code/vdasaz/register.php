<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = mysqli_real_escape_string($conn, $_POST['number']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
  
   
$filename=$_FILES["photo"]["name"];
$tmpname=$_FILES["photo"]["tmp_name"];
 $folder="uploaded_img/".$filename;
move_uploaded_file($tmpname,$folder);

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'email is already registered!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, number, email, address, password, image) VALUES('$name', '$number', '$email', '$address', '$cpass','$filename')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:index.php');
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
   <title>register</title>

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

   <form action="" method="post" enctype="multipart/form-data">
      <h3>register now</h3>
	  
	  
	  
	  <div class="form-row">
	  <br>
      <input type="text" name="name" placeholder="enter your name" id = "nme" required class="box" required maxlength="20" onchange="Validate();">
	  </div>
	  <span id="msg1" style="color:red;"></span>
	  
<script>		
function Validate() 
{
    var val = document.getElementById('nme').value;

    if (!val.match(/^[A-Z][a-z]+\s[A-Z][a-z]+$/)) 
    {
        document.getElementById('msg1').innerHTML="Enter a Valid Name";
		            document.getElementById('nme').value = "";
        return false;
    }
document.getElementById('msg1').innerHTML=" ";
    return true;
}
</script>

     <div class="inputBox">
	  <br>
      <input type="number" name="number" placeholder="enter your number" id="num" required class="box" required maxlength="10" onchange="return Valid();">
	  </div>
	  <span id="msg5" style="color:red;"></span>
<script>		
function Valid() 
{
    var val = document.getElementById('num').value;

    if (!val.match(/^[0-9]{10}$/))
    {
        document.getElementById('msg5').innerHTML="should contain  10 numbers";
		
		     document.getElementById('num').value = "";
        return false;
    }
document.getElementById('msg5').innerHTML=" ";
    return true;
}
</script>	


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
	  <br>
      <input type="text" name="address" placeholder="enter your address" id = "add" required class="box" required maxlength="50" onchange="Validate();">
	  </div>
	  <span id="msg23" style="color:red;"></span>
	  
<script>		
function Validate() 
{
    var val = document.getElementById('add').value;

    if (!val.match()) 
    {
        document.getElementById('msg23').innerHTML="Enter Your address";
		            document.getElementById('add').value = "";
        return false;
    }
document.getElementById('msg23').innerHTML=" ";
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
        document.getElementById('msg9').innerHTML="Password should contain atleast 6 characters";
		
		     document.getElementById('pwd').value = "";
        return false;
    }
document.getElementById('msg9').innerHTML=" ";
    return true;
}
</script>	  
	  
	  <div class="form-row">
      <input type="password" name="cpassword" placeholder="confirm your password" id="pwd" required class="box" required onchange="return check();">
      </div>
	  <span id="msg17" style="color:red;"></span>

      <div class="form-row">
      <input type="file" name="photo" class="box" required>
     </div>
      
	  
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
	}
     document.getElementById('msg17').innerHTML=" "; 
	return true;
	
}
</script>
	  
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="index.php">login now</a></p>
   </form>



</div>

</body>
</html>