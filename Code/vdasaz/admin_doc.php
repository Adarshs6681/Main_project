<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
};

if(isset($_POST['add_doctor'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $number = mysqli_real_escape_string($conn, $_POST['number']);
   $email = $_POST['email'];
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   
   
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_doctor_name = mysqli_query($conn, "SELECT name FROM `doctor` WHERE password != '$pass' OR password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_doctor_name) > 0){
      echo '<script>alert("doctor cant add : Please delete the doctor")</script>';
   }else{
      $add_doctor_query = mysqli_query($conn, "INSERT INTO `doctor`(name, password, number, email, price, image)VALUES('$name', '$pass', '$number', '$email', '$price', '$image')") or die('query failed');

      if($add_doctor_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            echo '<script>alert("doctor added successfully!")</script>';
         }
      }else{
         $message[] = 'doctor could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `doctor` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `doctor` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_doc.php');
}

if(isset($_POST['update_doctor'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_license = $_POST['update_number'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `doctor` SET name = '$update_name', price = '$update_price', password = '$update_pass' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `doctors` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_doc.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>DOCTOR</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-doctors">

   <h1 class="title">DOCTOR</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>ADD DOCTOR</h3>
	  <div class="inputBox">
	  <span>Doctor name :</span>
            <input type="text" name="name" placeholder="enter your name" id = "nme" required class="box" required maxlength="20" onchange="Validate();">
	  </div>
	  <span id="msg1" style="color:red;"></span>
	  
<script>		
function Validate() 
{
    var val = document.getElementById('nme').value;

    if (!val.match(/^[A-Z][a-z]+\s[A-Z][a-z]+$/)) 
    {
        document.getElementById('msg1').innerHTML="Enter a valid name";
		            document.getElementById('nme').value = "";
        return false;
    }
document.getElementById('msg1').innerHTML=" ";
    return true;
}
</script>	  
	    <div class="inputBox">
	  <span>license number :</span>
	  <br>
      <input type="number" name="password" placeholder="enter license number" id="kwd" required class="box" required onchange="return Validpsn();">
	  </div>
	  <span id="msg6" style="color:red;"></span>
<script>		
function Validpsn() 
{
    var val = document.getElementById('kwd').value;

    if (!val.match(/^[0-9]{7}$/)) 
    {
        document.getElementById('msg6').innerHTML="should contain  7 numbers";
		
		     document.getElementById('kwd').value = "";
        return false;
    }
document.getElementById('msg6').innerHTML=" ";
    return true;
}
</script>


      <div class="inputBox">
	  <span>mobile number :</span>
	  <br>
      <input type="number" name="number" placeholder="enter your number" id="num" required class="box" required maxlength="10" onchange="return Valid();">
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
	  <span>Consultancy Fee :</span>
	  <br>
      <input type="number" name="price" placeholder="enter doctor fee" id="kwn" required class="box" required onchange="return Validpsn();">
	  </div>
	  <span id="msg46" style="color:red;"></span>
<script>		
function Validpsn() 
{
    var val = document.getElementById('kwn').value;

    if (!val.match(/^[0-9]{3}$/)) 
    {
        document.getElementById('msg46').innerHTML="upto 500";
		
		     document.getElementById('kwn').value = "";
        return false;
    }
document.getElementById('msg46').innerHTML=" ";
    return true;
}
</script>


	  
     <div class="inputBox">
	  <br>
	  <span>upload doctor image :</span>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required onchange="Validata();">
	  </div>
	  <span id="msg15" style="color:red;"></span>
      <input type="submit" value="add doctor" name="add_doctor" class="btn">
   </form>

</section>

<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-doctors">

   <div class="box-container">

      <?php
         $select_doctors = mysqli_query($conn, "SELECT * FROM `doctor`") or die('query failed');
         if(mysqli_num_rows($select_doctors) > 0){
            while($fetch_doctor = mysqli_fetch_assoc($select_doctors)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_doctor['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_doctor['name']; ?></div>
         <div class="email"><?php echo $fetch_doctor['email']; ?></div>
         
         
         
         
         <a href="admin_doc.php?delete=<?php echo $fetch_doctor['id']; ?>" class="delete-btn" onclick="return confirm('delete this doctor?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no doctors added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-doctor-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `doctor` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-doctor-form").style.display = "none";</script>';
      }
   ?>

</section>
<script src="js/script.js"></script>
</body>
</html>