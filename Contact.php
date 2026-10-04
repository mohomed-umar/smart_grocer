<?php
include "db.php";

$name    = $_POST['name'];
$email   = $_POST['email'];
$message = $_POST['message'];

$sql = "INSERT INTO contact_messages (name, email, message)
        VALUES ('$name', '$email', '$message')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Message sent successfully!');
    </script>";
} else {
    echo "Error";
}
?>