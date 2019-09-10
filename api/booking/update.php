<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../configuration/Database.php';
  include_once '../../models/Booking.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $post = new Booking($db);
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  // Set ID to update
  $post->number_of_guests = $data->number_of_guests;
  $post->time = $data->time;
  $post->date = $data->date;
  $post->id = $data->id;
  // Update post
  if($post->update()) {
    echo json_encode(
      array('message' => 'Post Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Updated')
    );
  }