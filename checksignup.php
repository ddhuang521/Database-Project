<?php
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

if(!isset($_POST['submit'])){
    exit('Invalid!');
}
$username = $_POST['user'];
$password = $_POST['pwd'];
$email = $_POST['email'];
//Valid info
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
    header("location:error.php");
    exit;
}
if(strlen($password) > 6){
    header("location:error.php");
    exit;
}


//Username existed or not
$check_query = mysqli_query($dbhandle, "select uid from user where username='$username' limit 1");
if(mysqli_fetch_array($check_query)){
    header("location:error.php");
    exit;
}
//write data
$password = $password;
$sql = "INSERT INTO user(username,email,password, ustate)VALUES('$username','$email','$password',
Null)";
if(mysqli_query($dbhandle, $sql)){
    header("location:successToLogin.php");
    exit;
} else {
    header("location:error.php");
}
?>