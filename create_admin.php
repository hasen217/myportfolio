<?php
// create_admin.php - Quick admin creator

$conn = new mysqli('localhost', 'root', '', 'portfolio_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete existing admin
$conn->query("DELETE FROM admin_users WHERE username = 'admin'");

// Password: admin123
$hashed = password_hash('admin123', PASSWORD_DEFAULT);

$sql = "INSERT INTO admin_users (username, password, email) 
        VALUES ('admin', '$hashed', 'admin@example.com')";

if ($conn->query($sql)) {
    echo "✅ Admin created!<br>";
    echo "Username: <strong>admin</strong><br>";
    echo "Password: <strong>admin123</strong><br>";
    echo "<br><a href='admin.php'>Go to Admin Panel</a>";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>