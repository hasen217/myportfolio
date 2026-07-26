<?php
// setup_admin.php - Complete admin setup

// Database connection
$conn = new mysqli('localhost', 'root', '', 'portfolio_db');

if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}

// Create admin_users table if not exists
$sql = "CREATE TABLE IF NOT EXISTS admin_users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql)) {
    echo "✅ Table 'admin_users' ready<br>";
}

// Delete old admin
$conn->query("DELETE FROM admin_users WHERE username = 'admin'");

// Create new admin with password 'admin123'
$hashed = password_hash('admin123', PASSWORD_DEFAULT);
$sql = "INSERT INTO admin_users (username, password, email) 
        VALUES ('admin', '$hashed', 'admin@example.com')";

if ($conn->query($sql)) {
    echo "✅ Admin user created!<br>";
    echo "<hr>";
    echo "<h3>Login Credentials:</h3>";
    echo "🔗 URL: <a href='admin.php'>admin.php</a><br>";
    echo "👤 Username: <strong style='color:blue'>admin</strong><br>";
    echo "🔑 Password: <strong style='color:green'>admin123</strong><br>";
    echo "<hr>";
    echo "⚠️ <strong>Important:</strong> Delete this file after login!";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>