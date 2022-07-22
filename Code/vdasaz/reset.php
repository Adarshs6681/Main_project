<?php

include 'config.php';
session_start();

if(isset($_POST['submit']))

{
	$count=0;
	$email=$_POST['email'];

   $sql1="select * from users where email='$email';";
   $sql2="select * from doctor where email='$email';";    
   $sql3="select * from admin where email='$email';";
   
   
   $s1=mysqli_query($conn,$sql1);
   $s2=mysqli_query($conn,$sql2);
   $s3=mysqli_query($conn,$sql3);
   
   if(mysqli_num_rows($s1) > 0)
   {
	   $count=1;
   }
   else if(mysqli_num_rows($s2) > 0)
   {
	   $count=2;
   }
   else if(mysqli_num_rows($s3) > 0)
   {
	   $count=3;
   }
   
include 'config.php';
if($count==1){


    $html="http://localhost/veter/forgot.php";
	
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="veterinary545@gmail.com";
	$mail->Password="wqizfelmgvgtkcda";
	$mail->SetFrom("veterinary545@gmail.com");
	$mail->addAddress($email);
	$mail->IsHTML(true);
	$mail->Subject="New Contact Us";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
      
      echo '<script>alert("mail succussfully sended! Please Check your mail")</script>';
      header("location:forgot.php");
	}
}
else if($count==2){
	
	    $html="http://localhost/veter/forgot.php";
	
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="veterinary545@gmail.com";
	$mail->Password="wqizfelmgvgtkcda";
	$mail->SetFrom("veterinary545@gmail.com");
	$mail->addAddress($email);
	$mail->IsHTML(true);
	$mail->Subject="New Contact Us";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
      
      echo '<script>alert("mail succussfully sended! Please Check your mail")</script>';
      header("location:forgot1.php");
	}else{
		echo "Error occur";
	}
}
else if($count==3){
	
	$html="http://localhost/veter/forgot.php";
	
	include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="veterinary545@gmail.com";
	$mail->Password="wqizfelmgvgtkcda";
	$mail->SetFrom("veterinary545@gmail.com");
	$mail->addAddress($email);
	$mail->IsHTML(true);
	$mail->Subject="New Contact Us";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
      
      echo '<script>alert("mail succussfully sended! Please Check your mail")</script>';
      header("location:forgot2.php");
	}else{
		echo "Error occur";
	}
}
		
	
else{
	?>
    <script>
        alert("Invalid Email");
    </script>
    <?php
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

   
<div class="form-container">

   <form action="" method="post">
      <h3>Reset Password</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">

      <input type="submit" name="submit" value="Send reset mail" class="btn">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</div>



</body>
</html>