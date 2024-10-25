<?php
include("./Connection.php");
checkUserLoggedIn();
if (isset($_COOKIE['user_id'])) {
    setcookie("user_id", "", time() - 3600, "/");
    header("Location: ../index.php");
}
