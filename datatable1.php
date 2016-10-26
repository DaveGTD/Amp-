<html>
  <head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  // ------- Version 1------------
  // Add rows + data at the same time
  // -----------------------------
  var data = new google.visualization.DataTable();

  // Declare columns
  data.addColumn('string', 'Employee Name');
  data.addColumn('datetime', 'Hire Date');

  // Add data.
  data.addRows([
    ['Mike', {v:new Date(2008,1,28), f:'February 28, 2008'}], // Example of specifying actual and formatted values.
    ['Bob', new Date(2007,5,1)],                              // More typically this would be done using a
    ['Alice', new Date(2006,7,16)],                           // formatter.
    ['Frank', new Date(2007,11,28)],
    ['Floyd', new Date(2005,3,13)],
    ['Fritz', new Date(2011,6,1)]
  ]);



  // ------- Version 2------------
  // Add empty rows, then populate
  // -----------------------------
  var data = new google.visualization.DataTable();
    // Add columns
    data.addColumn('string', 'Employee Name');
    data.addColumn('date', 'Start Date');

    // Add empty rows
    data.addRows(6);
    data.setCell(0, 0, 'Mike');
    data.setCell(0, 1, {v:new Date(2008,1,28), f:'February 28, 2008'});
    data.setCell(1, 0, 'Bob');
    data.setCell(1, 1, new Date(2007, 5, 1));
    data.setCell(2, 0, 'Alice');
    data.setCell(2, 1, new Date(2006, 7, 16));
    data.setCell(3, 0, 'Frank');
    data.setCell(3, 1, new Date(2007, 11, 28));
    data.setCell(4, 0, 'Floyd');
    data.setCell(4, 1, new Date(2005, 3, 13));
    data.setCell(5, 0, 'Fritz');
    data.setCell(5, 1, new Date(2007, 9, 2));
  </script>
  </head>
</html>
