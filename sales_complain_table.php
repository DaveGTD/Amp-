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
$sql = "SELECT SalesRep, Technician, CustomerName, SaleDate, DateOpened, FirstNote FROM AmpService GROUP BY SalesRep";
$result = $conn->query($sql);
$numResults = $result->num_rows;
$counter = 0;

// add header
echo "<thead><tr> <th>Sales Rep</th> <th>Technician</th> <th>Days from Setup</th> <th>Sale Date</th> <th>Date Opened</th> <th>Customer Name</th> <th>First Note</th> </tr></thead>";
echo "<tbody>";

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

      // modify output
      $temp_sd = explode(" ", $sale_date);
      $temp_do = explode(" ", $date_opened);
      $sd = explode("/", $temp_sd[0]);
      $do = explode("/", $temp_do[0]);

      $date1 = new DateTime("$sd[2]-$sd[0]-$sd[1]");
      $date2 = new DateTime("$do[2]-$do[0]-$do[1]");
      $diff = $date2->diff($date1)->format("%a");

      echo "<tr>";
      echo "<td>$sales_rep</td> <td>$technician</td> <td>$diff</td> <td>$sale_date</td> <td>$date_opened</td> <td>$customer_name</td> <td>$first_note</td>";
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
