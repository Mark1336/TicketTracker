<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: http://mark-angell.com/html/projectpages/demo/tickettracker/indexTT.php"); //Directs to root
    exit;
}
//Connect to database
require_once "config.php";

$ticketType = $_POST['ticketType'];
$entry_date = $_POST['entry_date'];
$ticketType = stripcslashes($ticketType);
$ticketType_html = htmlspecialchars($ticketType);
$query = "SELECT * FROM TicketEntryTable WHERE type = '$ticketType_html' AND entry_date LIKE '$entry_date%'";
$result = mysqli_query($link, $query);

if(!$result){
     print "Error - The query could not be executed.";
     $error = mysql_error();
     print "<p>" . $error . "</p>";
     exit;
}
// Display the results in a table
print "<table> <caption> <h3> Ticket Information </h3>";
print" <h4> Ticket Type Entered: " . $ticketType_html . "</h4></caption>";
print "<tr align = 'center'>";
// Get the number of rows in the result
$num_rows = mysqli_num_rows($result);
// If there are rows in the result, put them in an HTML table
if($num_rows > 0){
     // Get the first row
     $firstRow = mysqli_fetch_assoc($result);
     // Get the number of fields
     $num_fields = mysqli_num_fields($result);
     // Get the column names
     $keys = array_keys($firstRow);
     // Display column names
     for($index = 0; $index < $num_fields; $index++){
          print "<th>" . $keys[$index] . "</th>";
     }

     print "</tr>";     // End table row for column headers
     // Display the values of each field in the row
     for($row_num = 0; $row_num < $num_rows; $row_num++){
          print "<tr>";
          $values = array_values($firstRow);
          for($i = 0; $i < $num_fields; $i++){
               $value = htmlspecialchars($values[$i]);
               print "<td>" . $value . "</td>";
          }
          print "</tr>";
          $firstRow = mysqli_fetch_assoc($result);
     }
}
else{
     print "That row wasn't found in the teams table. <br />";
}
// Close table
print "</table>";
mysqli_close($link);
?>
