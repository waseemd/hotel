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
 default:
 break;
}
function save(){ //saves booking form
	$db = dbConnect();
	$code ='';
	$error = '';
	//insert customer first so you get customer id to use in booking table
	$sql = "INSERT INTO customer (name, email, address, mobile) 
			VALUES ('".$_POST["name"]."','".$_POST["email"]."','".$_POST["address"]."', '".$_POST["phone"]."')";
	if(mysqli_query($db, $sql)){
	    // Obtain last inserted id
	    $customer_id = mysqli_insert_id($db);//using customer id that was inserted
	    $room_id = 1;
	    $checkin_date = date ("Y-m-d H:i:s",strtotime($_POST["checkin_date"])); //convert to datetime
	    $checkout_date = date ("Y-m-d H:i:s",strtotime($_POST["checkout_date"]));
	    $sql = "INSERT INTO booking (customer_id, room_id, checkin_date, checkout_date, no_of_guests,special_requests)
			VALUES ('".$customer_id."','".$room_id."','". $checkin_date."', '".$checkout_date."', '".$_POST["guests"]."', '".$_POST["special_requests"]."')";
	    if(mysqli_query($db, $sql)){	
	    	$code = 'success';
	    }
	    else{
	    	$code = 'error';
	    	$error = "ERROR: Was not able to execute $sql. " . mysqli_error($db);
	    }	
	} else{
	   $code = 'error';
	   $error = "ERROR: Was not able to execute $sql. " . mysqli_error($db); 
	}
	$db->close();
	echo json_encode(array('code' => $code, 'error' => $error));		
}	