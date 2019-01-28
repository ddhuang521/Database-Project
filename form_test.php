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

$query = "SELECT * FROM Note WHERE 1";
$result = mysqli_query($conn, $query);
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