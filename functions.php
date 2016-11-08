<?php


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
  $sql = "SELECT SalesRep, Technician, CustomerName, SaleDate, DateOpened FROM AmpService LIMIT 1";
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

        // echo "$sales_rep $technician $customer_name $sale_date $date_opened \n ";

        // modify output
        $temp_sd = explode(" ", $sale_date);
        $temp_do = explode(" ", $date_opened);
        $sd = explode("/", $temp_sd[0]);
        $do = explode("/", $temp_do[0]);


        if (++$counter == $numResults)
        {
          // last row
          echo "[ '$customer_name' , new Date($sd[2], $sd[0], $sd[1]) , new Date($do[2], $do[0], $do[1]) ]";
        }
        else
        {
          // not last row
          echo "[ '$customer_name' , new Date($sd[2], $sd[0], $sd[1]) , new Date($do[2], $do[0], $do[1]) ], ";
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

// install_to_complain();



function install_close()
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
        $install_date = $row['InstallDate'];
        $date_resolved = $row['DateResolved'];


        // modify output
        $temp_sd = explode(" ", $install_date);
        $temp_do = explode(" ", $date_resolved);
        $sd = explode("/", $temp_sd[0]);
        $do = explode("/", $temp_do[0]);

        $date1 = new DateTime("$sd[2]-$sd[0]-$sd[1]");
        $date2 = new DateTime("$do[2]-$do[0]-$do[1]");
        $diff = $date2->diff($date1)->format("%a");

        echo $date1 . " " . $date2 . "\n";


    }
  }
  //
  else
  {
      echo "0 results";
  }

}
