<?php

$doc_id = $_SESSION['doc_id'];
$sql="select * from doctor where id=$doc_id;";
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($res);
?>

<header class="header">

   <div class="flex">
   <a href="doctor_page.php" class="logo">DOCTOR PANEL</a>
    
	  

      <nav class="navbar">
         <a href="doctor_page.php">HOME</a>
         <a href="doctor_app.php">APPOINTMENTS</a>
         <a href="session.php">AVAILABILITY UPDATION</a>
		 <a href="logout.php" class="">LOGOUT</a>
      </nav>


      

     

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div align="centre" class="img_email">
<img style="border-radius :45px;" id="user-btn" width="40px" height="40px" src="uploaded_img\<?php echo $row[6]?>" alt="">
<p><?php echo $row[1]; ?></p>
<p><?php echo $row[3]; ?></p>
      </div>
      </div>

         
      </div>
  
</header>