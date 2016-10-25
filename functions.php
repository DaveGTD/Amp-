<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";





function install_to_complain($conn)
{
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error)
  {
      die("Connection failed: " . $conn->connect_error);
  }

  //
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

        // modify output
        $temp_sd = explode(" ", $sale_date);
        $temp_do = explode(" ", $date_opened);
        $temp_sd_2 = explode("/", $temp_sd[0]);
        $temp_do_2 = explode("/", $temp_do[0]);

        var_dump($temp_sd_2);
        var_dump($temp_do_2);

    }
  }
  //
  else
  {
      echo "0 results";
  }

  $conn->close();

}

install_to_complain();
