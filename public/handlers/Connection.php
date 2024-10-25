<?php
$conn = mysqli_connect("localhost", "root", "", "students_tournament") or die(mysqli_connect_error());
function Validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function checkUserLoggedIn()
{
    if (!isset($_COOKIE['user_id'])) {
        header("Location: ../public/index.php");
        exit();
    }
}
