<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);


      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ['Case Reason', 'Avg', 'Count'],
         ['Additional Equipment', 6, 11 ],
         ['New Install', 23, 2],
         ['Pull System', 11, 31],
         ['System Trouble', 21, 7]
      ]);

    var options = {
      title : 'From Install to Case Resolved',
      vAxis: {title: 'Service Requests'},
      hAxis: {title: 'Case Reasons'},
      seriesType: 'bars',
      series: {2: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
