<?php

$user_id = $_SESSION['user_id'];
$sql="select * from users where id=$user_id;";
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($res);
?>

<header class="header">

   <div class="header-1">
      <div class="flex">
        <p><a href="profile_update.php?<?php echo "uid=".$user_id?>"></a> </p>
        <p><a href="change password.php?<?php echo "uid=".$user_id?>"></a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">VDAS</a>

         <nav class="navbar">
            <a href="home.php">HOME</a>
            <a href="about.php">ABOUT</a>
			
            <a href="book.php">BOOK</a>
            <a href="appointments.php">APPOINTMENTS</a>
			<a href="shop.php">ADOPT PETS</a>
			
         </nav>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div><!-- 
            <div id="user-btn" class="fas fa-user"></div> -->
            <div align="centre" class="img_email">
<img style="border-radius :45px;" id="user-btn" width="40px" height="40px" src="uploaded_img\<?php echo $row['image']?>" alt="">
<p><?php echo $_SESSION['user_name']; ?></p>
<p><?php echo $_SESSION['user_email']; ?></p>
		</div>
      </div>	


         <div class="user-box">
		    <p><a href="profile_update.php?<?php echo "uid=".$user_id?>">Update</a> </p>
            <a href="logout.php" class="delete-btn">LOGOUT</a>
         </div>
      </div>
   </div>

</header>