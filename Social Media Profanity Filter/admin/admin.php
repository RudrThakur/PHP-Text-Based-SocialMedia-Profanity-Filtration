<?php   

// Authentication detail for connection
require_once("config.php");
$tablename =  "user";
$orderby = "1 DESC LIMIT 500";  // column # to sort & max # of records to display

// Run query & verify success
$sql = "SELECT * FROM {$tablename} ORDER BY {$orderby}";
if ($result = $conn->query($sql)) {
    $conn->close();  // Close table
    $fields_num = $result->field_count;
    $count_rows = $result->num_rows;

    if ($count_rows == 0) {
        die ("No data found in table: [" . $tablename . "]" );  //quit 
        } 
    } else {
    $conn->close();  // Close table
    die ("Error running SQL:<br>" . $sql );  //quit
}

// Start drawing table
echo "<!DOCTYPE html><html><head><title>{$tablename}</title>";
echo "<style> table, th, td { border: 1px solid black; border-collapse: collapse; }</style></head>";
echo "<body><span style='font-size:20px'>Table: <strong>{$tablename}</strong></span><br>";  
echo "<span style='font-size:15px'>({$count_rows} records, {$fields_num} fields)</span><br>";
echo "<br><span style='font-size:15px'><table><tr>";        

// Print table Field Names
while ($finfo = $result->fetch_field()) {
    echo "<td><center><strong>{$finfo->name}</strong></center></td>";
}
echo "</tr>"; // Finished Field Names

/* Loop through records in object array */
while ($row = $result->fetch_row()) {
    echo "<tr>";    // start data row
    for( $i = 0; $i<$fields_num; $i++ ) {
        echo "<td>{$row[$i]}</td>";
        
    }
    echo "</tr>";   // end data row
}

echo "</table>";  // End table
$result->close();  // Free result set
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<br><br>
    <a href="logout.php">Logout</a>
</body>
</html>