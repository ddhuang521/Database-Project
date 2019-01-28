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
$content=$_POST['note'];
$perm=$_POST["nperm"];
$ndate=$_POST["ndate"];
$date=$_POST["notedate"];
$start=$_POST["nstart"];
$end=$_POST["nend"];
$rad=$_POST["nrad"];
$tag=$_POST["ntag"];
$lati=mysqli_query($dbhandle, "Select tlati From Track where uid='$uid'");
$long=mysqli_query($dbhandle, "Select tlong From Track where uid='$uid'");
$rlati = mysqli_fetch_array($lati);
$flati = $rlati['tlati'];
$rlong = mysqli_fetch_array($long);
$flong = $rlong['tlong'];

$sql = "INSERT INTO Note(uid,content,nlati,nlong,nrad,ndate,nstart,nend,nperm) VALUES ('$uid', '$content', '$flati', '$flong', '$rad', '$date', '$start', '$end', '$perm');";
if(mysqli_query($dbhandle, $sql)){
    $nid=mysqli_insert_id($dbhandle);
    if(!empty($tag)){
        foreach ((array)$tag as $t)
            { if(!empty($t)){
        mysqli_query($dbhandle, "insert into Tag(nid,tname) values ('$nid', '$t');");}
        }
    }
    if(!empty($ndate)) {
        foreach ((array)$ndate as $d)
            {
            mysqli_query($dbhandle, "insert into Dayname(nid,dday) values ('$nid', '$d');");
            }
        }
    
    
    header("location:successToMain.php");
    exit;
} else {
    header("location:error.php");
}

?>