<?php

//require("phpsqlajax_dbinfo.php");

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

//define("DB_SERVER", "localhost");
//define("DB_USER", "root");
//define("DB_PASSWORD", "");
//
//$dbhandle = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD);
//if (!$dbhandle)
//  {
//  die('Could not connect: ' . mysql_error());
//  }
//
//$selected = mysqli_select_db($dbhandle, "proj1")
// or die ("Could not select examples");  
//
//// Select all the rows in the markers table
//
//$query = "SELECT * FROM Note";
//$result = mysqli_query($dbhandle, $query);
//if (!$result) {
//  die('Invalid query: ' . mysql_error());
//}

$conn = mysqli_connect('localhost', 'root', '','proj1');
if (!$conn) {  die('Not connected : ' . mysqli_error());}

// Select all the rows in the markers table

$query = "SELECT * FROM Note WHERE 1";
$result = mysqli_query($conn, $query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = mysqli_fetch_assoc($result)){
    echo $row['nid'];
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id",$row['nid']);
  $newnode->setAttribute("content",$row['content']);
  //$newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("lati", $row['nlati']);
  $newnode->setAttribute("long", $row['nlong']);
  $newnode->setAttribute("type", $row['type']);
}

echo $dom->saveXML();

?>