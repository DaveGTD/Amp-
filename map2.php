<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('upcoming', {packages: ['map']});
    google.charts.setOnLoadCallback(drawMap);

    function drawMap () {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Address');
      data.addColumn('string', 'Location');
      data.addColumn('string', 'Marker')

      data.addRows([
        ['Alameda CA, United States', 'California',   'blue' ],
        ['Contra Costa CA, United States',      'California',   'green'],
        ['Napa CA, United States',    'California', 'pink' ],
        ['Riverside CA, United States',  'California',     'green'],
        ['Sacramento CA, United States',    'California', 'green'],
        ['San Joaquin CA, United States',       'California',    'blue' ],
        ['San Mateo CA, United States',     'California',  'pink' ],
        ['Santa Clara CA, United States',        'California',     'blue' ],
        ['Solano CA, United States',     'California',  'green']
      ]);
      var url = 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/48/';

      var options = {
        zoomLevel: 6,
        showTooltip: true,
        showInfoWindow: true,
        useMapTypeControl: true,
        icons: {
          blue: {
            normal:   url + 'Map-Marker-Ball-Azure-icon.png',
            selected: url + 'Map-Marker-Ball-Right-Azure-icon.png'
          },
          green: {
            normal:   url + 'Map-Marker-Push-Pin-1-Chartreuse-icon.png',
            selected: url + 'Map-Marker-Push-Pin-1-Right-Chartreuse-icon.png'
          },
          pink: {
            normal:   url + 'Map-Marker-Ball-Pink-icon.png',
            selected: url + 'Map-Marker-Ball-Right-Pink-icon.png'
          }
        }
      };
      var map = new google.visualization.Map(document.getElementById('map_div'));

      map.draw(data, options);
    }
  </script>
</head>
<body>
  <div id="map_div" style="height: 500px; width: 900px"></div>
</body>
</html>
