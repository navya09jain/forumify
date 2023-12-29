<?php
$showError = "false";
session_start(); // Always start the session at the beginning

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];

    $sql = "SELECT * FROM user WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($pass, $row['user_password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['useremail'] = $email;
            header("Location: /forum/index.php");
            exit(); // Add exit() to prevent further execution after redirection
        } else {
            $_SESSION['loggedin'] = false;
            $showError = "Invalid Credentials";
        }
    } else {
        $_SESSION['loggedin'] = false;
        $showError = "Invalid Credentials";
    }
}

// If the login was unsuccessful, set the error message in the session
if ($_SESSION['loggedin'] == false) {
    $_SESSION['showError'] = $showError;
}

// Continue with the rest of your code (HTML, alerts, etc.)
header("Location: /forum/index.php");
exit(); // Add exit() to prevent further execution after redirection