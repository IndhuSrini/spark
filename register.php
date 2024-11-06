<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password (usually blank)
$dbname = "event_registration"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $whatsapp = htmlspecialchars(trim($_POST['whatsapp']));
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $department = isset($_POST['department']) ? $_POST['department'] : '';
    $section = isset($_POST['section']) ? $_POST['section'] : '';
    $events = isset($_POST['event']) ? $_POST['event'] : [];

    // Join events into a single string
    $eventsString = implode(", ", $events);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO registrations (name, email, whatsapp, gender, department, section, events) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $whatsapp, $gender, $department, $section, $eventsString);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the form wasn't submitted, redirect to the registration page
    header("Location: registration.html"); // Change to your registration form page
    exit();
}
?>

