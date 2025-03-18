<?php
// Database connection test file

// Include the configuration
require_once(__DIR__ . "/../includes/config.php");

// Try to connect to the database
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    echo "<h1>Database Connection Successful!</h1>";
    
    // Check if users table exists
    $result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($result->num_rows > 0) {
        echo "<p>✅ Users table exists</p>";
    } else {
        echo "<p>❌ Users table does not exist</p>";
    }
    
    // Check if questions table exists
    $result = $conn->query("SHOW TABLES LIKE 'questions'");
    if ($result->num_rows > 0) {
        echo "<p>✅ Questions table exists</p>";
        
        // Check if there are questions in the database
        $result = $conn->query("SELECT COUNT(*) as count FROM questions");
        $row = $result->fetch_assoc();
        echo "<p>Number of questions in database: " . $row['count'] . "</p>";
    } else {
        echo "<p>❌ Questions table does not exist</p>";
    }
    
    // Check if quiz_scores table exists
    $result = $conn->query("SHOW TABLES LIKE 'quiz_scores'");
    if ($result->num_rows > 0) {
        echo "<p>✅ Quiz scores table exists</p>";
    } else {
        echo "<p>❌ Quiz scores table does not exist</p>";
    }
    
    // Show database configuration
    echo "<h2>Database Configuration</h2>";
    echo "<p>Host: " . DB_HOST . "</p>";
    echo "<p>Database: " . DB_NAME . "</p>";
    echo "<p>User: " . DB_USER . "</p>";
    
    // Close connection
    $conn->close();
    
} catch (Exception $e) {
    echo "<h1>Database Connection Failed</h1>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    
    echo "<h2>Troubleshooting</h2>";
    echo "<ol>";
    echo "<li>Make sure MySQL server is running</li>";
    echo "<li>Verify database credentials in includes/credentials.php</li>";
    echo "<li>Check if database '" . DB_NAME . "' exists</li>";
    echo "<li>Run the database setup script: mysql -u " . DB_USER . " -p " . DB_NAME . " < database_setup.sql</li>";
    echo "</ol>";
}
?> 