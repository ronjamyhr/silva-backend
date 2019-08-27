<?php

    include_once '../../configuration/Database.php';
    include_once '../../models/Booking.php';

    // Instantiate DB & connect
	$database = new Database();
	$db = $database->connect();

	// Instantiate booking object
	$booking = new Booking($db);

	$result = $booking->getBookingsOnTime('2019-08-28 00:00:00', 19);

	$fetched_result = $result->fetchAll(PDO::FETCH_ASSOC);
	// Get row count
	$num = $result->rowCount();
	// Check if any posts
	if($num > 0) {
		// Turn to JSON & output
		echo json_encode($fetched_result);
	} else {
		// No Bookings
		echo json_encode(
			array('message' => 'No Bookings Found')
		);
	}
