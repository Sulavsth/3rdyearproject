<?php
// signup.php

// Database credentials
$hostname = "localhost";
$username = "root";
$password = "";
$database = "signupdata";

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$newUsername = mysqli_real_escape_string($conn, $_POST['newUsername']);
$newEmail = mysqli_real_escape_string($conn, $_POST['newEmail']);
$newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
$confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

// Validate password match
if ($newPassword !== $confirmPassword) {
    echo "Error: Passwords do not match.";
    exit;
}

// Hash the password before storing in the database
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Insert data into the database
$sql = "INSERT INTO users (username, email, password) VALUES ('$newUsername', '$newEmail', '$hashedPassword')";



if ($conn->query($sql) === TRUE) {
    // No need to echo anything, just redirect with JavaScript
    echo "<script>window.location.href = 'index.html';</script>";
    exit; // Make sure to exit after redirecting
} else {
    echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    echo "<script>window.location.href = 'signup.html';</script>";
}




// Close connection
$conn->close();
?>
