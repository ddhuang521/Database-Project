<!DOCTYPE html>
<html>
<head>
<title>Add comment</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/note.css">
<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
<body>
<form action="comment.php" method="post">
      
        <h1>Add comment</h1>
        
    <fieldset>
          <legend><span class="number">1</span>Note</legend>
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
        
$nid = $_GET['nid'];
        echo "Note number: ";
        echo $nid;
        echo "<br/>";

$username = mysqli_query($dbhandle, "select username,content from Note natural join User where nid='$nid'");

 $row = mysqli_fetch_array($username);
    echo $row['username'];
    echo "<br />";    
    echo $row['content'];
    echo "<br />";  
?>
    </fieldset>
       <fieldset>
          <legend><span class="number">2</span>Comments</legend>
<?php

$request_query = mysqli_query($dbhandle, "select username, cdesc from Comment natural join User where nid='$nid'");
        
if (mysqli_num_rows($request_query) < 1){
       echo "No comment for this note.";
}
else {
    while($row = mysqli_fetch_array($request_query))
    {
        echo $row['username'];
        echo ": ";
    echo $row['cdesc'];
    echo "<br />";  
    } 
}
?>
    </fieldset>
   
        <fieldset>
          <legend><span class="number">3</span>Your comment</legend>
            Note number: <input type="number" name="nid"><br/>
          Comment: <textarea name="comment" clos="25" rows="5" warp="virtual"></textarea>
        </fieldset>
    
    <button type="submit">Add my comment!</button>
    </form>     
        
</body>
</html>