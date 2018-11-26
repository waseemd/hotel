<?php

function dbConnect()
{
	$conn = new mysqli(SERVERNAME, DBUSERNAME, DBPASSWORD, DBSCHEMA);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	return $conn;
} 



