<?php
// login.php

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
$usernameOrEmail = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Fetch user from the database
$sql = "SELECT * FROM users WHERE username = '$usernameOrEmail' OR email = '$usernameOrEmail'";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        header('Location: home.html');
        exit; // Make sure to exit after redirecting
    } else {
        echo "<script>alert('Invalid password!'); window.location.href = 'index.html';</script>";
    }
} else {
    echo "<script>alert('User not found! Please Signup'); window.location.href = 'index.html';</script>";
}


// Close connection
$conn->close();
?>
