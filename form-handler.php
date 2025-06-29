<?php
// DATABASE CONFIG
$host = "localhost";      // or your server IP
$user = "root";           // database username
$password = "";           // database password
$dbname = "instan_furniture";

// CONNECT TO DATABASE
$conn = new mysqli($host, $user, $password, $dbname);

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// HANDLE FORM
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST["name"]);
    $email   = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // SAVE TO DATABASE
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Message received! Thank you, $name.";
    } else {
        echo "Something went wrong. Please try again.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
