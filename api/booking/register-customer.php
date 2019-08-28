<?php
	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


	include_once '../../configuration/Database.php';
	include_once '../../models/Booking.php';

	// Instantiate DB & connect
	$database = new Database();
	$db = $database->connect();

	// Instantiate booking object
    $booking = new Booking($db);

    if($booking->registerCustomer('nisse', 'nisse@hejhopp.se', 0705647635)) {
        echo json_encode(array('message' => 'Customer registered'));
    } else {
        echo json_encode(array('message' => 'Could not register new customer'));
    }

