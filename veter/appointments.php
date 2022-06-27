<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>appointments</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>your appointments</h3>
   <p> <a href="home.php">home</a> / appointments </p>
</div>

<section class="placed-appointments">

   <h1 class="title">placed appointments</h1>

   <div class="box-container">

      <?php
         $appointment_query = mysqli_query($conn, "SELECT * FROM `appointments` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($appointment_query) > 0){
            while($fetch_appointments = mysqli_fetch_assoc($appointment_query)){
      ?>
      <div class="box">
         <p> placed on : <span><?php echo $fetch_appointments['placed_on']; ?></span> </p>
         
         <p> pettype : <span><?php echo $fetch_appointments['pettype']; ?></span> </p>
        
         <p>Appointment Date : <span><?php echo $fetch_appointments['Date']; ?></span> </p>
         <p> status : <span style="color:<?php if($fetch_appointments['status'] == 'TODAY DOCTOR IS ON LEAVE YOUR APPOINTMENT DATE HAS BEEN CHANGED'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_appointments['status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">no appointments placed yet!</p>';
      }
      ?>
   </div>

</section>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>