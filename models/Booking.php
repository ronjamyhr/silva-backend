<?php 
	class Booking {

	private $connection;
    private $table = 'booking';
    
    public $customer_id;
    public $name;
    public $email;
    public $phone_number;
    public $date;
    public $time;
    public $number_of_guests;

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
    
    public function compareCustomerEmail() {
        $query = 'SELECT * FROM customer WHERE email = :email';

        $statement = $this->connection->prepare($query);
        $statement->bindParam(':email', $this->email);
        $statement->execute();
        return $statement;
    }
    
    public function getCustomerId() {
        $query = 'SELECT id FROM customer ORDER BY id DESC  LIMIT 1';
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function registerCustomer() {
        $query = 'INSERT INTO customer (name, email) VALUES (:name, :email)';

        $statement = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        // $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));

        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':email', $this->email);
        // $statement->bindParam(':phone_number', $this->phone_number);

        if($statement->execute()) {
            return true;
        }

        printf("Error: %s.\n", $statement->error);
        return false;
    }

    public function bookTable() {
        $query = 'INSERT INTO booking (customer_id, date, time, number_of_guests) VALUES (:customer_id, :date, :time, :number_of_guests)';

        $statement = $this->connection->prepare($query);

        $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->time = htmlspecialchars(strip_tags($this->time));
        $this->number_of_guests = htmlspecialchars(strip_tags($this->number_of_guests));

        $statement->bindParam(':customer_id', $this->customer_id);
        $statement->bindParam(':date', $this->date);
        $statement->bindParam(':time', $this->time);
        $statement->bindParam(':number_of_guests', $this->number_of_guests);

        if($statement->execute()) {
            return true;
        }

        printf("Error: %s.\n", $statement->error);
        return false;
    
    }
}




