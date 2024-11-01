<?php
session_start();
include("../handlers/Connection.php");
include("../layouts/nav.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["age"]) && isset($_POST['participation_type'])) {
        $username = Validate($_POST["username"]);
        $password = Validate($_POST["password"]);
        $email = Validate($_POST["email"]);
        $age = Validate($_POST["age"]);
        $participation_type = $_POST['participation_type'];
        $team_id = isset($_POST['team']) ? $_POST['team'] : null;
        // Check the maximum user count
        $result = mysqli_query($conn, "SELECT COUNT(*) as userCount FROM users");
        $row = mysqli_fetch_assoc($result);

        if ($row['userCount'] >= 40) {
            $_SESSION['Submit'] = "Maximum number of users reached. You cannot register more than 40 users.";
            header("Location: ../SignUp.php");
            exit();
        } else {
            // Check if the email is already in use
            $stmt = mysqli_prepare($conn, "SELECT email FROM users WHERE email = ?");
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 0) {
                    // If participation type is "team," check if the team limit is reached
                    if ($participation_type == 'team') {
                        $teamCountQuery = "SELECT COUNT(*) as teamCount FROM users WHERE membership_type = 'team'";
                        $teamCountResult = mysqli_query($conn, $teamCountQuery);
                        $teamCountRow = mysqli_fetch_assoc($teamCountResult);

                        if ($teamCountRow['teamCount'] >= 5) {
                            $_SESSION['Submit'] = "Team participation is full. Only 5 members are allowed in a team.";
                            header("Location: ../SignUp.php");
                            exit();
                        }
                    }

                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insert the new user into the database
                    $stmt_insert = mysqli_prepare($conn, "INSERT INTO users (username, membership_type, team_id, email, Age,Password ) VALUES (?, ?, ?, ?, ?,?)");
                    if ($stmt_insert) {
                        mysqli_stmt_bind_param($stmt_insert, "ssisis", $username, $participation_type, $team_id, $email, $age, $hashed_password);
                        if (mysqli_stmt_execute($stmt_insert)) {
                            $_SESSION['Submit'] = "Registration successful!";
                            header("Location: regSuc.php");
                            exit();
                        } else {
                            $_SESSION['Submit'] = "An error occurred: " . mysqli_error($conn);
                        }
                        mysqli_stmt_close($stmt_insert);
                    } else {
                        $_SESSION['Submit'] = "Prepared statement for inserting user failed: " . mysqli_error($conn);
                        header("Location: ../SignUp.php");
                        exit();
                    }
                } else {
                    $_SESSION['Submit'] = "The email is already in use. Try another one!";
                    header("Location: ../SignUp.php");
                    exit();
                }
                mysqli_stmt_close($stmt);
            } else {
                $_SESSION['Submit'] = "Prepared statement for checking email failed: " . mysqli_error($conn);
                header("Location: ../SignUp.php");
                exit();
            }
        }
    } else {
        $_SESSION['Submit'] = "All fields are required!";
        header("Location: ../SignUp.php");
        exit();
    }
}
