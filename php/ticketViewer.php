<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: http://mark-angell.com/html/projectpages/demo/tickettracker/indexTT.php"); //Directs to root
    exit;
}
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

<!--Submission form to query tickets by type and date-->
<form action="queryTicket.php" method="post">
    <p>
        <label for="ticketType">Query Ticket Type:</label>
        <input type="text" name="ticketType" id="ticketType">
    </p>
    <p>
        <label for="entry_date">Date(YYYY-MM-DD):</label>
        <input type="text" name="entry_date" id="entry_date">
    </p>
    <input type="submit" value="Submit">
</form>

<br>

<!--Generate Ticket Summary-->
<form action="summaryTicket.php" method="post">
  <label for="entry_date">Date:</label>
  <input type="date" name="entry_date" min="2000-01-02">
  <input type="submit" value="Generate Ticket Summary">
</form>

<br>

<!--Generate Cancellation Reason Summary-->
<form action="summaryCancellation.php" method="post">
  <label for="entry_date">Date:</label>
  <input type="date" name="entry_date" min="2000-01-02">
  <input type="submit" value="Generate Cancellation Summary">
</form>

</body>
</html>
