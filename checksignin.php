<?php
error_reporting(E_ALL & ~E_NOTICE);
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

//log out
if($_GET['action'] == "logout"){
    $uid=$_SESSION['userid'];
    $delete_query = mysqli_query($dbhandle, "Delete from Track where uid='$uid'");
    $delete_filter = mysqli_query($dbhandle, "Delete from Filter where uid='$uid'");
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    header("location:successToLogout.php");
    exit;
}

//log in
if(!isset($_POST['submit'])){
    exit('Invalid');
}
$username = ($_POST['user']);
$password = ($_POST['pwd']);

//Check info
$check_query = mysqli_query($dbhandle, "select uid from User where username='$username' and password='$password' ");
if($result = mysqli_fetch_array($check_query)){
    //login success
    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $result['uid'];
    header("location:map.php");
    exit;
} else {
    header("location:error.php");
    exit;
}
?>