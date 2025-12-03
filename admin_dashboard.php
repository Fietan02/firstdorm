<?php
include 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
  header('Location: admin_login.php');
  exit;
}

// Handle deletion
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
  if ($stmt) {
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
  }
  header('Location: admin_dashboard.php');
  exit;
}

$result = $conn->query("SELECT * FROM reservations ORDER BY check_in ASC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard - DormEase</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">DormEase Admin</a>
      <div>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container py-4">
    <h3 class="mb-3">Reservations</h3>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="table-secondary text-center">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Room</th>
            <th>Price</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['room_number']) ?></td>
              <td><?= isset($row['price']) ? number_format((float)$row['price'],2) : '-' ?></td>
              <td><?= $row['check_in'] ?></td>
              <td><?= $row['check_out'] ?></td>
              <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil-fill"></i></a>
                <a href="admin_dashboard.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete reservation?')"><i class="bi bi-trash-fill"></i></a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
