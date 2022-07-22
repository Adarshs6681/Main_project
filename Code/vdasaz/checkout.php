<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:index.php');
}

if (isset($_POST['order_btn'])) {



 
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $pettype = mysqli_real_escape_string($conn, $_POST['pettype']);
   $symptoms = mysqli_real_escape_string($conn, $_POST['symptoms']);
   $placed_on = date('d-M-Y');
   $date1 = $_POST['date1'];
   // $d=date("Y-m-d", strtotime($date1));
 echo $date1;
   $time = $_POST['time'];
   $select_users = mysqli_query($conn, "SELECT * FROM `appointments` WHERE user_id != '$user_id'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {

      $row = mysqli_fetch_assoc($select_users);
      $_SESSION['appointments_name'] = $row['name'];
      $_SESSION['appointments_email'] = $row['email'];
      $_SESSION['appointments_id'] = $row['id'];
      header('location:home.php');
   }

   $order_query = mysqli_query($conn, "INSERT INTO `appointments`(user_id, price, pettype,symptoms,placed_on,Date,Time) VALUES('$user_id','$price', '$pettype','$symptoms','$placed_on','$date1','$time')") or die('query failed');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="date/css/datetimepicker.css" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
   <script type="text/javascript" src="date/js/datetimepicker.js"></script>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   

   <?php include 'header.php'; ?>
   

   <div class="heading">
      <h3>book appointment</h3>
      <p> <a href="home.php">home</a> / book appointment </p>
   </div>
   <?php
  $query="select * from doctor";
  $query_exe=mysqli_query($conn,$query);
  while( $row=mysqli_fetch_array($query_exe)){

  
 


  ?>


   <section class="checkout">

      <form action="" method="post">
         <h3>place your appointments</h3>
         <div class="flex">

         <span>consultancy fee :</span>
			<input readonly type="text" name="price" value="<?php echo $row[5];?>" placeholder="price"  required class="box" required maxlength="100">
   
         

            <div class="inputBox">
               <span>pettype :</span>
               <select name="pettype" id="pettype" required >
                  <option value="">--select--</option>
                  <option value="dog">dog</option>
                  <option value="cat">cat</option>
                  <option value="goat">goat</option>
                  <option value="cow">cow</option>
               </select>
            </div>

            <div class="inputBox">
			<span>symptoms :</span> 
         <input type="text" name="symptoms" placeholder="enter symptoms"  required class="box" required maxlength="100">
			
			

            <div class="inputBox">
               <span>Appointment :</span>
               <input type="date" name="date1" id="from" min="<?php echo date("Y-m-d") ?>" required>
               <input type="time"  id="ed"  min="09:00:00" max="17:00:00" name="time" step="1" required >
               <!-- <div id="picker"></div>
            <div class="inputBox"> -->
               <input type="hidden" name="date" id="result" />
            </div>
         </div>



         </div>
         <input type="submit" value="book now" class="btn" name="order_btn">
      </form>

      <?php
  }
  ?>

   </section>
 <?php include 'footer1.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>