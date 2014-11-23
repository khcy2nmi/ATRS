<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ATRS";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE ".$dbname;
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully \r\n";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CREATE TABLE FlightRoute (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	flightDate DATE NOT NULL,
	flightNo VARCHAR(30) NOT NULL,
	origin VARCHAR(30) NOT NULL,
	destination VARCHAR(30) NOT NULL
	)";
if ($conn->query($sql) === TRUE) {
    echo "Table FlightRoutes created successfully \r\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

$sql = "CREATE TABLE FlightDetail (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	departTime TIME NOT NULL,
	arrivalTime TIME NOT NULL,
	price VARCHAR(30) NOT NULL,
	capacity VARCHAR(30) NOT NULL,
	flightRouteId INT(6) NOT NULL,
	FOREIGN KEY (flightRouteId) REFERENCES FlightRoute(id)
	)";
if ($conn->query($sql) === TRUE) {
    echo "Table FlightDetails created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE FlightSeat (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	seatNo VARCHAR(30) NOT NULL,
	status VARCHAR(30) NOT NULL,
	flightDetailId INT(6) NOT NULL,
	FOREIGN KEY (flightDetailId) REFERENCES FlightDetail(id)
	)";
if ($conn->query($sql) === TRUE) {
    echo "Table FlightSeats created successfully \r\n";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE Reservation (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	contactPersonEmail VARCHAR(30) NOT NULL,
	reservationCode VARCHAR(30) NOT NULL,
	flightRouteId INT(6) NOT NULL,
	flightDetailId INT(6) NOT NULL,
	FOREIGN KEY (flightRouteId) REFERENCES FlightRoute(id),
	FOREIGN KEY (flightDetailId) REFERENCES FlightDetail(id)
	)";
if ($conn->query($sql) === TRUE) {
    echo "Table Reservation created successfully \r\n";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE Booking (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	contactEmail VARCHAR(30) NOT NULL,
	bookingCode VARCHAR(30) NOT NULL,
	flightRouteId INT(6) NOT NULL,
	flightDetailId INT(6) NOT NULL,
	FOREIGN KEY (flightRouteId) REFERENCES FlightRoute(id),
	FOREIGN KEY (flightDetailId) REFERENCES FlightDetail(id)
	)";
if ($conn->query($sql) === TRUE) {
    echo "Table Booking created successfully \r\n";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "CREATE TABLE ContactPerson (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	email VARCHAR(30) NOT NULL,
	mobileNo VARCHAR(20) NOT NULL,
	reservationId INT(6) NOT NULL,
	bookingId INT(6) NOT NULL,
	FOREIGN KEY (reservationId) REFERENCES Reservation(id),
	FOREIGN KEY (bookingId) REFERENCES Booking(id)
	)";
if ($conn->query($sql) === TRUE) {
    echo "Table ContactPerson created successfully \r\n";
} else {
    echo "Error creating table: " . $conn->error;
}


$sql = "CREATE TABLE Passenger (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(5) NOT NULL, 
	name VARCHAR(30) NOT NULL,
	email VARCHAR(30) NOT NULL,
	dateOfBirth DATE NOT NULL,
	nationality VARCHAR(30) NOT NULL,
	contactPersonId INT(6) NOT NULL,
	bookingId INT(6) NOT NULL,
	reservationId INT(6) NOT NULL,
	flightSeatId INT(6) NOT NULL,
	FOREIGN KEY (contactPersonId) REFERENCES ContactPerson(id),
	FOREIGN KEY (reservationId) REFERENCES Reservation(id),
	FOREIGN KEY (bookingId) REFERENCES Booking(id),
	FOREIGN KEY (flightSeatId) REFERENCES FlightSeat(id)
	)";
if ($conn->query($sql) === TRUE) {
    echo "Table ContactPerson created successfully \r\n";
} else {
    echo "Error creating table: " . $conn->error;
}




$conn->close();
?>