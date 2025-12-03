<?php include 'db.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>DormEase Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #20c997, #17a2b8);
      font-family: "Segoe UI", sans-serif;
    }
    .login-container {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card {
      width: 100%;
      max-width: 400px;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .btn-teal {
      background-color: #20c997;
      color: white;
      font-weight: bold;
    }
    .btn-teal:hover {
      background-color: #17a2b8;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="card">
      <h3 class="text-center mb-4">DormEase Login</h3>
      <form method="POST">
        <div class="mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-teal w-100">Login</button>
        <!-- Add this below the login button -->
        <div class="mt-3 text-center">
          <a href="register.php" class="btn btn-teal w-100 mb-2">Create Account</a>
          <a href="admin_login.php" class="btn btn-outline-light w-100">Admin Login</a>
        </div>
      </form>
      <div class="mt-3 text-center text-danger">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $username = $_POST['username'];
          $password = $_POST['password'];
          $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=?");
          $stmt->bind_param("s", $username);
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($id, $hashed);
          if ($stmt->num_rows > 0) {
            $stmt->fetch();
            if (password_verify($password, $hashed)) {
              $_SESSION['user_id'] = $id;
              header("Location: dashboard.php");
              exit;
            } else {
              echo "Invalid password.";
            }
          } else {
            echo "User not found.";
          }
        }
        ?>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>