<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `adoption` WHERE id = '$delete_id'") or die('query failed');
   header('location:orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>your orders</h3>
   <p> <a href="home.php">home</a> / orders </p>
</div>

<section class="placed-appointments">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

      <?php
         $appointment_query = mysqli_query($conn, "SELECT * FROM `adoption` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($appointment_query) > 0){
            while($fetch_appointments = mysqli_fetch_assoc($appointment_query)){
      ?>
      <div class="box">
         <p> Placed on : <span><?php echo $fetch_appointments['placed_on']; ?></span> </p>
         <p> Name : <span><?php echo $fetch_appointments['name']; ?></span> </p>
		 <p> Number : <span><?php echo $fetch_appointments['number']; ?></span> </p>
		 <p> Email : <span><?php echo $fetch_appointments['email']; ?></span> </p>
		 <p> Address : <span><?php echo $fetch_appointments['address']; ?></span> </p>
         <p> Pettype : <span><?php echo $fetch_appointments['pettype']; ?></span> </p>
        
        
        
         <p> Status : <span style="color:<?php if($fetch_appointments['status'] == 'REJECTED'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_appointments['status']; ?></span> </p>
		 
        
		
		 
		 
         <center><button id="PrintButton" onclick="PrintPage()" class ="option-btn">Download</button></center>
		 
		 <a href="orders.php?delete=<?php echo $fetch_appointments['id']; ?>" onclick="return confirm('cancel this appointment?');" class="delete-btn">cancel</a>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>
  <?php include 'footer1.php'; ?>  
<!-- custom js file link  -->
<script src="js/script.js"></script>
<script type="text/javascript">
	function PrintPage() {
		window.print();
	}
</script>

</body>
</html>