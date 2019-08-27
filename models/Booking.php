<?php 
	class Booking {

	private $connection;
	private $table = 'booking';

	// Booking Properties
	public $id;
	public $customer_id;
	public $date;
	public $time;
	public $number_of_guests;
	public $customer_name;

	// Constructor with DB
	public function __construct($db) {
		$this->connection = $db;
	}

	// Get Bookings
	public function read() {

		// Create query
		$query = 'SELECT 
			c.name as customer_name, 
			b.id, 
			b.customer_id, 
			b.date, 
			b.time, 
			b.number_of_guests 
			FROM 
			' . $this->table . ' b
			LEFT JOIN
			customer c ON b.customer_id = c.id
			ORDER BY
			b.date DESC';

		// Prepare statement
		$stmt = $this->connection->prepare($query);

		// Execute query
		$stmt->execute();

		return $stmt;
	}

	public function getBookingsOnTime($date, $time) {

		$query = 'SELECT * FROM booking WHERE date = :date AND time = :time';

		$statement = $this->connection->prepare($query);

        $statement->execute(
            [
				":date" => $date,
				":time" => $time
            ]
		);
		
		return $statement;
			
	}
}




