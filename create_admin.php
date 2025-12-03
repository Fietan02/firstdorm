<?php
// create_admin.php
// Simple utility to create an `admins` table and add an admin user.
// IMPORTANT: Remove this file after use to avoid leaving an open admin-creation endpoint.

include 'db.php';
$display_errors = true;
if ($display_errors) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

// Basic page to accept username/password and insert into DB with password_hash
// Show DB connection errors (if any)
if (isset($conn) && $conn->connect_error) {
  echo '<div style="color:red; font-weight:bold;">DB connection error: ' . htmlspecialchars($conn->connect_error) . '</div>';
}
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $message = 'Username and password are required.';
    } else {
        // Create admins table if it doesn't exist
        $createSql = "CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $conn->query($createSql);

        // Check existing
        $chk = $conn->prepare('SELECT id FROM admins WHERE username = ? LIMIT 1');
        if ($chk) {
            $chk->bind_param('s', $username);
            $chk->execute();
            $chk->store_result();
            if ($chk->num_rows > 0) {
                $message = 'An admin with that username already exists.';
                $chk->close();
            } else {
                $chk->close();
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $ins = $conn->prepare('INSERT INTO admins (username, password) VALUES (?, ?)');
                if ($ins) {
                    $ins->bind_param('ss', $username, $hash);
                    if ($ins->execute()) {
                        $message = 'Admin created successfully. Be sure to delete this file (create_admin.php).';
                    } else {
                        $message = 'Failed to insert admin: ' . htmlspecialchars($ins->error);
                    }
                    $ins->close();
                } else {
                    $message = 'Failed to prepare insert statement.';
                }
            }
        } else {
            $message = 'Failed to check existing admins.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Admin - Dormitory</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>body{background:#f8f9fa;padding-top:40px}</style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="card-title mb-3">Create Admin Account</h4>
            <?php if ($message): ?>
              <div class="alert alert-info"><?php echo $message; ?></div>
            <?php endif; ?>
            <form method="post">
              <div class="mb-3">
                <label class="form-label">Admin Username</label>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Create Admin</button>
                <a href="login.php" class="btn btn-secondary">Back to Login</a>
              </div>
            </form>
            <hr>
            <div class="small text-muted">Security: remove this file after creating the admin account.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
