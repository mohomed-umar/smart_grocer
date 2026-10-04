<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check user
    $sql = "SELECT * FROM signup WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        // IMPORTANT: verify hashed password
        if (password_verify($password, $row['password'])) {

            $_SESSION['user_id']  = $row['id'];
            $_SESSION['username'] = $row['username'];

            echo "<script>
                    alert('Login successful!');
                    window.location.href = 'Home.html';
                  </script>";
            exit;

        } else {
            echo "<script>alert('Wrong password');</script>";
        }

    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>
