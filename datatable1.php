<html>
  <head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
   google.charts.load("current", {packages:['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Name', 'Number'],
        ['Ramanujan', 1729],
        ['Gauss', 5050]
      ]);
    var csv = google.visualization.dataTableToCsv(data);
    console.log(csv);
  }
  </script>
  </head>
</html>
