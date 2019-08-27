<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: http://mark-angell.com/html/projectpages/demo/tickettracker/indexTT.php"); //Directs to root
    exit;
}
//Connect to data base
require_once "config.php";

include 'ticketTrackerMenu.php';

$entry_date = $_POST['entry_date'];


//Sum of Billing tickets for a given day
/*$queryBilling = "SELECT COUNT(type) FROM TicketEntryTable WHERE type='Billing' AND entry_date LIKE '$entry_date%'";
$resultBilling = mysqli_query($link, $queryBilling); //Result og billing query
$countBilling = mysqli_fetch_array($resultBilling);
echo "Billing Ticket Count: " . $countBilling[0] . "<br/>";
mysqli_free_result($resultBilling);

//Sum of Cancellation tickets for given day
$queryCancellation = "SELECT COUNT(type) FROM TicketEntryTable WHERE type='Cancellation' AND entry_date LIKE '$entry_date%'"; //SELECT MySQL script
$resultCancellation = mysqli_query($link, $queryCancellation); //Link to DB, SQL query
//mysqli_free_result($resultCancellation);
$countCancellation = mysqli_fetch_array($resultCancellation); //Fetchs the result as an array
echo "Cancellation Ticket Count: " . $countCancellation[0] . "<br/>";
mysqli_free_result($resultCancellation);

//Sum of Chat Confirmation tickets for a given day
$queryChatConfirmation = "SELECT COUNT(type) FROM TicketEntryTable WHERE type='ChatConfirmation' AND entry_date LIKE '$entry_date%'";
$resultChatConfirmation = mysqli_query($link, $queryChatConfirmation); //Result og billing query
$countChatConfirmation = mysqli_fetch_array($resultChatConfirmation);
echo "Chat Confirmation Ticket Count: " . $countChatConfirmation[0] . "<br/>";
mysqli_free_result($resultChatConfirmation);

//Sum of Pause Tickets
$queryPause = "SELECT COUNT(type) FROM TicketEntryTable WHERE type='Pause' AND entry_date LIKE '$entry_date%'";
$resultPause = mysqli_query($link, $queryPause); //Result og billing query
$countPause = mysqli_fetch_array($resultPause);
echo "Pause Ticket Count: " . $countPause[0] . "<br/>";
mysqli_free_result($resultPause);*/


//Summary wihtout repition
//SELECT DISTINCT type FROM TicketEntryTable ORDER BY type ASC;
//
$queryReportAll = mysqli_query($link,"SELECT DISTINCT type FROM TicketEntryTable ORDER BY type ASC");

while($resultReportAll = mysqli_fetch_array($queryReportAll))
{
  //echo "" . $resultReportAll[0] . "";
  $queryReportAllNums = "SELECT COUNT(type) FROM TicketEntryTable WHERE type='$resultReportAll[0]' AND entry_date LIKE '$entry_date%'";
  $resultReportAllNums = mysqli_query($link, $queryReportAllNums); //Result og billing query
  $countReportAllNums = mysqli_fetch_array($resultReportAllNums);
  echo "" . $resultReportAll['type'] . " Ticket Count: " . $countReportAllNums[0] . "<br/>";
  mysqli_free_result($resultReportAllNums);

  //echo "" . $resultReportAll['type'] . "";

}
mysqli_free_result($resultReportAll);

//$indexReportAll = mysqli_fetch_assoc($resultReportAll);

/*//Sum of
$query = "SELECT COUNT(type) FROM TicketEntryTable WHERE type='Billing' AND entry_date LIKE '$entry_date%'";
$result = mysqli_query($link, $query); //Result og billing query
$count = mysqli_fetch_array($result);
echo "Billing Ticket Count: " . $count[0] . "<br/>";
mysqli_free_result($result);
*/

/*//Sum of
$query = "SELECT COUNT(type) FROM TicketEntryTable WHERE type='Billing' AND entry_date LIKE '$entry_date%'";
$result = mysqli_query($link, $query); //Result og billing query
$count = mysqli_fetch_array($result);
echo "Billing Ticket Count: " . $count[0] . "<br/>";
mysqli_free_result($result);
*/

//Testing New Table Format
$result2 = mysqli_query($link,"SELECT type, entry_date FROM TicketEntryTable WHERE type='SDMLS'");

echo "<table border='1'>
<tr>
<th>typ</th>
<th>entry_date</th>
</tr>";

while($row = mysqli_fetch_array($result2)) //Row is not even being itterated?!? Yet it is..
{
echo "<tr>";
echo "<td>" . $row['type'] . "</td>"; //the 'type' needs to match the table name. Here in '' needs to match table value name
echo "<td>" . $row['entry_date'] . "</td>";
echo "</tr>";
}
echo "</table>";
mysqli_free_result($result2);



$query = "SELECT COUNT(type) FROM TicketEntryTable WHERE entry_date LIKE '$entry_date%'";
$result = mysqli_query($link, $query);


if(!$result){
     print "Error - The query could not be executed.";
     $error = mysql_error();
     print "<p>" . $error . "</p>";
     exit;
}
// Display the results in a table
print "<table> <caption> <h3> Ticket Information </h3>";
print" <h4> Ticket Type Entered: " . $entry_date . "</h4></caption>";
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
mysqli_free_result($result);

mysqli_close($link);
//Num Field Test
/*if ($resultCancellation=mysqli_query($link,$queryCancellation))
  {
  // Return the number of fields in result set
  $fieldcount=mysqli_num_fields($resultCancellation);
  printf("Result set has %d fields.\n",$fieldcount);
  // Free result set(Memory associatted with result)
  mysqli_free_result($queryCancellation);
}*/

/* //Alternative messy way of displaying the count
$resultBilling = mysqli_query($link, $queryBilling); //Result og billing query
// Get the first row
$firstRowBilling = mysqli_fetch_assoc($resultBilling);
// Get the number of fields
$num_fieldsBilling = mysqli_num_fields($resultBilling);
$valuesBilling = array_values($firstRowBilling);
for($i = 0; $i < $num_fieldsBilling; $i++){
     $valueBilling = htmlspecialchars($valuesBilling[$i]);
     print "Billing Ticket Count: " . $valueBilling . "";
}*/
?>
