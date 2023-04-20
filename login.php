<?php
$servername = "localhost";
$username = "thomas_data";
$password = "thomas6731";
$dbname = "login_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare SQL statement
    $sql = "SELECT * FROM users WHERE username='$username'";

    // Execute query
    $result = $conn->query($sql);

    // Check if user exists
    if ($result->num_rows > 0) {
        // Get user row
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row["password"])) {
            // Redirect to dashboard page
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid password
            echo "Invalid username or password";
        }
    } else {
        // User not found
        echo "Invalid username or password";
    }
}

$conn->close();
?>
