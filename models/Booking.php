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
    
    public function compareCustomerEmail($email) {

        $query = 'SELECT * FROM customer WHERE email = :email';

        $statement = $this->connection->prepare($query);
        $statement->execute([":email" => $email]);
        return $statement;
    }

    // public function getCustomerId() {

    // }

    public function registerNewCustomer($email, $name, $phone_number,) {

    }

    public function bookTableNewCustomer() {

    }

    public function bookTableExistingCustomer($customerId, $time, $date, ) {

    }
}




