<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}




function install_to_complain($conn)
{

  $sql = "SELECT SalesRep, Technician, SaleDate, DateOpened FROM AmpService LIMIT 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc())
    {
        $sales_rep = $row['SalesRep'];
        $technician = $row['Technician'];
        $sale_date = $row['SaleDate'];
        $date_opened = $row['DateOpened'];

        echo "$sales_rep $technician $sale_date $date_opened "; 
    }
  }
  else
  {
      echo "0 results";
  }

}









$conn->close();
