<?php
// Database update script
require_once(__DIR__ . "/../includes/config.php");
require_once(__DIR__ . "/handlers/Connection.php");

echo "<h1>Database Update Script</h1>";
echo "<p>This script will update your database schema to fix the missing columns.</p>";

try {
    // Create database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    echo "<p>✅ Database connection successful</p>";
    
    // Check if users table exists
    $result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($result->num_rows == 0) {
        echo "<p>❌ Users table doesn't exist. Please run the database_setup.sql script first.</p>";
        exit;
    }
    
    echo "<p>✅ Users table exists</p>";
    
    // Check if membership_type column exists
    $result = $conn->query("SHOW COLUMNS FROM users LIKE 'membership_type'");
    if ($result->num_rows == 0) {
        // Add membership_type column
        $sql = "ALTER TABLE users ADD COLUMN membership_type ENUM('individual', 'team') DEFAULT 'individual' AFTER bio";
        if ($conn->query($sql) === TRUE) {
            echo "<p>✅ Added 'membership_type' column to users table</p>";
        } else {
            echo "<p>❌ Error adding 'membership_type' column: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>✅ 'membership_type' column already exists</p>";
    }
    
    // Check if team_id column exists
    $result = $conn->query("SHOW COLUMNS FROM users LIKE 'team_id'");
    if ($result->num_rows == 0) {
        // Add team_id column
        $sql = "ALTER TABLE users ADD COLUMN team_id INT NULL AFTER membership_type";
        if ($conn->query($sql) === TRUE) {
            echo "<p>✅ Added 'team_id' column to users table</p>";
        } else {
            echo "<p>❌ Error adding 'team_id' column: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>✅ 'team_id' column already exists</p>";
    }
    
    // Check if Age column exists
    $result = $conn->query("SHOW COLUMNS FROM users LIKE 'Age'");
    if ($result->num_rows == 0) {
        // Add Age column
        $sql = "ALTER TABLE users ADD COLUMN Age INT AFTER bio";
        if ($conn->query($sql) === TRUE) {
            echo "<p>✅ Added 'Age' column to users table</p>";
        } else {
            echo "<p>❌ Error adding 'Age' column: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>✅ 'Age' column already exists</p>";
    }
    
    // Check if team_type column exists
    $result = $conn->query("SHOW COLUMNS FROM users LIKE 'team_type'");
    if ($result->num_rows == 0) {
        // Add team_type column if it doesn't exist
        $sql = "ALTER TABLE users ADD COLUMN team_type VARCHAR(50) DEFAULT NULL AFTER membership_type";
        if ($conn->query($sql) === TRUE) {
            echo "<p>✅ Added 'team_type' column to users table</p>";
        } else {
            echo "<p>❌ Error adding 'team_type' column: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>✅ 'team_type' column already exists</p>";
    }
    
    // Check if teams table exists
    $result = $conn->query("SHOW TABLES LIKE 'teams'");
    if ($result->num_rows == 0) {
        // Create teams table
        $sql = "CREATE TABLE teams (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "<p>✅ Created 'teams' table</p>";
        } else {
            echo "<p>❌ Error creating 'teams' table: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>✅ 'teams' table already exists</p>";
    }
    
    echo "<h2>Database Update Complete</h2>";
    echo "<p><a href='index.php'>Return to homepage</a></p>";
    echo "<p><a href='db_test.php'>Run database test</a></p>";
    
    // Close connection
    $conn->close();
    
} catch (Exception $e) {
    echo "<h2>⚠️ Error</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?> 