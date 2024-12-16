<?php
// Start session
session_start();

// Include PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to your Composer autoload file

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

// Get the total number of tickets sold
$sql = "SELECT COUNT(*) AS total_tickets FROM contestants WHERE ticket_number IS NOT NULL";
$result = $conn->query($sql);
$total_tickets = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_tickets = $row['total_tickets'];
}

// Check if a winner is being selected
$winner = '';
if (isset($_POST['select_winner'])) {
    // Get a random ticket number
    $sql = "SELECT * FROM contestants WHERE ticket_number IS NOT NULL ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $winner = $result->fetch_assoc();
        $winner_name = $winner['first_name'] . ' ' . $winner['last_name'];
        $winner_ticket_number = $winner['ticket_number'];
        
        // Save the winner information in the winner table
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO winner (first_name, last_name, ticket_number, date) 
                VALUES ('" . $winner['first_name'] . "', '" . $winner['last_name'] . "', $winner_ticket_number, '$date')";
        $conn->query($sql);
        
        // Send email to winner
        $to = $winner['email'];
        $subject = "Congratulations! You Won the Christmas Raffle!";
        $message = "Dear " . $winner_name . ",\n\nCongratulations! You have won the Christmas Raffle Ticket worth $1000! Your winning number is " . $winner_ticket_number . ".\n Contact us for more info!\n Phone: 111 222 5607 \n\nBest Regards,\nThe Christmas Raffle Team";

        // Send email using PHPMailer
        try {
            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  // Set the SMTP server to send through
            $mail->SMTPAuth   = true;
            $mail->Username   = 'avin@gmail.com';  
            $mail->Password   = 'mjki vyed abcd woux';   
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;  // TCP port to connect to

            // Recipients
            $mail->setFrom('avin@gmail.com', 'Christmas Raffle');
            $mail->addAddress($winner['email'], $winner_name);  // Winner's email

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = nl2br($message);

            // Send email
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Christmas Raffle</title>
    <link rel="stylesheet" href="styles/admin.css">
</head>
<body>
    <div class="admin-container">
        <h1>🎄 Admin Dashboard - Christmas Raffle 🎄</h1>
        <p><strong>Total Tickets Sold:</strong> <?php echo $total_tickets; ?></p>

        <h2>Select a Winner</h2>
        <?php if ($winner): ?>
            <p style="color: green;">The lucky winner is: <?php echo $winner_name; ?> (Ticket Number: <?php echo $winner_ticket_number; ?>)</p>
        <?php else: ?>
            <form method="POST" action="">
                <button type="submit" name="select_winner" class="btn">Select Random Winner</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
