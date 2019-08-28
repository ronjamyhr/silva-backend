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

    $email_result = $booking->compareCustomerEmail('bert_fjert@enmail.se');

    $row_count = $email_result->rowCount();

	// Check if email exists
	if($row_count > 0) {
        // $customer_row = $email_result->fetch(PDO::FETCH_ASSOC));
        // $customerId = (int)$customer_row.id;
        // $bookings_array = array();

		while($email_row = $email_result->fetch(PDO::FETCH_ASSOC)) {
			extract($email_row);

			$customerId = array(
				'customer_id' => $id
				// 'booking_date' => $date,
				// 'sitting_time' => $time,
				// 'number_of_guests_at_table' => $number_of_guests,
				// 'name_on_booking' => $customer_name
            );
            // Push to "data"
			// array_push($bookings_array, $customerId);
        }
        
        // Turn to JSON & output
        echo json_encode($customerId);
        // $id_after_jh = (int)$customerId['customer_id'];
        
        // $new_booking = $booking->bookTableExistingCustomer($id_after_jh, '2019-08-28', 19, 5);

        // $bookings_array_done = array();

		// while($booking_row = $new_booking->fetch(PDO::FETCH_ASSOC)) {
		// 	extract($booking_row);

		// 	$new_booking = array(
        //         'booking_id' => $id,
        //         'customer_id' => $customer_id,
		// 		'booking_date' => $date,
		// 		'sitting_time' => $time,
		// 		'number_of_guests_at_table' => $number_of_guests
		// 	);

		
		// 	array_push($bookings_array_done, $new_booking);

		// }

	
		// echo json_encode($bookings_array_done);



	} else {

        // $register_customer = $booking->registerNewCustomer();
        // No Bookings
		echo json_encode(
			array('message' => 'No customer found, Register New Customer')
		);
    }

    