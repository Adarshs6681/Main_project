<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');

   
   
}

$sql="select * from appointments where user_id=$user_id; ";
$sql_exe=mysqli_query($conn,$sql);
$s1=mysqli_num_rows($sql_exe);


  

if(isset($_POST['checkout'])){

   $doctor_name = $_POST['doctor_name'];
   $doctor_price = $_POST['doctor_price'];
   $doctor_number = $_POST['doctor_number'];
   $doctor_image = $_POST['doctor_image'];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BOOK</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
            .isDisabled {
  color: currentColor;
  cursor: not-allowed;
  opacity: 0.5;
  text-decoration: none;
  pointer-events: none;
}
   </style>



</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>book appointment</h3>
   <p> <a href="home.php">home</a> / book </p>
</div>

<section class="doctors">

   <h1 class="title">DOCTOR</h1>

   <div class="box-container">

      <?php  
         $select_doctors = mysqli_query($conn, "SELECT * FROM `doctor`") or die('query failed');
         if(mysqli_num_rows($select_doctors) > 0){
            while($fetch_doctors = mysqli_fetch_assoc($select_doctors)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_doctors['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_doctors['name']; ?></div>
      <div class="number"><?php echo $fetch_doctors['number']; ?></div>
      <div class="price">CF:<?php echo $fetch_doctors['price']; ?></div>
	  
     
     
      <input type="hidden" name="doctor_name" value="<?php echo $fetch_doctors['name']; ?>">
      <input type="hidden" name="doctor_price" value="<?php echo $fetch_doctors['price']; ?>">
	  <input type="hidden" name="doctor_number" value="<?php echo $fetch_doctors['number']; ?>">
     <input type="hidden" name="doctor_image" value="<?php echo $fetch_doctors['image']; ?>">
     <p><span style="color:<?php if($fetch_doctors['status'] == 'TODAY DOCTOR IS LEAVE'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_doctors['status']; ?></span> </p>
      <?php
      if($s1>0){
         ?>
         <h2 style="color: red; font-size: 16px"> <?php echo "Appointement already booked" ?></h2>
         <?php
      }else{
         ?>

      <?php
      if($fetch_doctors['status'] == 'TODAY DOCTOR IS LEAVE')
      {
      ?>
         <a class = "isDisabled" href = "checkout.php" class = "btn" name = "order_btn" >BOOK</a>
         <h2 style="color: red; font-size: 16px"> <?php echo "" ?></h2>
      <?php
      }else{
      ?>
      <a href="checkout.php" class="btn" name="order_btn">book</a>
      <?php
      }
      ?>
      
      <?php
      }
      ?>
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no doctors added yet!</p>';
      }
      ?>
   </div>

</section>
 <?php include 'footer1.php'; ?>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>