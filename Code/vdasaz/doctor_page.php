<?php

include 'config.php';

session_start();


$doc_id = $_SESSION['doc_id'];
$sql="select * from doctor where doc_id = $doc_id;";

if(!isset($doc_id)){
   header('location:index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>DOCTOR PANEL</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
      <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      /* .updtprofie{
         float:right;
         margin:-56% -40% 20% 30%;
         
      }.updttxt{
         color:black;
         font-size:20px;
      } */
      </style>

</head>
<body>
   
<?php include 'doctor_header.php'; ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">DASHBOARD</h1>

   <div class="box-container">

      <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `appointments`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>appointment placed</p>
      </div>

      <div class="box">
      <?php
         $doctor_query = mysqli_query($conn, "SELECT * FROM `doctor`") or die('query failed');
         $number_of_products = mysqli_num_rows($doctor_query);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <?php
         if(mysqli_num_rows($doctor_query) > 0){
            while($fetch_doctor = mysqli_fetch_assoc($doctor_query)){
      ?>
      
         <p> Doctor Name : <span><?php echo $fetch_doctor['name']; ?></span> </p>
         
         
      <?php
       }
      }
      ?>
      </div>
      
	  

   
   </div>

</section>

<!-- admin dashboard section ends -->
<!-- custom js file link  -->

</body>
</html>