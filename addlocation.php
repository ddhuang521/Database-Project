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
$ulat = $_GET['ulat'];
$ulng = $_GET['ulng'];


$request_query = mysqli_query($dbhandle, "insert into Track(uid,tlati,tlong) values ('$uid','$ulat','$ulng')");


    header("location:time.php");
    exit;


?>