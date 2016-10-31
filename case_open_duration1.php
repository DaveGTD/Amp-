<?php

// top 3 issues leading to early complain:
// 1. System pull
// 2. Skybell
// 3. Camera sensor



function days_open_and_cost()
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
  $sql = "SELECT SalesRep, Technician, CustomerName, DateOpened, DaysOpen, CaseReason, NewEquipmentTotalCost FROM AmpService WHERE NewEquipmentTotalCost IS NOT NULL GROUP BY Technician";
  $result = $conn->query($sql);
  $numResults = $result->num_rows;
  $counter = 0;

  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {
        $sales_rep = $row['SalesRep'];
        $technician = $row['Technician'];
        $days_open = (int)$row['DaysOpen'];
        $date_opened = $row['DateOpened'];
        $customer_name = $row['CustomerName'];
        $case_reason = $row['CaseReason'];
        $new_equipment_total_cost = (int)$row['NewEquipmentTotalCost'];

        $service_expense = $days_open * $new_equipment_total_cost;


        if (++$counter == $numResults)
        {
          // last row
          echo "[ '$technician' , $days_open, $new_equipment_total_cost, '$sales_rep', $service_expense, '$case_reason', '$date_opened', '$customer_name' ]";
        }
        else
        {
          // not last row
          echo "[ '$technician' , $days_open, $new_equipment_total_cost, '$sales_rep', $service_expense, '$case_reason', '$date_opened', '$customer_name' ],";
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
      google.charts.setOnLoadCallback(drawSeriesChart);

    function drawSeriesChart() {

      var data = google.visualization.arrayToDataTable([
        ['Technician', 'DaysOpen', 'Total Cost', 'SalesRep', 'Service Expense', 'Case Reason', 'Date Opened', 'Customer Name' ],
        <?php days_open_and_cost(); ?>
      ]);

      var options = {
        title: 'Correlation between life expectancy, fertility rate ' +
               'and population of some world countries (2010)',
        hAxis: {title: 'Life Expectancy'},
        vAxis: {title: 'Fertility Rate'},
        bubble: {textStyle: {fontSize: 11}}
      };

      var chart = new google.visualization.BubbleChart(document.getElementById('series_chart_div'));
      chart.draw(data, options);
    }
    </script>
  </head>
  <body>
    <div id="series_chart_div" style="width: 1400px; height: 1000px;"></div>
  </body>
</html>
