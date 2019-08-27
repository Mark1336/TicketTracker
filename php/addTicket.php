<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: http://mark-angell.com/html/projectpages/demo/tickettracker/indexTT.php"); //Directs to root
    exit;
}

//Connect to the MySQL DataBase
require_once "config.php";

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
  die("Error: Could not connect to make post. addTicket.php" . mysqli_connect_error());
}

//Escaping user inputs for security purposes
$ticketType = mysqli_real_escape_string($link, $_REQUEST['ticketType']); //Getting the ticketType entry
$userID = mysqli_real_escape_string($link, $_SESSION["id"]); //Getting the userID entry

//Insert into the table and check for errors
$sql = "INSERT INTO TicketEntryTable(type, id_user) VALUES('$ticketType', '$userID')";

if(mysqli_query($link, $sql)){
  echo "Ticket added successfully.";
  }
else{
  echo "An error occured. Failure to submit entry to Ticket Entry Table. MySQL Error:" . mysqli_error($link);
  }
header("location: http://mark-angell.com/html/projectpages/demo/tickettracker/php/ticketTrackerCenter.php");
mysqli_close($link);
 ?>
