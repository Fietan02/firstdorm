<?php
include 'db.php';
session_start();

// Only admins can edit reservations
if (!isset($_SESSION['admin_id'])) {
  header("Location: admin_login.php");
  exit;
}

$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
if ($id <= 0) {
  header('Location: dashboard.php');
  exit;
}

// Handle POST (update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $room = $_POST['room'] ?? '';
    $checkin = $_POST['checkin'] ?? '';
    $checkout = $_POST['checkout'] ?? '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0.00;

    $stmt = $conn->prepare("UPDATE reservations SET name = ?, room_number = ?, check_in = ?, check_out = ?, price = ? WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param('ssssdi', $name, $room, $checkin, $checkout, $price, $id);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: admin_dashboard.php');
    exit;
}

// Fetch existing record
$stmt = $conn->prepare("SELECT id, name, room_number, check_in, check_out, price FROM reservations WHERE id = ? LIMIT 1");
if (!$stmt) {
    header('Location: dashboard.php');
    exit;
}
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
$stmt->close();

if (!$row) {
    header('Location: dashboard.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Reservation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header">
            <h5 class="mb-0">Edit Reservation</h5>
          </div>
          <div class="card-body">
            <form method="POST">
              <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($row['name']) ?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Room</label>
                <input type="text" name="room" class="form-control" required value="<?= htmlspecialchars($row['room_number']) ?>">
              </div>
              <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?= isset($row['price']) ? htmlspecialchars($row['price']) : '0.00' ?>">
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Check-In</label>
                  <input type="date" name="checkin" class="form-control" required value="<?= htmlspecialchars($row['check_in']) ?>">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Check-Out</label>
                  <input type="date" name="checkout" class="form-control" required value="<?= htmlspecialchars($row['check_out']) ?>">
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
