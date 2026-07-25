<?php
// test_login.php - Test if admin exists

$conn = new mysqli('localhost', 'root', '', 'portfolio_db');

if ($conn->connect_error) {
    die("❌ DB Connection failed");
}

$result = $conn->query("SELECT * FROM admin_users WHERE username = 'admin'");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "✅ Admin exists in database<br>";
    echo "Username: " . $row['username'] . "<br>";
    echo "Password hash: " . $row['password'] . "<br>";
    echo "<br>Try login with: <strong>admin / admin123</strong>";
} else {
    echo "❌ Admin not found! Run create_admin.php";
}

$conn->close();
?>