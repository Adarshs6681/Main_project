<?php

include 'config.php';
session_start();

if(isset($_POST['submit']))

{	
    
   $email=$_POST['email']; 
   $sql="select * from doctor where email='$email';";
include 'config.php';
$select_admin=mysqli_query($conn,$sql);
if(mysqli_num_rows($select_admin) > 0){


    $html="login with email & license number as password --> http://localhost/veter/";
	
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
		header("location:mailsend.php");
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
      <h3>PASS</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">

      <input type="submit" name="submit" value="Send mail" class="btn">
     
   </form>

</div>



</body>
</html>