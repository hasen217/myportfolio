<?php
// admin.php - Admin panel to view and manage contact messages
session_start();

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portfolio_db');

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
$is_logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Login handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = trim($_POST['password']);
    
    $stmt = $conn->prepare("SELECT id, password FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Verify password (using password_hash for security)
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_username'] = $username;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $login_error = "Invalid username or password!";
        }
    } else {
        $login_error = "Invalid username or password!";
    }
    $stmt->close();
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Update message status
if ($is_logged_in && isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];
    
    if ($action === 'read') {
        $stmt = $conn->prepare("UPDATE contact_messages SET status = 'read' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } elseif ($action === 'delete') {
        $stmt = $conn->prepare("DELETE FROM contact_messages WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Get messages for admin
$messages = [];
if ($is_logged_in) {
    $result = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
        $result->free();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel - Portfolio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
        }
        .admin-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .admin-header {
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .admin-header h1 {
            font-size: 24px;
            color: #333;
        }
        .admin-header h1 span {
            color: #6c63ff;
        }
        .logout-btn {
            background: #dc3545;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .logout-btn:hover {
            background: #c82333;
        }
        .login-box {
            max-width: 400px;
            margin: 100px auto;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        .login-box h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .login-box .btn {
            width: 100%;
            padding: 12px;
            background: #6c63ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .login-box .btn:hover {
            background: #5a52d5;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .stat-card h3 {
            color: #6c63ff;
            font-size: 28px;
        }
        .stat-card p {
            color: #666;
            margin-top: 5px;
        }
        .messages-table {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .messages-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .messages-table th {
            background: #6c63ff;
            color: #fff;
            padding: 12px 15px;
            text-align: left;
        }
        .messages-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        .messages-table tr:hover {
            background: #f8f9fa;
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-badge.unread {
            background: #ffc107;
            color: #333;
        }
        .status-badge.read {
            background: #28a745;
            color: #fff;
        }
        .status-badge.replied {
            background: #17a2b8;
            color: #fff;
        }
        .action-btns a {
            margin-right: 10px;
            text-decoration: none;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 13px;
            transition: all 0.3s;
        }
        .action-btns .read-btn {
            background: #28a745;
            color: #fff;
        }
        .action-btns .read-btn:hover {
            background: #218838;
        }
        .action-btns .delete-btn {
            background: #dc3545;
            color: #fff;
        }
        .action-btns .delete-btn:hover {
            background: #c82333;
        }
        .no-messages {
            padding: 40px;
            text-align: center;
            color: #666;
        }
        @media (max-width: 768px) {
            .messages-table {
                overflow-x: auto;
            }
            .admin-header {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>

<div class="admin-container">
    <?php if (!$is_logged_in): ?>
        <!-- Login Form -->
        <div class="login-box">
            <h2><i class="fas fa-lock"></i> Admin Login</h2>
            <?php if (isset($login_error)): ?>
                <div class="error"><?php echo $login_error; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username" required />
                <input type="password" name="password" placeholder="Password" required />
                <button type="submit" name="login" class="btn">Login</button>
            </form>
        </div>
    <?php else: ?>
        <!-- Admin Dashboard -->
        <div class="admin-header">
            <h1><i class="fas fa-envelope"></i> <span>Messages</span></h1>
            <div>
                <span style="margin-right: 15px; color: #666;">
                    <i class="fas fa-user"></i> <?php echo $_SESSION['admin_username']; ?>
                </span>
                <a href="?logout=1" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>

        <!-- Statistics -->
        <?php
        $total = count($messages);
        $unread = 0;
        foreach ($messages as $msg) {
            if ($msg['status'] === 'unread') $unread++;
        }
        ?>
        <div class="stats">
            <div class="stat-card">
                <h3><?php echo $total; ?></h3>
                <p>Total Messages</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $unread; ?></h3>
                <p>Unread Messages</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $total - $unread; ?></h3>
                <p>Read Messages</p>
            </div>
        </div>

        <!-- Messages Table -->
        <div class="messages-table">
            <?php if (count($messages) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Received</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($messages as $msg): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo htmlspecialchars($msg['name']); ?></td>
                                <td><?php echo htmlspecialchars($msg['email']); ?></td>
                                <td><?php echo htmlspecialchars($msg['subject'] ?: 'N/A'); ?></td>
                                <td><?php echo substr(htmlspecialchars($msg['message']), 0, 50) . '...'; ?></td>
                                <td>
                                    <span class="status-badge <?php echo $msg['status']; ?>">
                                        <?php echo ucfirst($msg['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('d M Y, h:i A', strtotime($msg['created_at'])); ?></td>
                                <td class="action-btns">
                                    <?php if ($msg['status'] === 'unread'): ?>
                                        <a href="?action=read&id=<?php echo $msg['id']; ?>" class="read-btn">
                                            <i class="fas fa-check"></i> Mark Read
                                        </a>
                                    <?php endif; ?>
                                    <a href="?action=delete&id=<?php echo $msg['id']; ?>" 
                                       class="delete-btn" 
                                       onclick="return confirm('Are you sure you want to delete this message?');">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-messages">
                    <i class="fas fa-inbox" style="font-size: 48px; color: #ccc; margin-bottom: 10px; display: block;"></i>
                    <p>No messages received yet.</p>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>