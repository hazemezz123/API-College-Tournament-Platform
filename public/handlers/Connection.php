<?php
require_once __DIR__ . '/../../includes/config.php';

// Create database connection
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to ensure proper encoding
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    // Log the error (in a production environment)
    error_log("Database connection error: " . $e->getMessage());
    
    // Display user-friendly message and terminate script
    die("We're experiencing technical difficulties. Please try again later.");
}

// Input validation function
function Validate($data) {
    return sanitize_input($data);
}

// Check if user is logged in
function checkUserLoggedIn() {
    if (!isset($_COOKIE['user_id'])) {
        header("Location: " . APP_URL . "/index.php");
        exit();
    }
}

// Get user data by ID
function getUserData($conn, $user_id) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    if (!$stmt) {
        error_log("Database error in getUserData: " . $conn->error);
        return false;
    }
    
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}
