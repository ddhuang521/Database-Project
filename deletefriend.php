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
$friendid = $_GET['friendid'];

$sql = "DELETE FROM Friend WHERE uid='$friendid' AND friendid = '$uid' AND fstate=1";
if(mysqli_query($dbhandle, $sql)){
    header("location:successToFriend.php");
    exit;
} else 
    header("location:error.php");

?>