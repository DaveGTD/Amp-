<html>
<head>
  <title> TermX </title>

</head>

<body>
<script src="resources/jquery-1.12.3.js"></script>
<script src="resources/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="resources/jquery.dataTables.min.css">

<script>

  $(document).ready(function()
  {
    $('#example').DataTable();
  } );

</script>


<table id="example" class="display" cellspacing="0" width="100%">
<?php

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
$sql = $sql = "SELECT * FROM AmpService GROUP BY Customer";
$result = $conn->query($sql);
$numResults = $result->num_rows;
$counter = 0;

// add header
echo "<thead><tr>  <th>Technician</th> <th>Sales Rep</th> <th>Days </th> <th>Total Cost</th> <th>Date Installed</th> <th>Date Resolved</th>  <th>Case Reason</th>  <th>Customer Name</th> </tr></thead>";
echo "<tbody>";

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
      $install_date = $row['InstallDate'];
      $date_resolved = $row['DateResolved'];
      $first_note = $row['FirstNote'];

      // modify output
      $temp_sd = explode(" ", $sale_date);
      $temp_do = explode(" ", $date_opened);
      $sd = explode("/", $temp_sd[0]);
      $do = explode("/", $temp_do[0]);

      $date1 = new DateTime("$sd[2]-$sd[0]-$sd[1]");
      $date2 = new DateTime("$do[2]-$do[0]-$do[1]");
      $diff = $date2->diff($date1)->format("%a");


      echo "<tr>";
      echo " <td>$technician</td> <td>$sales_rep</td> <td>$days_open</td> <td>$new_equipment_total_cost</td> <td>$install_date</td> <td>$date_resolved</td> <td>$case_reason</td> <td>$customer_name</td> ";
      echo "</tr>";


  }
}
//
else
{
    echo "0 results";
}

echo "</tbody>";


$conn->close();
?>
</table>

</body>

</html>
