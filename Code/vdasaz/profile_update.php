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
  $query="select * from users where id=$user_id";
  $query_exe=mysqli_query($conn,$query);
  while( $row=mysqli_fetch_array($query_exe)){

  
 


  ?>
  
    <div class="container11">
        <h1 class="w3-padding-32 w3-center">Update user details</h1>
<form method="post" action="#" enctype="multipart/form-data" >


  <div class="input-group1"> 
        <label for="name">Name</label>
      <input type="text" name="name" placeholder="enter your name" value="<?php echo $row[1];?>"  id = "nme" required class="box" required maxlength="20" onchange="Validate();">
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
	 
  <div class="input-group1"> 
        <label for="number">Mobile Number</label>
	  
      <input type="number" name="number" value="<?php echo $row[2];?>" placeholder="enter your number" id="num" required class="box" required onchange="return Valid();">
	  </div>
	  <span id="msg3" style="color:red;"></span>
<script>		
function Valid() 
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
  <div class="input-group1"> 
        <label for="email">Email</label>
	  
      <input readonly type="email" name="email" value="<?php echo $row[3];?>" placeholder="enter your email" id="email" required class="box" required onchange="Validata();">
	  </div>
	  <span id="msg15" style="color:red;"></span>
    <br>

  <div class="form-row">
   
  <input style="margin-left :90px" type="file" name="photo" value="<?php echo $row[4];?>" class="box" required>
  </div>

<br>
<div class="input-group1">
 <input type="submit" class="btn" name="submit" id="enter"  value="Update Details">
</div>

</form>

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
 
      
  </div>
 <?php
 $_SESSION['ph']=$row[4];
}
?>
</body>
<?php
$uid=$_GET['uid'];
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$number = $_POST['number'];
	$email = $_POST['email'];
	
	
	if($_FILES["photo"]["name"]!=NULL)
	{
  $filename=$_FILES["photo"]["name"];
  $tmpname=$_FILES["photo"]["tmp_name"];
  $folder="uploaded_img/".$filename;
move_uploaded_file($tmpname,$folder);
	}
	else
	{
		$filename=$_SESSION['ph'];
	}
	$insert="UPDATE `users` SET `name`=' $name',`number`='$number',`email`='$email', `image`='$filename' WHERE id='$uid'";
	$result=mysqli_query($conn,$insert);
	echo"<script>alert('Updated')</script>";
}
?>
</html>