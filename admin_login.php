<?php include 'db.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - DormEase</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: linear-gradient(to right, #343a40, #212529); color: white; }
    .card { max-width: 420px; margin: 80px auto; padding: 20px; border-radius: 10px; }
    .btn-admin { background: #6c757d; color: white; }
  </style>
</head>
<body>
  <div class="container">
    <div class="card bg-light text-dark">
      <h3 class="text-center mb-3">Admin Login</h3>
      <form method="POST">
        <div class="mb-3">
          <input type="text" name="username" class="form-control" placeholder="Admin username" required>
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-admin w-100">Login as Admin</button>
      </form>
      <div class="mt-3 text-center">
        <a href="login.php" class="btn btn-outline-secondary w-100">Back to User Login</a>
      </div>
      <div class="mt-3 text-center text-danger">
        <?php
        if (
          $_SERVER["REQUEST_METHOD"] == "POST"
        ) {
          $username = $_POST['username'];
          $password = $_POST['password'];

          // Check admins table
          $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username=?");
          if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $hashed);
            if ($stmt->num_rows > 0) {
              $stmt->fetch();
              if (password_verify($password, $hashed)) {
                $_SESSION['admin_id'] = $id;
                header("Location: admin_dashboard.php");
                exit;
              } else {
                echo "Invalid password.";
              }
            } else {
              echo "Admin user not found. Create an admin account in the database.";
            }
            $stmt->close();
          } else {
            echo "Admin login not available. Ensure an `admins` table exists.";
          }
        }
        ?>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
