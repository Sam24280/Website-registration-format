<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users1 WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        $hashed_password = $user_data['password'];

        if (password_verify($password, $hashed_password)) {
            // Login successful, redirect to dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            header('Location: loginaccess.html?error=1');
            exit;
        }
    } else {
        header('Location: loginaccess.html?error=1');
        exit;
    }
}

