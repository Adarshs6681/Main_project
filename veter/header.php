<header class="header">

   <div class="header-1">
      <div class="flex">
        <p><a href="admin_login.php">ADMIN</a> || <a href="login.php">LOGIN</a> || <a href="signup-user.php">REGISTER</a> </p>
      </div>
   </div>

   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">VDAS</a>

         <nav class="navbar">
            <a href="home.php">HOME</a>
            <a href="about.php">ABOUT</a>
			<a href="doctor.php">DOCTOR</a>
            <a href="book.php">BOOK</a>
            <a href="appointments.php">APPOINTMENTS</a>
         </nav>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
		</div>	


         <div class="user-box">
            <p>USERNAME : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>EMAIL : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">LOGOUT</a>
         </div>
      </div>
   </div>

</header>