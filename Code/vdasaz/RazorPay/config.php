<?php

$keyId = 'rzp_test_7mFjUmMIl6IlYb';
$keySecret = 'onpFWsj8uebNZ4GUdzyFxQmx';
$displayCurrency = 'INR';

//These should be commented out in production
// This is for error reporting
// Add it to config.php to report any errors
error_reporting(E_ALL);
ini_set('display_errors', 1);


//DATABASE CONNECTION DETAILS
$conn = mysqli_connect('localhost','root','','vdas') or die('connection failed');