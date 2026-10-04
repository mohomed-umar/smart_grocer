<?php
include "db.php";
$conn = new mysqli("localhost", "root", "", "smart_grocer");

if ($conn->connect_error) {
    die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST['fullname']);
    $email    = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $cpass    = $_POST['confirm_password'];

     if ($password !== $cpass) {
        echo "<script>alert('Passwords do not match!'); history.back();</script>";
        exit;
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO signup (fullname, email, username, password)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssss", $fullname, $email, $username, $hashed);

    if ($stmt->execute()) {
        echo "<script>
                alert('Signup successful! You can now log in.');
                window.location.href = 'login.html';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

