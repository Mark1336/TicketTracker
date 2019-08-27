<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: http://mark-angell.com/html/projectpages/demo/tickettracker/indexTT.php"); //Directs to root
    exit;
}

require_once "config.php";

$cancelReason = mysqli_real_escape_string($link, $_REQUEST['cancelReason']);
$idCustomer = mysqli_real_escape_string($link, $_POST['idCustomer']);
$idTicket = mysqli_real_escape_string($link, $_POST['idTicket']);
$comment = mysqli_real_escape_string($link, $_POST['comment']);
$userID = mysqli_real_escape_string($link, $_SESSION['id']);

$sql = "INSERT INTO CancellationReasonTable(cancel_reason, id_customer, id_ticket, comment, id_user) VALUES('$cancelReason', '$idCustomer', '$idTicket', '$comment', '$userID')";

if(mysqli_query($link, $sql)){
  echo "Cancellation reason added successfully.";
}
else{
  echo "An error occured. Failure to submit entry to Cancellation Reason Table. MySQL Error:" . mysqli_error($link);
}

header("location: http://mark-angell.com/html/projectpages/demo/tickettracker/php/ticketTrackerCenter.php");
mysqli_close($link);
 ?>
