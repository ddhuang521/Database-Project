<?php

//require("phpsqlajax_dbinfo.php");

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$conn = mysqli_connect('localhost', 'root', '','proj1');
if (!$conn) {  die('Not connected : ' . mysqli_error());}

// Select all the rows in the markers table

session_start();
//Check if log in
if(!isset($_SESSION['userid'])){
    header("error.php");
    exit();
}

$uid = $_SESSION['userid'];
$username = $_SESSION['username'];

$coun = "select count(fid) as count from filter where uid = '$uid';";
$count_query = mysqli_query($conn, $coun);
$countf = mysqli_fetch_array($count_query);
        
if($countf['count']==0){

    $sql3 = "select distinct nperm,nlati, nlong, nid from (select * from Note natural join Friend natural left outer join Dayname) t1 join Track where 3959*acos( cos(radians(tlati)) * cos(radians(nlati)) * cos(radians(nlong)-radians(tlong)) + sin(radians(tlati)) * sin(radians(nlati))) < nrad and (tdate=ndate or dayofweek(tdate)=dday) and (ttime<=nend and ttime>=nstart) and (nperm=1 or (nperm=2 and friendid = '$uid') or (nperm=3 and t1.uid='$uid'))";
}
        
else        
{

$sql3 = "select distinct temp1.nperm,temp1.nlong, temp1.nlati,temp1.nid from (select * from (Note natural join Tag) natural left outer join Dayname) temp1 join (select * from Filter natural join Track natural join User natural join Friend) temp2 where 3959*acos(cos(radians(tlati)) * cos(radians(flati)) * cos(radians(flong)-radians(tlong)) + sin(radians(tlati)) * sin(radians(flati)))<frad and 3959*acos(cos(radians(tlati)) * cos(radians(nlati)) * cos(radians(nlong)-radians(tlong)) + sin(radians(tlati)) * sin(radians(nlati)))<nrad and tdate=fdate and ttime<=fend and ttime>=fstart and (tdate=ndate or dayofweek(tdate)=dday) and ttime<=nend and ttime>=nstart and ((ftag=tname and ustate=fstate) or (ftag='-1' and ustate=fstate) or (ftag=tname and fstate='-1') or (ftag='-1' and fstate='-1')) and ((fperm=1 and (nperm=1 or (nperm=2 and temp1.uid=friendid) or (nperm=3 and temp1.uid=temp2.uid))) or (fperm=2 and temp1.uid=friendid and (nperm=1 or nperm=2))) and temp2.uid= '$uid';";}
$result = mysqli_query($conn, $sql3);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = mysqli_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  //$newnode->setAttribute("test",$row['test']);
  //$newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("perm", $row['nperm']);
  $newnode->setAttribute("nid", $row['nid']);
  $newnode->setAttribute("lati", $row['nlati']);
  $newnode->setAttribute("long", $row['nlong']);
}

echo $dom->saveXML();

?>