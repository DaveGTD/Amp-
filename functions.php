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

install_to_complain();
