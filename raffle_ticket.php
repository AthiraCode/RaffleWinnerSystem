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

// Check if ID is passed
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Generate a unique ticket number (1-100)
    do {
        $ticket_number = rand(1, 100);

        // Check if the ticket number is already assigned
        $sql_check = "SELECT * FROM contestants WHERE ticket_number = $ticket_number";
        $result_check = $conn->query($sql_check);

    } while ($result_check->num_rows > 0); // Repeat if ticket number is already assigned

    // Update the user's ticket number in the database
    $sql = "UPDATE contestants SET ticket_number = $ticket_number WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        // Fetch user's data
        $sql = "SELECT first_name, last_name, ticket_number FROM contestants WHERE id = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $full_name = $user['first_name'] . ' ' . $user['last_name'];
            $ticket_number = $user['ticket_number'];
        } else {
            echo "<p style='color: red;'>User not found!</p>";
        }
    } else {
        echo "<p style='color: red;'>Error updating ticket number: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color: red;'>No user ID provided!</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Raffle Ticket</title>
    <link rel="stylesheet" href="styles/ticket.css">
</head>
<body>
    <div class="container">
        <h1>🎄 Congratulations! 🎄</h1>
        <p>Hello <strong><?php echo $full_name; ?></strong>,</p>
        <p>Your raffle ticket number is:</p>
        <h2><?php echo $ticket_number; ?></h2>
        <p>Thank you for participating in our Christmas Raffle!</p>
    </div>
</body>
</html>
