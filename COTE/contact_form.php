<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "contact";

    $conn = new mysqli($hostname, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
    }

    // Form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message_text = $conn->real_escape_string($_POST['message']);

    // Insert data into database
    $sql = "INSERT INTO contact_form (name, email, message) VALUES ('$name', '$email', '$message_text')";



    $conn->close();
    exit;
}

?>