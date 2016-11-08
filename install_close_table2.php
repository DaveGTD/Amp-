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
$sql = "SELECT * FROM AmpService WHERE NewEquipmentTotalCost IS NOT NULL GROUP BY Technician";
$result = $conn->query($sql);
$numResults = $result->num_rows;
$counter = 0;

// add header
echo "<thead><tr> <th>Customer Name</th>  <th>ID-DR</th> <th>ID-DO</th> <th>DO-DR</th> <th>Total Cost</th>  <th>Case Reason</th>  <th>First Note</th> </tr></thead>";
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
      $account_status = $row['AccountStatus'];
      $first_note = $row['FirstNote'];


      // modify output
      $temp_sd = explode(" ", $install_date);
      $temp_do = explode(" ", $date_resolved);
      $sd = explode("/", $temp_sd[0]);
      $do = explode("/", $temp_do[0]);

      $date1 = new DateTime("$sd[2]-$sd[0]-$sd[1]");
      $date2 = new DateTime("$do[2]-$do[0]-$do[1]");
      $diff = $date2->diff($date1)->format("%a");

      $temp_sd2 = explode(" ", $sale_date);
      $temp_do2 = explode(" ", $date_opened);
      $sd2 = explode("/", $temp_sd2[0]);
      $do2 = explode("/", $temp_do2[0]);

      $date12 = new DateTime("$sd2[2]-$sd2[0]-$sd2[1]");
      $date22 = new DateTime("$do2[2]-$do2[0]-$do2[1]");
      $diff2 = $date22->diff($date12)->format("%a");


      echo "<tr>";
      echo " <td>$customer_name</td> <td>$diff</td> <td>$diff2</td> <td>$days_open</td> <td>$new_equipment_total_cost</td> <td>$case_reason</td> <td>$first_note</td> ";
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
