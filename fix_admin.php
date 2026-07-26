<?php
// fix_admin.php - Insert admin directly

$conn = new mysqli('localhost', 'root', '', 'portfolio_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert admin with password: admin123
$sql = "INSERT INTO admin_users (username, password, email) VALUES 
        ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@example.com')
        ON DUPLICATE KEY UPDATE password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'";

if ($conn->query($sql)) {
    echo "✅ Admin user ready!<br>";
    echo "Login at: <a href='admin.php'>admin.php</a><br>";
    echo "Username: <strong>admin</strong><br>";
    echo "Password: <strong>admin123</strong>";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>