<head>
    <link rel="stylesheet" href="../build.css">
</head>

<?php
// Include config file which already has session_start()
require_once(__DIR__ . "/../../includes/config.php");
require_once("./Connection.php");

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {
    $username = Validate($_POST["username"]);
    $password = Validate($_POST["password"]);
    $email = Validate($_POST["email"]);
    $result_1 = mysqli_query($conn, "SELECT team_id FROM users WHERE email = '$email'");
    $row_1 = $result_1->fetch_assoc();
    $stmt = mysqli_prepare($conn, "SELECT id, username,  Password FROM users WHERE email = ?");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
            mysqli_stmt_fetch($stmt);

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['logged_in'] = true;
                $team_id = $row_1['team_id'];
                setcookie("user_id", $id, time() + (86400 * 30), "/");
                setcookie("team_id", $team_id, time() + (86400 * 30), "/");
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