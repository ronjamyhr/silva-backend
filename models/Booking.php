<?php 
	class Booking {

	private $connection;
	private $table = 'booking';

	// Constructor with DB
	public function __construct($db) {
		$this->connection = $db;
	}

	// Get Bookings
	public function read() {

		// Create query
		$query = 'SELECT 
			c.name as customer_name,
			c.email,
			b.id, 
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
		$statement = $this->connection->prepare($query);

		// Execute query
		$statement->execute();

		return $statement;
	}

	public function delete() {

		$query = 'DELETE
			FROM ' . $this->table . '
		  	WHERE id = :id';
	
		// Prepare statement
		$statement = $this->connection->prepare($query);
	
		// Clean data
		$this->id = htmlspecialchars(strip_tags($this->id));
	
		// Bind data 
		$statement->bindParam(':id', $this->id);
	
		// Execute query
		if($statement->execute()) {
			return true;
		}
	
		//Print error 
		printf("Error: %s.\n", $statement->error);
	
		return false;
	}
}




