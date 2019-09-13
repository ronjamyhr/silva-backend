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

    $data = json_decode(file_get_contents("php://input"));

    $booking->email = $data->email;
    $booking->name = $data->name;
    $booking->phone_number = $data->phone_number;
    $booking->number_of_guests = $data->number_of_guests;
    $booking->date = $data->date;
    $booking->time = $data->time;

    $email = $data->email;
    
    $emailHeader = 'From: silva@mail.com';
    $emailMessage = 'Tack ' . $booking->name . ' för din bokning! 
    Vi på SILVA ser fram emot att servera dig och ditt sällskap den ' . $booking->date . ', klockan ' . $booking->time . '.
    Varmt välkommen!';
    $emailSubject = 'Bokningsbekräftelse';
    $message = wordwrap($emailMessage,70);
    
    $email_result = $booking->compareCustomerEmail();

    $row_count = $email_result->rowCount();


	// Check if email exists
	if($row_count > 0) {

		while($email_row = $email_result->fetch(PDO::FETCH_ASSOC)) {
			extract($email_row);

			$customerId = array(
				'customer_id' => $id
            );
        }

        $booking->customer_id = (int)$customerId['customer_id'];
        
        if($booking->bookTable()) {
            echo json_encode(array('message' => 'Table successfully booked'));
            mail($email, $emailSubject, $message, $emailHeader);
        } else {
            echo json_encode(array('message' => 'Could not book table'));
        }
        
        
	} else {

        if($booking->registerCustomer()) {
            echo json_encode(array('message' => 'Customer registered'));
        } else {
            echo json_encode(array('message' => 'Could not register new customer'));
        }

        $customer_query = $booking->getCustomerId();
        $customer_id_result = $customer_query->fetch((PDO::FETCH_ASSOC));

        echo json_encode(array('last_customer_id' => $customer_id_result));

        $booking->customer_id = (int)$customer_id_result['id'];

        if($booking->bookTable()) {
            echo json_encode(array('message' => 'Table successfully booked'));
            mail($email, $emailSubject, $message, $emailHeader);
        } else {
            echo json_encode(array('message' => 'Could not book table'));
        }
    
    }

    