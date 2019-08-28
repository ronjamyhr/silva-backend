<?php 
	class Booking {

	private $connection;
    private $table = 'booking';
    
    private $customer_id;

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
        $statement->execute([':email' => $email]);
        return $statement;
    }
    
    public function getCustomerId() {
        $query = 'SELECT id FROM customer ORDER BY id DESC  LIMIT 1';
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function registerCustomer($name, $email, $phone_number) {
        $query = 'INSERT INTO customer (name, email, phone_number) VALUES (:name, :email, :phone_number)';

        $statement = $this->connection->prepare($query);
        $statement->execute([':name' => $name, ':email' => $email, ':phone_number' => $phone_number]);
        return $statement;
    }

    public function bookTable($customerId, $date, $time, $number_of_guests) {
        $query = 'INSERT INTO booking (customer_id, date, time, number_of_guests) VALUES (:customer_id, :date, :time, :number_of_guests)';

        $statement = $this->connection->prepare($query);
        $statement->execute([':customer_id' => $customerId, ':date' => $date, ':time' => $time, ':number_of_guests' => $number_of_guests
        ]);
        return $statement;
    }
}




