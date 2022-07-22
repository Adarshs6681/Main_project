<?php

include 'config.php';

session_start();







?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title></title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'doctor_header.php'; ?>

<section class="placed-appointments">

   <div class="box-container">

      <?php
         $appointment_query = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
         if(mysqli_num_rows($appointment_query) > 0){
            while($fetch_appointments = mysqli_fetch_assoc($appointment_query)){
      ?>
      <div class="box">

         <p> razorpay_payment_id : <span><?php echo $fetch_appointments['razorpay_payment_id']; ?></span> </p>
         
         <p> status : <span><?php echo $fetch_appointments['status']; ?></span> </p>
        
         
		 
		 
         <center><button id="PrintButton" onclick="PrintPage()" class ="option-btn">Download</button></center>
		 
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">Payment is not done yet!</p>';
      }
      ?>
   </div>

</section>
  
<!-- custom js file link  -->
<script src="js/script.js"></script>
<script type="text/javascript">
	function PrintPage() {
		window.print();
	}
</script>

</body>
</html>