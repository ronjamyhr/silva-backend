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

    $booking = new Booking($db);

    $email_result = $booking->compareCustomerEmail('bert_fjert@enmail.se');

    $row_count = $email_result->rowCount();

	// Check if email exists
	if($row_count > 0) {

		while($email_row = $email_result->fetch(PDO::FETCH_ASSOC)) {
			extract($email_row);

			$customerId = array(
				'customer_id' => $id
            );
        }
        
        // echo json_encode($customerId);
        $customer_id_from_db = (int)$customerId['customer_id'];
        
        if($booking->bookTable($customer_id_from_db, '2019-08-28', 19, 5)) {
            echo json_encode(array('message' => 'Table successfully booked'));
        } else {
            echo json_encode(array('message' => 'Could not book table'));
        }


	} else {

        if($booking->registerCustomer('anna', 'nanna@hejhopp.se', 07057635)) {
            echo json_encode(array('message' => 'Customer registered'));
        } else {
            echo json_encode(array('message' => 'Could not register new customer'));
        }

        $customer_query = $booking->getCustomerId();
        $customer_id_result = $customer_query->fetch((PDO::FETCH_ASSOC));

        echo json_encode(array('last_customer_id' => $customer_id_result));

        $new_customer_id = (int)$customer_id_result['id'];

        if($booking->bookTable($new_customer_id, '2019-09-10', 21, 5)) {
            echo json_encode(array('message' => 'Table successfully booked'));
        } else {
            echo json_encode(array('message' => 'Could not book table'));
        }

    
    }

    