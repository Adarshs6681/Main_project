<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:index.php');
}

if (isset($_POST['order_btn'])) {


   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = mysqli_real_escape_string($conn, $_POST['number']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $pettype = mysqli_real_escape_string($conn, $_POST['pettype']);
  
   $placed_on = date('d-M-Y');
   
   $select_users = mysqli_query($conn, "SELECT * FROM `adoption`") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {

      $row = mysqli_fetch_assoc($select_users);
      $_SESSION['appointments_name'] = $row['name'];
      $_SESSION['appointments_email'] = $row['email'];
      $_SESSION['appointments_id'] = $row['id'];
      header('location:home.php');
   }

   $order_query = mysqli_query($conn, "INSERT INTO `adoption`(user_id,name,number,email,address,pettype,placed_on) VALUES('$user_id','$name','$number','$email','$address','$pettype','$placed_on')") or die('query failed');
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
  <?php
  $query="select * from users where id=$user_id";
  $query_exe=mysqli_query($conn,$query);
  while( $row=mysqli_fetch_array($query_exe)){

  
 


  ?>

   

   <?php include 'header.php'; ?>
   

   <div class="heading">
      <h3>pet adoption</h3>
      <p> <a href="home.php">home</a></p>
   </div>
  


   <section class="checkout">

      <form action="" method="post">
         <h3>place your order</h3>
         <div class="flex">
		 <div class="inputBox">
	  <span>your name :</span>
      <input readonly type="text" name="name" placeholder="enter your name" value="<?php echo $row[1];?>" id = "nme" required class="box" required maxlength="20" onchange="Validate();">
	  </div>
	  <span id="msg1" style="color:red;"></span>
		 
        <script>		
function Validate() 
{
    var val = document.getElementById('nme').value;

    if (!val.match(/^[A-Z][a-z]+\s[A-Z][a-z]+$/)) 
    {
        document.getElementById('msg1').innerHTML="Enter a Valid Name";
		            document.getElementById('nme').value = "";
        return false;
    }
document.getElementById('msg1').innerHTML=" ";
    return true;
}
</script>
         <div class="inputBox">
	  <span>your number :</span>
      <input readonly type="number" name="number" placeholder="enter your number" value="<?php echo $row[2];?>" id="num" required class="box" required maxlength="10" onchange="return Valid();">
	  </div>
	  <span id="msg5" style="color:red;"></span>
		 
<script>		
function Valid() 
{
    var val = document.getElementById('num').value;

    if (!val.match(/^[0-9]{10}$/))
    {
        document.getElementById('msg5').innerHTML="should contain  10 numbers";
		
		     document.getElementById('num').value = "";
        return false;
    }
document.getElementById('msg5').innerHTML=" ";
    return true;
}
</script>	
		 
         <div class="inputBox">
            <span>your email :</span>
            <input readonly type="email" name="email" id="email" value="<?php echo $row[3];?>" required placeholder="enter your email">
         </div>
		 
<script>		
function Validata() 
{
    var val = document.getElementById('email').value;

    if (!val.match(/([A-z0-9_\-\.]){1,}\@([A-z0-9_\-\.]){1,}\.([A-Za-z]){2,4}$/)) 
    {
        document.getElementById('msg15').innerHTML="Enter a Valid Email";
		
		     document.getElementById('email').value = "";
        return false;
    }
document.getElementById('msg15').innerHTML=" ";
    return true;
}

</script>		 
		 <div class="inputBox">
            <span>address :</span>
            <input readonly type="text" name="address" value="<?php echo $row[4];?>" required placeholder="">
         </div>
		 

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

            
			


         </div>

         <input type="submit" value="order now" class="btn" name="order_btn">
      </form>



   </section>
 <?php include 'footer1.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>
 <?php

}
?>
</body>

</html>