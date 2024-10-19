<?php
$conn = mysqli_connect("localhost", "root", "", "students_tournament") or die(mysqli_connect_error());
function Validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
