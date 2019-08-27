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
	$number = $result->rowCount();

	// Check if any bookings
	if($number > 0) {

		// Bookings array
		$bookings_array = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$booking_item = array(
				'booking_id' => $id,
				'booking_date' => $date,
				'sitting_time' => $time,
				'number_of_guests_at_table' => $number_of_guests,
				'name_on_booking' => $customer_name
			);

			// Push to "data"
			array_push($bookings_array, $booking_item);

		}

		// Turn to JSON & output
		echo json_encode($bookings_array);

	} else {
		
		// No Bookings
		echo json_encode(
			array('message' => 'No Bookings Found')
		);
	}