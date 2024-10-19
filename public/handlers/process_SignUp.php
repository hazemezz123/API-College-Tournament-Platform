<?php
session_start();
include("../handlers/Connection.php");
include("../layouts/nav.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["age"])) {

        $username = Validate($_POST["username"]);
        $password = Validate($_POST["password"]);
        $email = Validate($_POST["email"]);
        $age = Validate($_POST["age"]);

        $stmt = mysqli_prepare($conn, "SELECT email FROM users WHERE email = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 0) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $stmt_insert = mysqli_prepare($conn, "INSERT INTO users (username, email, Age, Password) VALUES (?, ?, ?, ?)");
                if ($stmt_insert) {
                    mysqli_stmt_bind_param($stmt_insert, "ssis", $username, $email, $age, $hashed_password);

                    if (mysqli_stmt_execute($stmt_insert)) {
                        $_SESSION['Submit'] = "Registration successful!";
                        header("Location: regSuc.php"); // Redirect to a new page
                        exit(); // Ensure no further code runs after the redirect
                    } else {
                        $_SESSION['Submit'] = "An error occurred: " . mysqli_error($conn);
                    }
                    mysqli_stmt_close($stmt_insert);
                } else {
                    $_SESSION['Submit'] = "Prepared statement for inserting user failed: " . mysqli_error($conn);
                }
            } else {
                $_SESSION['Submit'] = "The email is already in use. Try another one!";
            }
            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['Submit'] = "Prepared statement for checking email failed: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['Submit'] = "All fields are required!";
    }
}
