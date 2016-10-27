<?php


function new_equipment_cost()
{
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "test";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error)
  {
      echo "Connection failed: " . $conn->connect_error;
  }

  //
  $sql = "select * from AmpService where NewEquipmentList is not null";
  $result = $conn->query($sql);
  $numResults = $result->num_rows;
  $counter = 0;

  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {
        $sales_rep = $row['SalesRep'];
        $technician = $row['Technician'];
        $sale_date = $row['SaleDate'];
        $date_opened = $row['DateOpened'];
        $customer_name = $row['CustomerName'];
        $first_note = $row['FirstNote'];
        $new_equipment_list = $row['NewEquipmentList'];
        $new_equipment_total_cost = $row['NewEquipmentTotalCost'];




        if (++$counter == $numResults)
        {
          // last row

        }
        else
        {
          // not last row

        }

    }
  }
  //
  else
  {
      echo "0 results";
  }

 $conn->close();

}

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Director (Year)',  'Rotten Tomatoes', 'IMDB'],
          ['Alfred Hitchcock (1935)', 8.4,         7.9],
          ['Ralph Thomas (1959)',     6.9,         6.5],
          ['Don Sharp (1978)',        6.5,         6.4],
          ['James Hawes (2008)',      4.4,         6.2]
        ]);

        var options = {
          title: 'The decline of \'The 39 Steps\'',
          vAxis: {title: 'Accumulated Rating'},
          isStacked: true
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <br><br>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>
