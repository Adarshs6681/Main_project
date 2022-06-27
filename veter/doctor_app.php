<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_appointment'])){

   $appointment_update_id = $_POST['appointment_id'];
   $update_status = $_POST['update_status'];
   $date = $_POST['date'];
   mysqli_query($conn, "UPDATE `appointments` SET Date='$date',status = '$update_status' WHERE id = '$appointment_update_id'") or die('query failed');
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
   <title>appointment</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'doctor_header.php'; ?>

<section class="appointments">

   <h1 class="title">placed appointments</h1>

   <div class="box-container">
      <?php
      $select_appointments = mysqli_query($conn, "SELECT * FROM `appointments`") or die('query failed');
      if(mysqli_num_rows($select_appointments) > 0){
         while($fetch_appointments = mysqli_fetch_assoc($select_appointments)){
      ?>
      <div class="box">
         <p> Appointment : <span><?php echo $fetch_appointments['Date']; ?></span> </p>
         <p> user id : <span><?php echo $fetch_appointments['user_id']; ?></span> </p>
         <p> placed on : <span><?php echo $fetch_appointments['placed_on']; ?></span> </p>
         <p> name : <span><?php echo $fetch_appointments['name']; ?></span> </p>
         <p> pincode : <span><?php echo $fetch_appointments['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_appointments['email']; ?></span> </p>
         <p> address : <span><?php echo $fetch_appointments['address']; ?></span> </p>
         
         
         <p> pettype : <span><?php echo $fetch_appointments['pettype']; ?></span> </p>
         <form action="" method="post">
            <input type="hidden" name="appointment_id" value="<?php echo $fetch_appointments['id']; ?>">
            <select name="update_status">
               <option value="" selected disabled> ACTION  :  <?php echo $fetch_appointments['status']; ?></option>
               <option value="TODAY DOCTOR IS ON LEAVE YOUR APPOINTMENT DATE HAS BEEN CHANGED"> TODAY DOCTOR IS ON LEAVE YOUR APPOINTMENT DATE HAS BEEN CHANGED </option>
               <option value="APPROVED"> APPROVED </option>
            </select>
            <input type="date" value="<?php echo $fetch_appointments['Date']; ?>" placeholder="" name="date" class="option-btn" min="<?php echo date('Y-m-d');?>">
            <input type="submit" value="update" name="update_appointment" class="option-btn">
            <a href="doctor_app.php?delete=<?php echo $fetch_appointments['id']; ?>" onclick="return confirm('delete this appointment?');" class="delete-btn">delete</a>
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