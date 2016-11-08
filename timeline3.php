<?php

// top 3 issues leading to early complain:
// 1. System pull
// 2. Skybell
// 3. Camera sensor



function install_to_close()
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
  $sql = "SELECT * FROM AmpService GROUP BY CaseReason, Technician ORDER BY CaseReason";
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
        $install_date = $row['InstallDate'];
        $date_resolved = $row['DateResolved'];
        $case_reason = $row['CaseReason'];

        // echo "$sales_rep $technician $customer_name $sale_date $date_opened \n ";

        // modify output
        $temp_sd = explode(" ", $install_date);
        $temp_do = explode(" ", $date_resolved);
        $sd = explode("/", $temp_sd[0]);
        $do = explode("/", $temp_do[0]);


        if (++$counter == $numResults)
        {
          // last row
          echo "[ '$case_reason' , '$customer_name', new Date($sd[2], $sd[0], $sd[1]) , new Date($do[2], $do[0], $do[1]) ]";
        }
        else
        {
          // not last row
          echo "[ '$case_reason' , '$customer_name', new Date($sd[2], $sd[0], $sd[1]) , new Date($do[2], $do[0], $do[1]) ], ";
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

        dataTable.addColumn({ type: 'string', id: 'CaseReason' });
        dataTable.addColumn({ type: 'string', id: 'Customer' });
        dataTable.addColumn({ type: 'date', id: 'Start' });
        dataTable.addColumn({ type: 'date', id: 'End' });
        dataTable.addRows([ <?php install_to_close() ?> ]);


        var options = {
                timeline: { showRowLabels: true },
                avoidOverlappingGridLines: true
              };

        chart.draw(dataTable, options);
      }
    </script>

    <style>
    #data {
      background: #42d7f4;
      font-family: monaco;
    }
    </style>

  </head>
  <body>
    <div id="data">
      <h3> Install thru Close by Case </h3>


    <br>
    <div id="timeline" style="height: 2000px;"></div>
  </body>
</html>
