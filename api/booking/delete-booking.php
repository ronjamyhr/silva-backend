<?php 
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    include_once '../../configuration/Database.php';
    include_once '../../models/Booking.php';
    
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
    
    // Instantiate booking object
    $booking = new Booking($db);
    
    // Get raw booking data
    $data = json_decode(file_get_contents("php://input"));
    // Set id to be deleted
    $booking->id = $data->id;

    // $result = $booking->getEmail();
    // $email->fetch(PDO::FETCH_ASSOC);

    // // Set confirmation email details
    // $emailHeader = 'From: silva@mail.com';
    // $emailMessage = 'Din avbokning är registrerad!';
    // $emailSubject = 'Avbokningsbekräftelse';
    // $message = wordwrap($emailMessage,70);
    
    // Delete booking
    if($booking->delete()) {
        echo json_encode(
            array('message' => 'Booking deleted')
        );
        // Send confirmation email
        // mail($email, $emailSubject, $message, $emailHeader);
    } else {
        echo json_encode(
            array('message' => 'Booking not deleted')
        );
    }