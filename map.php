<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Map</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 80%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 80%;
        width: 80%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>
      Choose your location
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
          downloadUrl('form_test.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
                
                map.addListener('click', function(e) {
                    placeMarker(e.latLng, map);
                });
                                
                function placeMarker(position, map) {                    
                    var marker = new google.maps.Marker({
                        position: position,
                        map: map
                    });
                    map.panTo(position);
                    
                    var xhttp = new XMLHttpRequest();
                    var url = "addlocation.php?ulat="+position.lat()+"&ulng="+position.lng();
                    window.location.href = url;
                    xhttp.open('GET',url,true);
                    xhttp.send();
                }
                                
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
