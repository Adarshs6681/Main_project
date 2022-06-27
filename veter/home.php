<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['checkout'])){

   $doctor_name = $_POST['doctor_name'];
   $doctor_price = $_POST['doctor_price'];
   $doctor_number = $_POST['doctor_number'];
   $doctor_image = $_POST['doctor_image'];
   
   

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$doctor_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, number, price, image) VALUES('$user_id', '$doctor_name', '$doctor_price', '$doctor_number', '$doctor_image')") or die('query failed');
      $message[] = 'doctor added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3> Your Pets Deserves the Best </h3>
      

</section>

<section class="doctors">

   <h1 class="title">DOCTORS</h1>

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
	  <div class="price">₹<?php echo $fetch_doctors['price']; ?>/-</div>
      
      <input type="hidden" name="product_name" value="<?php echo $fetch_doctors['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_doctors['price']; ?>">
	  <input type="hidden" name="product_number" value="<?php echo $fetch_doctors['number']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_doctors['image']; ?>">
      <a href="checkout.php" class="btn" name="order_btn">book</a>
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no doctors added yet!</p>';
      }
      ?>
   </div>

</section>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>