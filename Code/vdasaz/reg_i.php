
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post" >
      <h3>register now</h3>
	  
	  <div class="form-row">
	  <br>
<select name="us" required class="box">
<option value="1" name="us">User</option>
<option value="2" name="us">Admin</option>
</select>
	  </div>
	  
      <input type="submit" name="submit" value="submit" class="btn">
      
   </form>



</div>

</body>
</html>

<?php
if(isset($_POST['submit']))
{
$name = $_POST['us'];
  if($name==1)
  {
	  header('location:register.php');
  }
    if($name==2)
  {
	  header('location:admin_register.php');
  }
}  
   ?>