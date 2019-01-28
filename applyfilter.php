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
$date=$_POST["filterdate"];
$start=$_POST["fstart"];
$end=$_POST["fend"];
$lati=$_POST["flati"];
$long=$_POST["flong"];
$rad=$_POST["frad"];
$tag=$_POST["ftag"];
$state=$_POST["fstate"];
$perm=$_POST["fperm"];

$sql = "insert into Filter(uid,flati,flong,frad,fdate,fstart,fend,ftag,fstate,fperm) 
values('$uid', '$lati', '$long', '$rad', '$date', '$start', '$end', '$tag', '$state', '$perm');";
if(mysqli_query($dbhandle, $sql)){
    header("location:successToMain.php");
    exit;
} else {
    header("location:error.php");
}

?>