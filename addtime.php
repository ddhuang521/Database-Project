<?php
session_start();

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");

$dbhandle = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD);
if (!$dbhandle)
  {
  die('Could not connect: ' . mysql_error());
  }

$selected = mysqli_select_db($dbhandle, "proj1")
 or die ("Could not select examples");  

$uid=$_SESSION['userid'];
$date = $_POST['udate'];
$time = $_POST['utime'];
$state = $_POST['state'];

$request_query = mysqli_query($dbhandle, "UPDATE Track SET tdate='$date',ttime='$time' where uid='$uid'");
$insert_query = mysqli_query($dbhandle,"UPDATE User SET ustate='$state' where uid='$uid'");


    header("location:main.php");
    exit;


?>