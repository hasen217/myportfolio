<?php
// setup_db.php - Run once to create database and tables

$conn = new mysqli('localhost', 'root', '');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$conn->query("CREATE DATABASE IF NOT EXISTS portfolio_db");
$conn->select_db('portfolio_db');

// Create contact_messages table
$sql = "CREATE TABLE IF NOT EXISTS contact_messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(200) DEFAULT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('unread', 'read', 'replied') DEFAULT 'unread'
)";

if ($conn->query($sql)) {
    echo "✅ Table 'contact_messages' created successfully!<br>";
} else {
    echo "❌ Error: " . $conn->error . "<br>";
}

echo "<br>✅ Database setup complete!";
echo "<br>Now test your contact form.";

$conn->close();
?>