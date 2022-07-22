<?php

include 'config.php';

session_start();

$doc_id = $_SESSION['doc_id'];
$sql="select * from doctor where doc_id = $doc_id;";

if(!isset($doc_id)){
   header('location:index.php');



}


if(isset($_POST['update_appointment'])){

   $appointment_update_id = $_POST['appointment_id'];
   $update_status = $_POST['update_status'];

   mysqli_query($conn, "UPDATE `doctor` SET status = '$update_status' WHERE id = '$appointment_update_id'") or die('query failed');
   $message[] = 'status has been updated!';
  
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

<script>
   function manage(txt) {
       var bt = document.getElementById('btSubmit');
       if (txt.value != '') {
           bt.disabled = false;
       }
       else {
           bt.disabled = true;
       }
   }
</script>
</head>
<body>
   
<?php include 'doctor_header.php'; ?>

<section class="appointments">

   <h1 class="title">UPDATE STATUS</h1>
<br><br><br><br><br>
   <div class="box-container">
      <?php
	  
      $select_appointments = mysqli_query($conn, "SELECT * FROM `doctor`") or die('query failed');
      if(mysqli_num_rows($select_appointments) > 0){
         while($fetch_doctor = mysqli_fetch_assoc($select_appointments)){
      ?>

<form action="" method="post">
<input type="hidden" name="appointment_id" value="<?php echo $fetch_doctor['id']; ?>">
<select name="update_status">
              
               <option value="TODAY DOCTOR IS LEAVE">TODAY DOCTOR IS LEAVE</option>
               <option value="DOCTOR IS AVAILABLE FROM 9:00 AM TO 5:00 PM">DOCTOR IS AVAILABLE FROM 9:00 AM TO 5:00 PM</option>
               
            </select>
            <br><br><br><br><br><br><br>
            <input type="submit" value="update" name="update_appointment" class="option-btn">

            </form>
      <?php
         }
      }
      ?>
   </div>

</section>


</body>
</html>


