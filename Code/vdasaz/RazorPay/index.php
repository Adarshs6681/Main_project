<!DOCTYPE html>
<?php
	include'config.php';
  session_start();
  $user_id = $_SESSION['user_id'];
?>
<html>
  <head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet"  href="style.css"> 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
  <?php
  $query="select * from appointments join users on appointments.user_id=users.id where user_id=$user_id";
  $query_exe=mysqli_query($conn,$query);
  while( $row=mysqli_fetch_array($query_exe)){

  
 


  ?>
  
    <div class="container11">
        <h1 class="w3-padding-32 w3-center">Payment Form</h1>
		
<form action="pay.php" method="post">

  <div class="input-group1"> 
        
      <input readonly type="text" placeholder = "Enter the price" name="price" value="<?php echo $row[6];?>" ><br>
	  </div>
<br>


  <div class="input-group1"> 
        
      <input readonly type="text" placeholder = "Enter your name" value="<?php echo $row['name'];?>" name="customername"><br>
	  </div>
	  
<br>
	 
  <div class="input-group1"> 
        
	  
      <input readonly type="email" placeholder = "Enter your email" value="<?php echo $row['number'];?>" name="email"><br>
	  </div>
	  

  <div class="input-group1"> 
        <br>
	  
      <input readonly type="text" placeholder = "Enter your contact number" value="<?php echo $row['email'];?>" name="contactno"><br>
	  </div>
	  
    <br>

  
<br>
<div class="input-group1">
<input type="submit" name="submit" value="Proceed To Pay">
</div>

</form>

      
  </div>
 <?php
 
}
?>
</body>

</html>