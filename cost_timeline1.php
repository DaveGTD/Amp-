<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);


      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ['Time', 'Maintainence', 'Malfunction', 'Other', 'Total'],
         ['2015 Summer', 2, 0, 1, 3 ],
         ['2015 Fall',  6, 3, 0, 9],
         ['2015 Winter', 0, 7, 2, 9 ],
         ['2016 Spring', 7, 1, 3, 11],
         ['2016 Summer' 10, 4, 5, 19],
         ['2016 Fall' 16, 5, 7, 28],
         ['2016 Winter' 0, 1, 1, 2]
      ]);

    var options = {
      title : 'Monthly Coffee Production by Country',
      vAxis: {title: 'Cups'},
      hAxis: {title: 'Month'},
      seriesType: 'bars',
      series: {5: {type: 'line'}}
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
