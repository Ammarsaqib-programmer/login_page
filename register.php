<?php
$servername = "localhost";
$username = "root"; // Default MySQL username
$password = ""; // Leave this blank if no password is set
$dbname = "user_db";
$port = 3307; // Your specified port number

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone_number = $_POST['phone_number'] ?? ''; // Matches 'phone number' column
    $password = $_POST['password'] ?? '';

    // Check if any field is empty
    if (empty($name) || empty($email) || empty($phone_number) || empty($password)) {
        echo "All fields are required!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the SQL query with `phone number` in backticks
        $sql = "INSERT INTO users (name, email, `phone number`, password) VALUES ('$name', '$email', '$phone_number', '$hashed_password')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>


