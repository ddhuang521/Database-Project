<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/note.css">
<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>

<form action="addfriends.php" method="post">
  <fieldset>
    <legend><span class="number">1</span>Friend Request</legend>
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

$request_query = mysqli_query($dbhandle, "select u.uid, username from Friend f join User u on u.uid = f.uid where friendid=$uid and fstate=1");

if (mysqli_num_rows($request_query) < 1){
       echo "You do not have friend request.";
}
else {
    while($row = mysqli_fetch_array($request_query))
    {
        echo $row['username'];
        echo "<br />";
        echo "<a href=friendconfirm.php?friendid={$row[0]}>Add this friend</a>";
        echo " ";
        echo "<a href=deletefriend.php?friendid={$row[0]}>Delete this request</a>";
        echo "<br />";
    } 
}

?>
</fieldset>
    <fieldset>
    <legend><span class="number">2</span>My Friend</legend>
<?php
$check_query = mysqli_query($dbhandle, "select username from ((select friendid from Friend where uid = $uid and fstate=0) union (select uid from Friend where friendid = $uid and fstate=0)) as fri join User as u where fri.friendid = u.uid");

if (mysqli_num_rows($check_query) < 1){
    echo 'You do not have friend. <a href="javascript:history.back(-1);">Try again</a><br/>';
}

    while($row = mysqli_fetch_array($check_query))
    {
        echo $row['username'];
        echo "<br />";
    } 


mysqli_free_result($check_query);


?>
    </fieldset>    
     <fieldset>
          <legend><span class="number">3</span><a href="main.php">Back to main page</a></legend>
    </fieldset>
</form>


<form action="addfriends.php" method="post">
  <fieldset>
          <legend><span class="number">4</span>You can send your friend request today!</legend>
         <input type="text" name="user" placeholder="Username">
        </fieldset>
      <button type="submit">Send request</button>
</form>
