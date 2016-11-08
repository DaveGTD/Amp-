<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);


      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ['Case Reason', 'Avg New Equipment Cost', 'Count'],
         ['Additional Equipment', 113, 11 ],
         ['New Install', 125 , 2],
         ['Pull System', 502 , 31],
         ['System Trouble', 259, 7]
      ]);

    var options = {
      title : 'From Install to Case Resolved',
      vAxis: {title: 'Days Since Install + Number of cases'},
      hAxis: {title: 'Case Reasons'},
      seriesType: 'bars',
      series: {1: {type: 'line'}}
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
