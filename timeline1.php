<?php

// top 3 issues leading to early complain:
// 1. System pull
// 2. Skybell
// 3. Camera sensor

function display_data()
{
  echo "<strong> <h3> Top 3 issues leading to early service request </h3> </strong> <br>";
  echo " 1. System Pull <br>";
  echo " 2. Skybell <br>";
  echo " 3. Camera sensor <br>";
}

function install_to_complain()
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
  $sql = "SELECT SalesRep, Technician, CustomerName, SaleDate, DateOpened FROM AmpService GROUP BY Technician";
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

        // echo "$sales_rep $technician $customer_name $sale_date $date_opened \n ";

        // modify output
        $temp_sd = explode(" ", $sale_date);
        $temp_do = explode(" ", $date_opened);
        $sd = explode("/", $temp_sd[0]);
        $do = explode("/", $temp_do[0]);


        if (++$counter == $numResults)
        {
          // last row
          echo "[ '$customer_name' , '$sales_rep', new Date($sd[2], $sd[0], $sd[1]) , new Date($do[2], $do[0], $do[1]) ]";
        }
        else
        {
          // not last row
          echo "[ '$customer_name' , '$sales_rep', new Date($sd[2], $sd[0], $sd[1]) , new Date($do[2], $do[0], $do[1]) ], ";
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
      google.charts.load('current', {'packages':['timeline']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var container = document.getElementById('timeline');
        var chart = new google.visualization.Timeline(container);
        var dataTable = new google.visualization.DataTable();

        dataTable.addColumn({ type: 'string', id: 'Customer' });
        dataTable.addColumn({ type: 'string', id: 'SalesRep' });
        dataTable.addColumn({ type: 'date', id: 'Start' });
        dataTable.addColumn({ type: 'date', id: 'End' });
        dataTable.addRows([ <?php install_to_complain() ?> ]);


        var options = {
                timeline: { showRowLabels: true },
                avoidOverlappingGridLines: true
              };

        chart.draw(dataTable, options);
      }
    </script>
    <style>
    .data{
      backgroud-color:#33ccff;
    }
    </style>
  </head>
  <body>
    <div id="data">
      <?php display_data() ?>
    </div>
    <br><br>
    <div id="timeline" style="height: 2000px;"></div>
  </body>
</html>
