<?php
include '../config/config.php';
include '../functions/functions.php';
session_start();
$function = $_REQUEST['function'];
switch($function) //simulates routing 
{
 case 'save' :
 	save();
 break;
 case 'getRoomsbyRoomType' :
 	getRoomsbyRoomType();
 break;
 case 'searchByDate' :
 	searchByDate();
 break;
 default:
 break;
}
function save(){ //saves booking form
	$db = dbConnect();
	$code ='';
	$error = '';
	//insert customer first so you get customer id to use in booking table
	$cusinsert = $db->prepare("INSERT INTO customer (name, email, address, mobile) VALUES (?,?,?,?)");
	$cusinsert->bind_param("ssss", $_POST["name"], $_POST["email"], $_POST["address"], $_POST["phone"]);
	if($cusinsert->execute()){ //using prepare to prevent sql injection
	    // Obtain last inserted id
	    $customer_id = $cusinsert->insert_id;//using customer id that was inserted
	    $checkin_date = date ("Y-m-d H:i:s",strtotime($_POST["checkin_date"])); //convert to datetime
	    $checkout_date = date ("Y-m-d H:i:s",strtotime($_POST["checkout_date"]));
	    $bookinginsert = $db->prepare("INSERT INTO booking (customer_id, room_id, checkin_date, checkout_date, no_of_guests,special_requests)
										VALUES (?,?,?,?,?,?)");
		$bookinginsert->bind_param("iissis", $customer_id, $_POST["room"], $checkin_date, $checkout_date,$_POST["guests"],$_POST["special_requests"]);						
	    if($bookinginsert->execute()){	
	    	$code = 'success';
	    }
	    else{
	    	$code = 'error';
	    	$error = "ERROR: Was not able to execute " .  $bookinginsert->error;
	    }	
	} else{
	   $code = 'error';
	   $error = "ERROR: Was not able to execute " .  $cusinsert->error; 
	}
	$cusinsert->close();
	$bookinginsert->close();
	$db->close();
	echo json_encode(array('code' => $code, 'error' => $error));		
}

function getRoomsbyRoomType(){ //return list of rooms by roomtype from database for booking dropdown
	$db = dbConnect();
	$rooms = [];
	$stmt = $db->prepare('select *, r.id as roomid from room r 
						inner join room_type rt on rt.id=room_type_id 
						where room_type_id=?');
	$stmt->bind_param("i", $_POST["type"]);
	$stmt -> execute();
	$result = $stmt->get_result();	
	while($row = $result->fetch_array()){
		$rooms[] = $row;
	}
	$stmt->close(); 
	$db->close();
	echo json_encode($rooms);
}

function searchByDate(){
	$db = dbConnect();
	$bookings = [];
	$datefrom = date ("Y-m-d H:i:s",strtotime($_POST["from_date"])); //convert to datetime
	$dateto = date ("Y-m-d H:i:s",strtotime($_POST["to_date"]));
	$sql = "SELECT checkin_date,checkout_date,type,description,name,no_of_guests,special_requests 
								FROM booking bk
								INNER JOIN room r
								ON r.id =  bk.room_id
								INNER JOIN customer c
								ON c.id =  bk.customer_id
								INNER JOIN room_type rt 
								ON rt.id=r.room_type_id 
								WHERE checkin_date BETWEEN ? AND ?
								OR checkout_date BETWEEN ? AND ?";
	$stmt = $db->prepare($sql);
	$stmt->bind_param("ssss", $datefrom,$dateto,$datefrom,$dateto);
	$stmt -> execute();
	$result = $stmt->get_result();
	while($row = $result->fetch_array()){
		$bookings[] = $row;
	} 
	$db->close();
	echo json_encode($bookings);
}
