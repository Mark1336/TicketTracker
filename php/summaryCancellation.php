<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: http://mark-angell.com/html/projectpages/demo/tickettracker/indexTT.php"); //Directs to root
    exit;
}

require_once "config.php";

include 'ticketTrackerMenu.php';

$entry_date = $_POST['entry_date'];

$queryReportAll = mysqli_query($link,"SELECT DISTINCT cancel_reason FROM CancellationReasonTable ORDER BY cancel_reason ASC");

while($resultReportAll = mysqli_fetch_array($queryReportAll))
{
  //echo "" . $resultReportAll[0] . "";
  $queryReportAllNums = "SELECT COUNT(cancel_reason) FROM CancellationReasonTable WHERE cancel_reason='$resultReportAll[0]' AND entry_date LIKE '$entry_date%'";
  $resultReportAllNums = mysqli_query($link, $queryReportAllNums); //Result og billing query
  $countReportAllNums = mysqli_fetch_array($resultReportAllNums);
  //echo "" . $countReportAllNums[0] . "";
  echo "" . $resultReportAll['cancel_reason'] . " | Reason Count: " . $countReportAllNums[0] . "<br/>";
  mysqli_free_result($resultReportAllNums);

  //echo "" . $resultReportAll['type'] . "";

}
mysqli_free_result($resultReportAll);

$result2 = mysqli_query($link,"SELECT cancel_reason, id_customer, comment, entry_date FROM CancellationReasonTable WHERE comment > '' AND entry_date LIKE '$entry_date%'");

echo "<table border='1'>
<tr>
<th>Cancellation Reason</th>
<th>Customer #</th>
<th>Comment</th>
<th>Date</th>
</tr>";

while($row = mysqli_fetch_array($result2)) //Row is not even being itterated?!? Yet it is..
{
echo "<tr>";
echo "<td>" . $row['cancel_reason'] . "</td>";
echo "<td>" . $row['id_customer'] . "</td>";
echo "<td>" . $row['comment'] . "</td>"; //the 'type' needs to match the table name. Here in '' needs to match table value name
echo "<td>" . $row['entry_date'] . "</td>";
echo "</tr>";
}
echo "</table>";
mysqli_free_result($result2);

mysqli_close($link);
?>
