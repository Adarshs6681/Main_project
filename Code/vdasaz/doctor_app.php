<?php

include 'config.php';

session_start();

$doc_id = $_SESSION['doc_id'];
$sql="select * from doctor where doc_id = $doc_id;";

if(!isset($doc_id)){
   header('location:doctor_app.php');

}


if(isset($_POST['update_appointment'])){

   $appointment_update_id = $_POST['appointment_id'];
   $update_status = $_POST['update_status'];
   
   $date = $_POST['Date'];
   echo $date;
   $time = $_POST['time'];
   mysqli_query($conn, "UPDATE `appointments` SET Date='$date', Time = '$time', status = '$update_status' WHERE id = '$appointment_update_id'") or die('query failed');
   $message[] = 'status has been updated!';
  
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "UPDATE `appointments` SET `treatment_status`='treated' WHERE id = '$delete_id'") or die('query failed');
   header('location:doctor_app.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:doctor_app.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>appointment</title>

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
   
<?php include 'doctor_header.php'; ?>

<section class="appointments">

   <h1 class="title">placed appointments</h1>

   <div class="box-container">
      <?php
	  
      $select_appointments = mysqli_query($conn, "SELECT * FROM `appointments`") or die('query failed');
      if(mysqli_num_rows($select_appointments) > 0){
         while($fetch_appointments = mysqli_fetch_array($select_appointments)){
      ?>

   <div class="box">
         <p> User ID  <br><span><?php echo $fetch_appointments['user_id']; ?></span> </p>
         <p> Pettype  <br> <span><?php echo $fetch_appointments['pettype']; ?></span> </p>
		 <p> Symptoms  <br> <span><?php echo $fetch_appointments['symptoms']; ?></span> </p>
         <p> Placed ON  <br> <span><?php echo $fetch_appointments['placed_on']; ?></span> </p>
         <p> Appointment Date  <br> <span><?php echo $fetch_appointments['Date']; ?></span> </p>
         <p>Appointment Time : <span><?php echo $fetch_appointments['Time']; ?></span> </p>
		 <p>Treatment status : <span><?php echo $fetch_appointments['treatment_status']; ?></span> </p>

         
        


         <form action="" method="post">
            <input type="hidden" name="appointment_id" value="<?php echo $fetch_appointments['id']; ?>">
            <select name="update_status">
               <option value="" selected disabled><?php echo $fetch_appointments['status']; ?></option>
               <option value="REJECTED"> REJECTED </option>
               <option value="APPROVED"> APPROVED </option>
            </select>
			
			
			
            <input type="date" value="<?php echo $fetch_appointments['Date']; ?>" placeholder="" name="Date" class="option-btn" min="<?php echo date('Y-m-d');?>">
			
			 <input type="time"  id="ed"  min="09:00:00" max="17:00:00" name="time" step="1" required >
            
            <input type="submit" value="update" name="update_appointment" class="option-btn">
            <a href="doctor_app.php?delete=<?php echo $fetch_appointments['id']; ?>" onclick="return confirm('complete this appointment?');" class="delete-btn">Finished</a>
			
	     <?php
		 
         $appointment_query = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
         if(mysqli_num_rows($appointment_query) > 0){
            while($fetch_appointments = mysqli_fetch_assoc($appointment_query)){
         ?>
      

         <p> razorpay_payment_id : <span><?php echo $fetch_appointments['razorpay_payment_id']; ?></span> </p>
         
         <p> status : <span><?php echo $fetch_appointments['status']; ?></span> </p>
        
         
		 
		 
        
      <?php
       }
      }else{
         echo '<p class="empty">Payment is not done yet!</p>';
      }
      ?>          

		  
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no appointments placed yet!</p>';
      }
      ?>
   </div>
   



</section>


</body>
</html>

