<?php

include 'config.php';
session_start();
if(isset($_POST['mail'])=="forgot Password"){
   	
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
	$mail->addAddress("adarshh769@gmail.com");
	$mail->IsHTML(true);
	$mail->Subject="New Contact Us";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if($mail->send()){
		echo "Mail send";
	}else{
		echo "Error occur";
	}

}

else if(isset($_POST['submit'])){
   

  
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

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
      <h3>login now</h3>
	  
      <input type="email" name="email" placeholder="enter your email"  class="box">
      <input type="password" name="password" placeholder="enter your password" class="box">
	  <div class="link forget-pass text-left"><a href="reset.php">Forgot password?</a>
     </div>
     
     
      <input type="submit" name="submit" value="login now" class="btn">
      <p>don't have an account ? <a href="register.php">register now</a></p>
	 
   </form>
      
     

</div>



</body>
</html>