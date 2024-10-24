<head>
    <link rel="stylesheet" href="../build.css">
</head>

<?php
session_start();
include("../handlers/Connection.php");

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {

    // Sanitize inputs using a custom validation function (ensure Validate() function exists)
    $username = Validate($_POST["username"]);
    $password = Validate($_POST["password"]);
    $email = Validate($_POST["email"]);

    // Prepared statement to select user data
    $stmt = mysqli_prepare($conn, "SELECT id, username, Password FROM users WHERE email = ?");

    if ($stmt) {
        // Bind the email parameter
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Check if user with the given email exists
        if (mysqli_stmt_num_rows($stmt) > 0) {
            // Bind the result columns
            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
            mysqli_stmt_fetch($stmt);

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Successful login, set session variables
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['logged_in'] = true;
                setcookie("user_id", $id, time() + (86400 * 30), "/");
                header("Location: ../Home.php");
                exit();
            } else {
                // Password is incorrect
                $_SESSION['error'] = "Invalid email or password.";
                header("Location: ../index.php ");
            }
        } else {
            $_SESSION['error'] = "No user found with that email.";
            header("Location: ../index.php ");
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Query error
        $_SESSION['error'] = "Database error: " . mysqli_error($conn);
    }
} else {
    // Missing fields
    $_SESSION['error'] = "Please fill in all required fields.";
    echo $_SESSION['error'];
}
?>