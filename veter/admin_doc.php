<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_doctor'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_doctor_name = mysqli_query($conn, "SELECT name FROM `doctor` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_doctor_name) > 0){
      $message[] = 'doctor name already added';
   }else{
      $add_doctor_query = mysqli_query($conn, "INSERT INTO `doctor`(name, number, price, image) VALUES('$name', '$number', '$price', '$image')") or die('query failed');

      if($add_doctor_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'doctor added successfully!';
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

   mysqli_query($conn, "UPDATE `doctor` SET name = '$update_name', price = '$update_price', number = '$update_number' WHERE id = '$update_p_id'") or die('query failed');

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
      <input type="number" name="number" placeholder="enter license number" id="pwd" required class="box" required onchange="return Validps();">
	  </div>
	  <span id="msg6" style="color:red;"></span>
<script>		
function Validps() 
{
    var val = document.getElementById('pwd').value;

    if (!val.match(/^[0-9]{7}$/)) 
    {
        document.getElementById('msg6').innerHTML="should contain  7 numbers";
		
		     document.getElementById('pwd').value = "";
        return false;
    }
document.getElementById('msg6').innerHTML=" ";
    return true;
}
</script>	  
	  
	  
<div class="inputBox">
	  <span>Consultancy fee :</span>
	  <br>
      <input type="number" name="price" placeholder="enter consultancy fee" id="num" required class="box" required onchange="return Validp();">
	  </div>
	  <span id="msg3" style="color:red;"></span>
<script>		
function Validp() 
{
    var val = document.getElementById('num').value;

    if (!val.match(/^[0-9]{3}$/)) 
    {
        document.getElementById('msg3').innerHTML="up to 999";
		
		     document.getElementById('num').value = "";
        return false;
    }
document.getElementById('msg3').innerHTML=" ";
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
		 <div class="number"><?php echo $fetch_doctor['number']; ?></div>
         <div class="price">₹<?php echo $fetch_doctor['price']; ?>/-</div>
         
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

</body>
</html>