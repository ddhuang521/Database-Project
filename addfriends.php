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
$username = $_POST["user"];

$check_query = mysqli_query($dbhandle, "select uid from User where username='$username'");

if (mysqli_num_rows($check_query) < 1){
    header("location:error.php");
    exit;
}
if($result = mysqli_fetch_array($check_query)){
    //user exists
    $friendid = $result['uid'];
    $request_query = mysqli_query($dbhandle, "insert into Friend(uid,friendid,fstate) values ('$uid','$friendid',1)");
    header("location:successToSent.php");
    exit;
}
else 
{
    header("location:errorToSent.php");
    exit;
}

?>