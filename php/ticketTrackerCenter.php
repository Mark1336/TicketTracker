<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: http://mark-angell.com/html/projectpages/demo/tickettracker/indexTT.php"); //Directs to root
    exit;
}

//Experimenting with timeout duration
//Source: https://solutionfactor.net/blog/2014/02/08/implementing-session-timeout-with-php/
$time = $_SERVER['REQUEST_TIME'];

/*Timeout duration for 3hrs*/
$timeout_duration = 10800;

/*If the $timeout_duration has passed, destory and restart the session*/
if (isset($_SESSION['LAST_ACTIVITY']) &&
   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
}

/*Update last activity to base time in instead of login time*/
$_SESSION['LAST_ACTIVITY'] = $time;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ticket Tracker Center</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset = "utf-8"/>

  <?php include 'includes.php'; ?>
</head>

<body>

<?php include 'ticketTrackerMenu.php'; ?>

<!--List of different ticket options to submit--->
<form action="addTicket.php" method="post">
  <select name="ticketType">
    <option>-Select Ticket Type-</option>
    <option value="Billing">Billing</option>
    <option value="Cancellation">Cancellation</option>
    <option value="Refund">Refund</option>
    <option value="Support LV1">Support LV1</option>
    <option value="Support LV2">Support LV2</option>
    <option value="Sub Downgrade">Sub Downgrade</option>
    <option value="Sub Upgrade">Sub Upgrade</option>
    <option value="Other">Other</option>
  </select>
    <input type="submit" value="Submit">
</form>

<br>

<!--List of different cancellation reasons-->
<form action="addCancelReason.php" method="post">
  <select name="cancelReason">
    <option>-Select Cancel Reason-</option>
    <option value="Can not afford service">Can not afford service</option>
    <option value="Disatisfied w/service (Cmt Req)">Disatisfied w/service (Cmt Req)</option>
    <option value="Did not use service">Did not use service</option>
    <option value="No longer needed">No longer needed</option>
    <option value="No reason given">No reason given</option>
    <option value="Switching to company CRM">Switching to competitor</option>
    <option value="Other (Cmt Req)">Other (Cmt Req)</option>
  </select>
  <br>
  <p>
    <label for="idCustomer">Customer ID(#'s Only):</label><!--Recording the customers ID Number-->
    <input type="text" name="idCustomer">
  </p>
  <p>
    <label for="idTicket">Ticket Number(#'s Only):</label><!--Recording the ticket number for reference-->
    <input type="text" name="idTicket">
  </p>
  <p>
    <label for="comment">Comment:</label><!--Comment field-->
    <input type="text" name="comment">
  </p>

  <input type="submit" value="Submit Reason"><br>
</form>
<b>*Note: "(Cmt Req)" - Comment Required </b>

</body>
</html>
