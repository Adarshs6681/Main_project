<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
};

if(isset($_POST['add_pet'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_pet_name = mysqli_query($conn, "SELECT name FROM `pets` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_pet_name) > 0){
      echo '<script>alert("pet already added")</script>';
   }else{
      $add_pet_query = mysqli_query($conn, "INSERT INTO `pets`(name,image)VALUES('$name','$image')") or die('query failed');

      if($add_pet_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            echo '<script>alert("pet added successfully!")</script>';
         }
      }else{
         $message[] = 'pet could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `pets` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `pets` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_pet.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>PETS</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-doctors">

   <h1 class="title">PETS</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>ADD PETS</h3>
	  <div class="inputBox">
	  <span>Pet name :</span>
            <input type="text" name="name" placeholder="enter your name" id = "nme" required class="box" required maxlength="20" onchange="Validate();">
	  </div>
	  <span id="msg1" style="color:red;"></span>
	  
<script>		
function Validate() 
{
    var val = document.getElementById('nme').value;

    if (!val.match()) 
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
	  <br>
	  <span>upload pet image :</span>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required onchange="Validata();">
	  </div>
	  <span id="msg15" style="color:red;"></span>
      <input type="submit" value="add pet" name="add_pet" class="btn">
   </form>

</section>

<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-doctors">

   <div class="box-container">

      <?php
         $select_pets = mysqli_query($conn, "SELECT * FROM `pets`") or die('query failed');
         if(mysqli_num_rows($select_pets) > 0){
            while($fetch_pet = mysqli_fetch_assoc($select_pets)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_pet['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_pet['name']; ?></div>
         
         
         
         
         <a href="admin_pet.php?delete=<?php echo $fetch_pet['id']; ?>" class="delete-btn" onclick="return confirm('delete this pet?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no pet added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-doctor-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `pets` WHERE id = '$update_id'") or die('query failed');
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