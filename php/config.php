<?php

/*Summary 1:
This section defines the DB_xxxx varibles with the actual
information for the database being connected too*/
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost:3306'); /*Needs to be replaced with the IP address*/
define('DB_USERNAME', 'root'); /*Default user is root*/
define('DB_PASSWORD', 'Ecoo@2233!2020'); /*Password required*/
define('DB_NAME', 'ttdemo'); /*Matching DB name with name on DO droplet*/
/*Summary 1 End*/

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection. Triple "===" check a strict response. Errors if connection fails
if($link === false){
    die("ERROR(Config.php): Could not connect. " . mysqli_connect_error());
}
