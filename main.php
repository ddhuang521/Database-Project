<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Main Page</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/note.css">
<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
      <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    </head>
<body>
<form action="main.php" method="post">
      
        <h1>Welcome to Oingo</h1>
        
        <fieldset>
            <legend><span class="number">1</span><a href="friend.php">Friend</a></legend>
        </fieldset>
        
        <fieldset>
            <legend><span class="number">2</span><a href="writenote.php">Write my note</a></legend>
        </fieldset>
          
        <fieldset>
            <legend><span class="number">3</span><a href="setfilter.php">Set my filter</a></legend>
        </fieldset>
    <fieldset>
            <legend><span class="number">4</span><a href="checksignin.php?action=logout">Log out</a></legend>
    </fieldset>
          
    </form>
    

<form>
    <fieldset>
    <legend><span class="number">5</span>Notes</legend>
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

session_start();
//Check if log in
if(!isset($_SESSION['userid'])){
    header("error.php");
    exit();
}

$uid = $_SESSION['userid'];
$username = $_SESSION['username'];
        
$coun = "select count(fid) as count from filter where uid = '$uid';";
$count_query = mysqli_query($dbhandle, $coun);
$countf = mysqli_fetch_array($count_query);
        
if($countf['count']==0){

    $sql3 = "select distinct content, nid from (select * from Note natural join Friend natural left outer join Dayname) t1 join Track where 3959*acos( cos(radians(tlati)) * cos(radians(nlati)) * cos(radians(nlong)-radians(tlong)) + sin(radians(tlati)) * sin(radians(nlati))) < nrad and (tdate=ndate or dayofweek(tdate)=dday) and (ttime<=nend and ttime>=nstart) and (nperm=1 or (nperm=2 and friendid = '$uid') or (nperm=3 and t1.uid='$uid'))";
}
        
else        
{

$sql3 = "select distinct temp1.content,temp1.nid from (select * from (Note natural join Tag) natural left outer join Dayname) temp1 join (select * from Filter natural join Track natural join User natural join Friend) temp2 where 3959*acos(cos(radians(tlati)) * cos(radians(flati)) * cos(radians(flong)-radians(tlong)) + sin(radians(tlati)) * sin(radians(flati)))<frad and 3959*acos(cos(radians(tlati)) * cos(radians(nlati)) * cos(radians(nlong)-radians(tlong)) + sin(radians(tlati)) * sin(radians(nlati)))<nrad and tdate=fdate and ttime<=fend and ttime>=fstart and (tdate=ndate or dayofweek(tdate)=dday) and ttime<=nend and ttime>=nstart and ((ftag=tname and ustate=fstate) or (ftag='-1' and ustate=fstate) or (ftag=tname and fstate='-1') or (ftag='-1' and fstate='-1')) and ((fperm=1 and (nperm=1 or (nperm=2 and temp1.uid=friendid) or (nperm=3 and temp1.uid=temp2.uid))) or (fperm=2 and temp1.uid=friendid and (nperm=1 or nperm=2))) and temp2.uid= '$uid';";}

$note_query = mysqli_query($dbhandle, $sql3);

if (mysqli_num_rows($note_query) < 1){
    exit('No such notes.');
}

    while($row = mysqli_fetch_array($note_query))
    {
        echo "*<a href=addcomment.php?nid={$row[1]}>$row[0]</a>"; 
        echo "<br />";
    }

mysqli_free_result($note_query);
?>
    </fieldset>
    </form>

<form action="keyword.php" method="post">
        <fieldset>
            <legend><span class="number"></span>Add one key word</legend>
            <input type="text" name="keyword">
        </fieldset>
    <button type="submit">Add</button>
    </form>
    
    <div id="map"></div>

    <script>
      var customLabel = {
        1: {
          label: '1'
        },
        2: {
          label: '2'
        },
        3: {
          label: '3'
        },
        4: {
          label: '4'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(40.7179284, -73.9901252),
          zoom: 14
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('form_main.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              //var test = markerElem.getAttribute('test');
              //var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('perm');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lati')),
                  parseFloat(markerElem.getAttribute('long')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

//              var text = document.createElement('text');
//              text.textContent = test;
//              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
                                
            });
          });
        }


      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA65IHOB4oVchx-9JBR9sWIslwswV5TY-I&callback=initMap">
    </script>
    </body>
</html>