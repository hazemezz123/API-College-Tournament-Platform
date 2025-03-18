<?php
// Test file to check available question types in the database
require_once(__DIR__ . "/../includes/config.php");

echo "<h1>Available Quiz Types in Database</h1>";

try {
    // Create database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Get all distinct question types
    $sql = "SELECT DISTINCT question_type FROM questions";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<h2>Found " . $result->num_rows . " unique question types:</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><strong>" . $row['question_type'] . "</strong> - <a href='Quiz_PHP.php?question_Type=" . urlencode($row['question_type']) . "'>Take this quiz</a></li>";
        }
        echo "</ul>";
        
        // Count questions by type
        $sql = "SELECT question_type, COUNT(*) as count FROM questions GROUP BY question_type";
        $result = $conn->query($sql);
        
        echo "<h2>Question counts by type:</h2>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>Question Type</th><th>Count</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['question_type'] . "</td><td>" . $row['count'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No question types found in the database.</p>";
    }
    
    // Close connection
    $conn->close();
    
} catch (Exception $e) {
    echo "<h2>⚠️ Error</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}

echo "<p><a href='index.php'>Return to homepage</a></p>";
?> 