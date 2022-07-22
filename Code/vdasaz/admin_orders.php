<?php

include 'config.php';

if(isset($_POST['update_appointment'])){

   $appointment_update_id = $_POST['appointment_id'];
   $update_status = $_POST['update_status'];
   

   mysqli_query($conn, "UPDATE `adoption` SET status = '$update_status' WHERE id = '$appointment_update_id'") or die('query failed');
   $message[] = 'status has been updated!';
  
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `adoption` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `adoption` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>adoption orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
      table{
         font-size:16px;
         width:100%;
      }
      th{
         text-align:center;
         background:#fff;
      }
   </style>

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="appointments">

   <h1 class="title">placed orders</h1>

   <div class="box-container">
      <?php
	  
      $select_appointments = mysqli_query($conn, "SELECT * FROM `adoption`") or die('query failed');
      if(mysqli_num_rows($select_appointments) > 0){
         while($fetch_appointments = mysqli_fetch_array($select_appointments)){
      ?>

   <div class="box">
         <p> User ID  <br><span><?php echo $fetch_appointments['user_id']; ?></span> </p>
		 <p> Placed ON  <br> <span><?php echo $fetch_appointments['placed_on']; ?></span> </p>
		 <p> Name  <br><span><?php echo $fetch_appointments['name']; ?></span> </p>
		 <p> Number  <br><span><?php echo $fetch_appointments['number']; ?></span> </p>
		 <p> Email  <br><span><?php echo $fetch_appointments['email']; ?></span> </p>
		 <p> Address  <br><span><?php echo $fetch_appointments['address']; ?></span> </p>
         <p> Pettype  <br> <span><?php echo $fetch_appointments['pettype']; ?></span> </p>
         
         
         
        


         <form action="" method="post">
            <input type="hidden" name="appointment_id" value="<?php echo $fetch_appointments['id']; ?>">
            <select name="update_status">
               <option value="" selected disabled><?php echo $fetch_appointments['status']; ?></option>
               <option value="REJECTED"> REJECTED </option>
               <option value="APPROVED"> APPROVED </option>
            </select>
			
			
			
            
            
            <input type="submit" value="update" name="update_appointment" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_appointments['id']; ?>" onclick="return confirm('complete this order?');" class="delete-btn">Finished</a>
            
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>
   
      <div class="box-container">
      <?php
	  
      $select_appointments = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if(mysqli_num_rows($select_appointments) > 0){
         while($fetch_appointments = mysqli_fetch_array($select_appointments)){
      ?>


      <?php
         }
      }else{
         echo '';
      }
      ?>
   </div>


</section>


</body>
</html>

