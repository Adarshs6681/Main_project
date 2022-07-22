<?php

session_start();

// initializing variables
$name = "";
$number = "";
$email = "" ;
$image = "";


// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'vdas');

// REGISTER USER
if (isset($_POST['users'])) {
// receive all input values from the form
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];



$filename=$_FILES["photo"]["name"];
$tmpname=$_FILES["photo"]["tmp_name"];
 $folder="uploaded_img/".$filename;
move_uploaded_file($tmpname,$folder);


// first check the database to make sure 
// a user already exist with the same username and/or email
$user_check_query = "SELECT * FROM users WHERE name='$name' OR email='$email'  LIMIT 1";
$result =  mysqli_query($db, $user_check_query);
if ($result === FALSE) 
{
die(mysqli_error($connect));
}
$user = mysqli_fetch_assoc($result);

if ($user) 
{ 
    // if user exists update the details in the database
    $email = $email;
    $query =  "UPDATE users SET name='$name',number='$number',email='$email', image='$image'";
  
}

}


?>