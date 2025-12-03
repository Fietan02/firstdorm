<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>DormEase Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #20c997, #17a2b8);
      font-family: "Segoe UI", sans-serif;
    }
    .register-container {
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
      background-color: white;
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
  <div class="register-container">
    <div class="card">
      <h3 class="text-center mb-4 text-teal">DormEase Registration</h3>
      <form method="POST">
        <div class="mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3">
          <input type="text" name="Email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-teal w-100">Register</button>
      </form>

      <!-- Login Button -->
      <div class="mt-3 text-center">
        <a href="login.php" class="btn btn-outline-secondary w-100">Already have an account? Login</a>
      </div>

      <!-- PHP Registration Logic -->
      <div class="mt-3 text-center">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $username = trim($_POST['username']);
          $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

          // Check if username already exists
          $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
          $check->bind_param("s", $username);
          $check->execute();
          $check->store_result();

          if ($check->num_rows > 0) {
            echo '<div class="text-danger">Username already exists. Try another.</div>';
          } else {
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
            if ($stmt->execute()) {
              echo '<div class="text-success">Registered successfully! Redirecting to login...</div>';
              header("refresh:2;url=login.php");
            } else {
              echo '<div class="text-danger">Registration failed. Please try again.</div>';
            }
          }
        }
        ?>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>