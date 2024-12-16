<?php
// Start the session
session_start();

// Database connection
$host = 'localhost';
$username = 'phpuser'; 
$password = 'pa55word'; 
$dbname = 'christmas_raffle';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to fetch user
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = MD5('$password')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to the form page
        header('Location: raffle_form.html');
    } else {
        // Invalid credentials
        echo "<p style='color: red;'>Invalid username or password!</p>";
    }
}

// Close connection
$conn->close();
?>
