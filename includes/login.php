<?php
session_start();  // Start the session to track login status

// Database connection details
$host = 'localhost';  // Your DB host
$db = 'widget_corp';  // Your database name
$user = 'root';  // Your database username
$pass = 'test';  // Your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password using SHA256 (SHA2)
    $hashed_password = hash('sha256', $password);

    // Prepare the SQL query to check if the user exists with the given username and password
    $sql = "SELECT * FROM users WHERE username = ? AND hashed_password = ?";
    
    // Prepare and bind the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $hashed_password);  // 'ss' means two string parameters
    
    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user exists with the provided credentials
    if ($result->num_rows > 0) {
        // If user exists, start a session and set session variables
        $_SESSION['username'] = $username;  // Store the username in session
        $_SESSION['logged_in'] = true;  // Set the logged_in session variable

        // Redirect to the login page with success message
        header("Location: ../login.php?success=12");
        exit();
    } else {
        // If no matching user is found, redirect back to login page with an error
        header("Location: ../login.php?error=1");
        exit();
    }
} else {
    // If the form wasn't submitted, redirect back to the login page
    header("Location: ../login.php");
    exit();
}
?>
