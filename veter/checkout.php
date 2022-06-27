<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $date = $_POST['date'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pettype = mysqli_real_escape_string($conn, $_POST['pettype']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat']);
   $state = mysqli_real_escape_string($conn, $_POST['state']);
   $district = mysqli_real_escape_string($conn, $_POST['district']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_doctors[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_doctors[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_doctors = implode(', ',$cart_doctors);
   
   $d= date("Y-m-d",strtotime($date));
   $order_query = mysqli_query($conn, "INSERT INTO `appointments`(user_id, name, number, email, pettype, address, state, district, placed_on,Date) VALUES('$user_id', '$name', '$number', '$email', '$pettype', '$address', '$state', '$district', '$placed_on','$d')") or die('query failed');


   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($appointment_query) > 0){
         $message[] = 'appointment already placed!'; 
      }else{
         $message[] = 'appointment placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
   
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

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>book appointment</h3>
   <p> <a href="home.php">home</a> / book appointment </p>
</div>

<section class="display-appointment">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '$'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }
   ?>
   

</section>

<section class="checkout">

   <form action="" method="post" >
      <h3>place your appointments</h3>
      <div class="flex">
         <div class="inputBox">
		 <span>your name :</span>
	  <br>
      <input type="text" name="name" placeholder="enter your name"  id = "nme" required class="box" required maxlength="20" onchange="Validate();">
	  </div>
	  <span id="msg1" style="color:red;"></span>
<script>		
function Validate() 
{
    var val = document.getElementById('nme').value;

    if (!val.match(/^[A-Z][a-z]+\s[A-Z][a-z]+$/)) {
        document.getElementById('msg1').innerHTML="Enter a Valid name";
        return false;
		  document.getElementById('nme').value = "";
    }
        document.getElementById('msg1').value = "";
        return true;
    }


</script>

      
     <div class="inputBox">
	  <span>mobile number :</span>
	  <br>
      <input type="number" name="number" placeholder="enter your number" id="num" required class="box" required onchange="return Validp();">
	  </div>
	  <span id="msg3" style="color:red;"></span>
<script>		
function Validp() 
{
    var val = document.getElementById('num').value;

    if (!val.match(/^[0-9]{10}$/)) 
    {
        document.getElementById('msg3').innerHTML="should contain  10 numbers";
		
		     document.getElementById('num').value = "";
        return false;
    }
document.getElementById('msg3').innerHTML=" ";
    return true;
}
</script>		  
	 
     <div class="inputBox">
	  <br>
	  <span>your email :</span>
      <input type="email" name="email" placeholder="enter your email" id="email" required class="box" required onchange="Validata();">
	  </div>
	  <span id="msg15" style="color:red;"></span>
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
	if(document.getElementById('msg15').innerHTML=" "){
      return false;
   }	
}
</script>	  
	  
         <div class="inputBox">
            <span>pettype :</span>
            <select name="pettype">
               <option value="dog">dog</option>
               <option value="cat">cat</option>
               <option value="goat">goat</option>
               <option value="cow">cow</option>
            </select>
         </div>
         <div class="inputBox">
            <span>flat number :</span>
            <input type="number" min="0" max = "1000" name="flat" required placeholder="e.g. flat no.">
         </div>

        <div class="inputBox">
            <span>state :</span>
            <select name="state">
              <option value="--select--">--select--</option>
               <option value="kerala">kerala</option>
            </select>
         </div>
         <div class="inputBox">
            <span>district :</span>
            <select name="district">
			   <option value="--select--">--select--</option>
               <option value="trivandrum">trivandrum</option>
               <option value="kollam">kollam</option>
               <option value="idukki">idukki</option>
			   <option value="aalapuzha">aalapuzha</option>
            <option value="pathanamthitta">pathanamthitta</option>
			   <option value="kottayam">kottayam</option>
			   <option value="ernakulam">ernakulam</option>
			   <option value="trissur">trissur</option>
			   <option value="palakad">palakad</option>
			   <option value="malappuram">malappuram</option>
			   <option value="kozhikode">kozhikode</option>
			   <option value="kannur">kannur</option>
			   <option value="wayanad">wayanad</option>
			   <option value="kasargode">kasargode</option>
            </select>
         </div>
     <div class="inputBox">
	  <span>your pincode :</span>
	  <br>
      <input type="number" name="number" placeholder="enter your pincode" id="pwd" required class="box" required onchange="return Validps();">
	  </div>
	  <span id="msg6" style="color:red;"></span>
<script>		
function Validps() 
{
    var val = document.getElementById('pwd').value;

    if (!val.match(/^[0-9]{6}$/)) 
    {
        document.getElementById('msg6').innerHTML="should contain  6 numbers";
		
		     document.getElementById('pwd').value = "";
        return false;
    }
document.getElementById('msg6').innerHTML=" ";
    return true;
}
</script>
         <div class="inputBox">
            <span>Appointment  :</span>
            <input type="date" name="date" id ="date"  placeholder="e.g. 123456" min="<?php echo date('Y-m-d');?>">
			
         </div>
      </div>
      <input type="submit" value="book now" class="btn" name="order_btn">
   </form>

</section>


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>