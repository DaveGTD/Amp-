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
$sql = $sql = "SELECT SalesRep, Technician, CustomerName, DateOpened, DaysOpen, CaseReason, NewEquipmentTotalCost FROM AmpService WHERE NewEquipmentTotalCost IS NOT NULL GROUP BY Technician";
$result = $conn->query($sql);
$numResults = $result->num_rows;
$counter = 0;

// add header
echo "<thead><tr>  <th>Technician</th> <th>Sales Rep</th> <th>Days Open</th> <th>Total Cost</th> <th>Date Opened</th>  <th>Case Reason</th>  <th>Customer Name</th> </tr></thead>";
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


      echo "<tr>";
      echo " <td>$technician</td> <td>$sales_rep</td> <td>$days_open/td> <td>$new_equipment_total_cost</td> <td>$date_opened</td> <td>$case_reason</td> <td>$customer_name</td> ";
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
