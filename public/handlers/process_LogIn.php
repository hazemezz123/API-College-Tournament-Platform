<head>
    <link rel="stylesheet" href="../build.css">
</head>
<?php
session_start();
include("../handlers/Connection.php");


if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {

    // Sanitize inputs
    $username = Validate($_POST["username"]);
    $password = Validate($_POST["password"]);
    $email = Validate($_POST["email"]);  // Corrected email assignment

    // Prepared statement for selecting user data
    $stmt = mysqli_prepare($conn, "SELECT id, username, Password,email,age FROM users WHERE email = ?");

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
                $_SESSION['email'] = $username;
                $_SESSION['logged_in'] = true;
                header("Location: ../Home.php");
                exit();
            } else {
                // Password is incorrect
                $_SESSION['error'] = "Invalid email or password.";
                echo $_SESSION["error"];
            }
        } else {
            // No user with that email found
            $_SESSION['error'] = "No user found with that email.";
            echo $_SESSION["error"];
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // If there's a problem with the query
        $_SESSION['error'] = "Database error: " . mysqli_error($conn);
    }
} else {
    // If required fields are missing
    $_SESSION['error'] = "Please enter both email and password.";
    echo $_SESSION['error'];
}
?>