<?php

include 'config.php';


if(isset($_POST['update_appointment'])){

   $appointment_update_id = $_POST['appointment_id'];
   $update_status = $_POST['update_status'];
   

   mysqli_query($conn, "UPDATE `appointments` SET status = '$update_status' WHERE id = '$appointment_update_id'") or die('query failed');
   $message[] = 'status has been updated!';
  
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `appointments` WHERE id = '$delete_id'") or die('query failed');
   header('location:doctor_app.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payment Process</title>

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
   


<section class="appointments">

   <h1 class="title">Welcome to Vdas Payment System</h1>

   <div class="box-container">
      <?php
	  
      $select_appointments = mysqli_query($conn, "SELECT * FROM `appointments`") or die('query failed');
      if(mysqli_num_rows($select_appointments) > 0){
         while($fetch_appointments = mysqli_fetch_array($select_appointments)){
      ?>

   <div class="box">    
        
         <form action="" method="post">
            <input type="hidden" name="appointment_id" value="<?php echo $fetch_appointments['id']; ?>">
            <select name="update_status">
               <option value="APPROVED">APPROVED</option> 
               		   
            </select>


 
 
 <input type="button" value="BACK" name="update_appointment" class="option-btn"  onclick="location.href='appointments.php';" />           
           
            
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">404!</p>';
      }
      ?>
   </div>


</section>


</body>
</html>

