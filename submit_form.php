<?php
// Start session
session_start();

// Database connection
$host = 'localhost';
$username = 'phpuser';
$password = 'pa55word';
$dbname = 'christmas_raffle';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Insert user data into the database
    $sql = "INSERT INTO contestants (first_name, last_name, phone, email) 
            VALUES ('$first_name', '$last_name', '$phone', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the inserted record's ID
        $last_id = $conn->insert_id;

        // Redirect to the raffle ticket page with user ID
        header("Location: raffle_ticket.php?id=$last_id");
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>
