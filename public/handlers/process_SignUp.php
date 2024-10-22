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

        // Check user count before inserting
        $result = mysqli_query($conn, "SELECT COUNT(*) as userCount FROM users");
        $row = mysqli_fetch_assoc($result);

        if ($row['userCount'] >= 40) {
            $_SESSION['Submit'] = "Maximum number of users reached. You cannot register more than 40 users.";
        } else {    
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
                            header("Location: regSuc.php");
                            exit(); // Ensure no further code runs after the redirect
                        } else {
                            $_SESSION['Submit'] = "An error occurred: " . mysqli_error($conn);
                        }
                        mysqli_stmt_close($stmt_insert);
                    } else {
                        $_SESSION['Submit'] = "Prepared statement for inserting user failed: " . mysqli_error($conn);
                        echo $_SESSION['Submit'];
                    }
                } else {
                    $_SESSION['Submit'] = "The email is already in use. Try another one!";
                    echo $_SESSION['Submit'];
                }
                mysqli_stmt_close($stmt);
            } else {
                $_SESSION['Submit'] = "Prepared statement for checking email failed: " . mysqli_error($conn);
                echo $_SESSION['Submit'];
            }
        }
    } else {
        $_SESSION['Submit'] = "All fields are required!";
        echo $_SESSION['Submit'];
    }
}
