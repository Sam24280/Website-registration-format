<?php
// register.php

// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'users'; // Change to your database name

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validate the form data
if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    die('Please fill in all fields');
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email format');
}

// Check if email already exists
$sql = "SELECT * FROM users1 WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    die('Email already exists');
}

// Check if passwords match
if ($password != $confirm_password) {
    die('Passwords do not match');
}

// Hash the password
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Insert the user data into the database
$sql = "INSERT INTO users1 (username, email, password) VALUES ('$username', '$email', '$password_hash')";
if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>