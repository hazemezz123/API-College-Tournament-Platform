<?php
// Include session configuration (must be included before session_start)
require_once(__DIR__ . '/session_config.php');

// Start session using our configured settings
start_session_if_not_started();

// Include database credentials
require_once(__DIR__ . '/credentials.php');

// Application Settings
define('APP_NAME', 'Student Tournament Platform');
define('APP_URL', 'http://localhost:8000');
define('UPLOAD_PATH', '../assets/uploads/');
define('MAX_UPLOAD_SIZE', 2 * 1024 * 1024); // 2MB

// Error settings (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Security functions
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 
