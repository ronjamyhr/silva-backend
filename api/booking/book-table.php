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

    $email_result = $booking->compareCustomerEmail($email);

    $row_count = $email_result->rowCount();

	// Check if email exists
	if($row_count > 0) {
        // $customer_row = $email_result->fetch(PDO::FETCH_ASSOC));
        // $customerId = (int)$customer_row.id;


		while($row = $email_result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$customerId = array(
				'customer_id' => $id,
				// 'booking_date' => $date,
				// 'sitting_time' => $time,
				// 'number_of_guests_at_table' => $number_of_guests,
				// 'name_on_booking' => $customer_name
			);
        }
        
        // $new_booking = $booking->bookTableExistingCustomer($customerId);


	} else {

        $register_customer = $booking->registerNewCustomer()
		
	}

    