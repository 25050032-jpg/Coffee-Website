<?php

$host = "localhost";
// localhost means the location of the database server is on the same computer as the webhost
$user = "root";
// the default MySQL server name
$password = "";
// no password for the database was set
$database = "user_db";
// the name of the database  i want to send data to

$conn = new mysqli($host, $user, $password, $database);
// a connection variable storing the variables that that are used to access the database that i'll be sending data to 


if ($conn->connect_error) {
    // the connect_error key is made by default when an error occurs
    // If the connection succeeds then it will return null
    // If the connections fails then it returns true with a error description 
    die("Conntection Failed" . $conn->connect_error);
    // die is alias of exit(), it prints the failure message to the screen and immediatly halts the entire script, preventing attempted connectios to the database
}

?>