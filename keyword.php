<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/note.css">
<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
<form>
    <fieldset>
    <legend><span class="number"></span>Notes</legend>
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
$keyword=$_POST["keyword"];

$sql = "select distinct temp1.content,temp1.nid from (select * from (Note natural join Tag) natural left outer join Dayname) temp1 join (select * from Filter natural join Track natural join User natural join Friend) temp2 where 3959*acos(cos(radians(tlati)) * cos(radians(flati)) * cos(radians(flong)-radians(tlong)) + sin(radians(tlati)) * sin(radians(flati)))<frad and 3959*acos(cos(radians(tlati)) * cos(radians(nlati)) * cos(radians(nlong)-radians(tlong)) + sin(radians(tlati)) * sin(radians(nlati)))<nrad and tdate=fdate and ttime<=fend and ttime>=fstart and (tdate=ndate or dayofweek(tdate)=dday) and ttime<=nend and ttime>=nstart and ((ftag=tname and ustate=fstate) or (ftag='-1' and ustate=fstate) or (ftag=tname and fstate='-1') or (ftag='-1' and fstate='-1')) and ((fperm=1 and (nperm=1 or (nperm=2 and temp1.uid=friendid) or (nperm=3 and temp1.uid=temp2.uid))) or (fperm=2 and temp1.uid=friendid and (nperm=1 or nperm=2))) and temp2.uid= '$uid' and temp1.content like '%$keyword%';";

$note_query = mysqli_query($dbhandle, $sql);

if (mysqli_num_rows($note_query) < 1){
    //header("location:failToShow.php");
    exit;
}

    while($row = mysqli_fetch_array($note_query))
    {
         echo "*<a href=addcomment.php?nid={$row[1]}>$row[0]</a>"; 
        echo "<br />";
    }

?>
    </fieldset>
</form>
<form action="keyword.php" method="post">
        <fieldset>
            <legend><span class="number"></span>Add one key word</legend>
            <input type="text" name="keyword">
        </fieldset>
    <button type="submit">Add</button>
    <fieldset>
            <legend><span class="number"></span><a href="main.php">Back to main page</a></legend>
    </fieldset>
</form>
