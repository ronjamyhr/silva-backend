<?php 
	// Headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../configuration/Database.php';
	include_once '../../models/Booking.php';

	// Instantiate DB & connect
	$database = new Database();
	$db = $database->connect();

	// Instantiate booking object
	$booking = new Booking($db);

	// Booking query
	$result = $booking->read();

	// Get row count
	$num = $result->rowCount();

	// Check if any posts
	if($num > 0) {

		// Bookings array
		$bookings_arr = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$booking_item = array(
				'id' => $id,
				'customer_id' => $customer_id,
				'date' => $date,
				'time' => $time,
				'number_of_guests' => $number_of_guests,
				'customer_name' => $customer_name
			);

			// Push to "data"
			array_push($bookings_arr, $booking_item);

		}

		// Turn to JSON & output
		echo json_encode($bookings_arr);

	} else {
		
		// No Bookings
		echo json_encode(
			array('message' => 'No Bookings Found')
		);
	}