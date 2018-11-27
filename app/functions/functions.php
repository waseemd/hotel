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

function getRooms() //return list of rooms from database for view
{
	$db = dbConnect();
	$rooms = [];
	$result =  mysqli_query($db,'select *, r.id as roomid from room r inner join room_type rt on rt.id=room_type_id');
	if(mysqli_num_rows($result) > 0){
		while($row = $result->fetch_array())
		{
		$rooms[] = $row;
		} 
	}
	$db->close();
	return $rooms;
}

function getRoomTypes(){ // get list of room types
	$db = dbConnect();
	$roomtypes = [];
	$result =  mysqli_query($db,'select * from room_type rt');
	if(mysqli_num_rows($result) > 0){
		while($row = $result->fetch_array())
		{
		$roomtypes[] = $row;
		} 
	}
	$db->close();
	return $roomtypes;
}


