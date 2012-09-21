<?php # mysqli_connect.php

// Set the database access information as constants.

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'test123');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'bicycle');

// Make the connnection.
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

?>
