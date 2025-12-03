<?php
include 'db.php';
session_start();

// Allow access if regular user OR admin is logged in
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>DormEase Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .section {
      padding: 60px 20px;
    }
    .divider {
      height: 2px;
      background-color: rgba(255,255,255,0.2);
      margin: 0;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background: linear-gradient(to right, #20c997, #17a2b8);">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <i class="bi bi-house-door-fill me-2"></i>DormEase
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" href="#welcome">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
       <li class="nav-item">
        <li class="nav-item"><a class="nav-link" href="#reserve">Reserve</a></li>
       <li class="nav-item">
</li>
<li class="nav-item">
  <a class="btn btn-sm fw-bold text-white" href="logout.php"
     style="background: linear-gradient(to right, #28a745, #20c997); border: none;">
    <i class="bi bi-box-arrow-right me-1"></i> Logout
  </a>
</li>
      </ul>
  </nav>
    </div>
<section id=welcome class="d-flex align-items-center justify-content-center text-white vh-100" style="background: linear-gradient(to right, #20c997, #17a2b8);">
  <div class="container text-center">
    <i class="bi bi-house-door-fill display-4 mb-3"></i>
    <h1 class="display-3 fw-bold">Welcome to DormEase</h1>
    <p class="lead">Your comfort is our priority. Reserve your dormitory with ease.</p>
  </div>
</section>

<div class="divider"></div>
<section id="features" class="py-5" style="background: linear-gradient(135deg, #008080, #20c997); color: white;">
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-md-6">
        <div class="card text-center text-dark p-3 border-0 shadow-sm feature-title-card"
             style="background: linear-gradient(135deg, #e0f7f5, #d0f0ec); transition: transform 0.3s ease, box-shadow 0.3s ease;">
          <div class="card-body">
            <h2 class="fw-bold text-teal mb-0">Features</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center g-4 px-3">
      <div class="col-md-5 col-lg-4">
        <div class="card h-100 shadow-sm border-0" style="background: #d2fff5ff;">
          <div class="card-body text-center">
            <div class="d-flex justify-content-center mb-3">
              <i class="bi bi-cup-hot" style="font-size: 2rem; color: #20c997;"></i>
            </div>
            <h5 class="fw-bold text-teal">Cozy Common Lounge</h5>
            <p>Relax, socialize, or study in our stylish shared lounge with comfy seating and warm lighting.</p>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-lg-4">
        <div class="card h-100 shadow-sm border-0" style="background: #d2fff5ff;">
          <div class="card-body text-center">
            <div class="d-flex justify-content-center mb-3">
              <i class="bi bi-bicycle" style="font-size: 2rem; color: #20c997;"></i>
            </div>
            <h5 class="fw-bold text-teal">Bike-Friendly Access</h5>
            <p>Secure bike racks and easy access routes make commuting eco-friendly and convenient.</p>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-lg-4">
        <div class="card h-100 shadow-sm border-0" style="background: #d2fff5ff;">
          <div class="card-body text-center">
            <div class="d-flex justify-content-center mb-3">
              <i class="bi bi-laptop" style="font-size: 2rem; color: #20c997;"></i>
            </div>
            <h5 class="fw-bold text-teal">Study Pods</h5>
            <p>Quiet, tech-ready study areas designed for focus, group work, and online learning.</p>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-lg-4">
        <div class="card h-100 shadow-sm border-0" style="background: #d2fff5ff;">
          <div class="card-body text-center">
            <div class="d-flex justify-content-center mb-3">
              <i class="bi bi-droplet-half" style="font-size: 2rem; color: #20c997;"></i>
            </div>
            <h5 class="fw-bold text-teal">On-Site Laundry</h5>
            <p>Modern washers and dryers available 24/7 so you can stay fresh without leaving the dorm.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .feature-title-card:hover,
  #features .card:hover {
    transform: scale(1.03);
    box-shadow: 0 0 25px rgba(32, 201, 151, 0.5);
  }
  .text-teal {
    color: #008080;
  }
</style>
<div class="divider"></div>
<section id="about" class="py-5" style="background: linear-gradient(135deg, #008080, #20c997); color: white;">
  <div class="container text-center">
    <div class="row justify-content-center mb-4">
      <div class="col-md-10">
        <div class="card text-dark p-4 border-0 shadow-lg"
             style="background: linear-gradient(135deg, #e0f7f5, #d0f0ec);">
          <div class="card-body">
            <h3 class="fw-bold mb-3 text-teal">About DormEase</h3>
            <p class="lead mb-0">DormEase offers student-friendly dormitories with modern amenities, secure access, and hassle-free booking. Your comfort is our priority.</p>
          </div>
        </div>
        </div>
        </div>
    <div class="row justify-content-center g-4 px-3">
      <div class="col-md-5 col-lg-4">
        <div class="card h-100 shadow-sm border-0" style="background: #d2fff5ff;">
          <div class="card-body text-start">
            <i class="bi bi-wifi" style="font-size: 1.5rem; color: #20c997;"></i>
            <h5 class="mt-3 fw-bold text-teal">High-Speed Wi-Fi</h5>
            <p>Stay connected with fast and reliable internet throughout the dormitory.</p>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-lg-4">
        <div class="card h-100 shadow-sm border-0" style="background: #d2fff5ff;">
          <div class="card-body text-start">
            <i class="bi bi-shield-lock" style="font-size: 1.5rem; color: #20c997;"></i>
            <h5 class="mt-3 fw-bold text-teal">Secure Access</h5>
            <p>Enjoy peace of mind with keycard entry and 24/7 security monitoring.</p>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-lg-4">
        <div class="card h-100 shadow-sm border-0" style="background: #d2fff5ff;">
          <div class="card-body text-start">
            <i class="bi bi-calendar-check" style="font-size: 1.5rem; color: #20c997;"></i>
            <h5 class="mt-3 fw-bold text-teal">Hassle-Free Booking</h5>
            <p>Reserve your space online with instant confirmation and flexible options.</p>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-lg-4">
        <div class="card h-100 shadow-sm border-0" style="background: #d2fff5ff;">
          <div class="card-body text-start">
            <i class="bi bi-lightbulb" style="font-size: 1.5rem; color: #20c997;"></i>
            <h5 class="mt-3 fw-bold text-teal">Modern Lighting</h5>
            <p>Bright, energy-efficient lighting for a comfortable and productive space.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  #about .card:hover {
    transform: scale(1.03);
    box-shadow: 0 0 25px rgba(32, 201, 151, 0.4);
  }
  .text-teal {
    color: #008080;
  }
</style>
</div>
</section>
<div class="divider"></div>

<section id="contact" class="py-5" style="background: linear-gradient(135deg, #008080, #20c997); color: white;">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="fw-bold">Contact Us</h2>
      <p class="lead">Need help with your dorm reservation? We're here for you!</p>
    </div>
    <div class="row g-4">
      <div class="col-md-6">
        <div class="d-flex align-items-start mb-3">
          <i class="bi bi-geo-alt-fill fs-3 me-3"></i>
          <div>
            <h5 class="mb-1">Dormitory Address</h5>
            <p>123 Campus Lane, University Town, PH</p>
          </div>
        </div>
        <div class="d-flex align-items-start mb-3">
          <i class="bi bi-envelope-fill fs-3 me-3"></i>
          <div>
            <h5 class="mb-1">Email</h5>
            <p>reservations@dormhub.ph</p>
          </div>
        </div>
        <div class="d-flex align-items-start">
          <i class="bi bi-telephone-fill fs-3 me-3"></i>
          <div>
            <h5 class="mb-1">Phone</h5>
            <p>+63 912 345 6789</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <form>
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" placeholder="Juan Dela Cruz">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" placeholder="you@example.com">
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Your Message</label>
            <textarea class="form-control" id="message" rows="4" placeholder="Ask about availability, amenities, or bookings..."></textarea>
          </div>
          <button type="submit" class="btn btn-light text-teal fw-bold">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</section>
<section id="reserve" text-white rounded shadow-sm p-5 style="background: linear-gradient(135deg, #008080, #20c997); color: white;">
  <div class="container">
    <div class="text-center mb-4">
      <i class="bi bi-calendar-check-fill display-4 mb-3"></i>
      <h2 class="fw-bold">Ready to Reserve?</h2>
      <p class="lead">Book your dorm room and manage your stay below.</p>
    </div>

    <?php
    // Fetch bedroom options (used by add form)
    $bedrooms = [];
    $bedRes = $conn->query("SHOW TABLES LIKE 'bedrooms'");
    if ($bedRes && $bedRes->num_rows > 0) {
      $bq = $conn->query("SELECT id, room_number, price FROM bedrooms ORDER BY room_number ASC");
      if ($bq) {
        while ($brow = $bq->fetch_assoc()) {
          $bedrooms[] = $brow;
        }
      }
    }

    // Allow any logged-in user (user or admin) to add a reservation
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
      if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
        // not logged in - shouldn't happen because page requires login
      } else {
        $name = $_POST["name"] ?? '';
        $checkin = $_POST["checkin"] ?? '';
        $checkout = $_POST["checkout"] ?? '';

        $price = 0.00;
        if (!empty($_POST['room_id'])) {
          $room_id = intval($_POST['room_id']);
          $stmt = $conn->prepare("SELECT room_number, price FROM bedrooms WHERE id = ? LIMIT 1");
          if ($stmt) {
            $stmt->bind_param('i', $room_id);
            $stmt->execute();
            $stmt->bind_result($room_number, $room_price);
            if ($stmt->fetch()) {
              $room = $room_number;
              $price = floatval($room_price);
            } else {
              $room = '';
            }
            $stmt->close();
          } else {
            $room = '';
          }
        } else {
          $room = $_POST['room'] ?? '';
          $price = isset($_POST['price']) ? floatval($_POST['price']) : 0.00;
        }

        $colRes = $conn->query("SHOW COLUMNS FROM reservations LIKE 'price'");
        if ($colRes && $colRes->num_rows == 0) {
          $conn->query("ALTER TABLE reservations ADD COLUMN price DECIMAL(10,2) NOT NULL DEFAULT 0.00");
        }

        $insertStmt = $conn->prepare("INSERT INTO reservations (name, room_number, check_in, check_out, price) VALUES (?, ?, ?, ?, ?)");
        if ($insertStmt) {
          $insertStmt->bind_param('ssssd', $name, $room, $checkin, $checkout, $price);
          $insertStmt->execute();
          $insertStmt->close();
        } else {
          $insertStmt2 = $conn->prepare("INSERT INTO reservations (name, room_number, check_in, check_out) VALUES (?, ?, ?, ?)");
          if ($insertStmt2) {
            $insertStmt2->bind_param('ssss', $name, $room, $checkin, $checkout);
            $insertStmt2->execute();
            $insertStmt2->close();
          }
        }
      }
    }
    ?>

    <div class="card bg-light text-dark mb-4 shadow-sm">
      <div class="card-body">
        <h5 class="card-title fw-bold mb-3"><i class="bi bi-pencil-square me-2"></i>Add a Reservation</h5>
        <form method="POST" class="row g-3">
          <div class="col-md-3">
            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
          </div>
          <div class="col-md-2">
            <?php if (!empty($bedrooms)) { ?>
              <select name="room_id" id="room_id" class="form-select" required>
                <option value="">Select Room</option>
                <?php foreach ($bedrooms as $b) { ?>
                  <option value="<?= $b['id'] ?>" data-price="<?= htmlspecialchars($b['price']) ?>">Room <?= htmlspecialchars($b['room_number']) ?></option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <input type="text" name="room" class="form-control" placeholder="Room #" required>
            <?php } ?>
          </div>
          <div class="col-md-2">
            <input type="text" name="price" id="room_price" class="form-control" placeholder="Price" <?php if (!empty($bedrooms)) echo 'readonly'; ?> >
          </div>
          <div class="col-md-2">
            <input type="date" name="checkin" class="form-control" required>
          </div>
          <div class="col-md-2">
            <input type="date" name="checkout" class="form-control" required>
          </div>
          <div class="col-md-1 d-grid">
            <button type="submit" name="add" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
          </div>
        </form>
      </div>
    </div>

    <?php if (isset($_SESSION['admin_id'])) {
      // Admin-only: list, edit, delete
      if (isset($_GET["delete"])) {
        $id = intval($_GET["delete"]);
        $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
        if ($stmt) {
          $stmt->bind_param('i', $id);
          $stmt->execute();
          $stmt->close();
        }
      }
      $result = $conn->query("SELECT * FROM reservations ORDER BY check_in ASC");
    ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-light text-dark shadow-sm">
        <thead class="table-info text-center">
          <tr>
            <th>Name</th>
            <th>Room</th>
            <th>Price</th>
            <th>Check-In</th>
            <th>Check-Out</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php while($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?= htmlspecialchars($row["name"]) ?></td>
            <td><?= htmlspecialchars($row["room_number"]) ?></td>
            <td><?= isset($row['price']) ? number_format((float)$row['price'], 2) : '-' ?></td>
            <td><?= $row["check_in"] ?></td>
            <td><?= $row["check_out"] ?></td>
            <td>
              <a href="edit.php?id=<?= $row["id"] ?>" class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil-fill"></i></a>
              <a href="?delete=<?= $row["id"] ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Are you sure you want to delete this reservation?')">
                <i class="bi bi-trash-fill"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php } else { ?>
      <div class="card bg-light text-dark mb-4 shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title fw-bold mb-2"><i class="bi bi-lock-fill me-2"></i>Admin Only</h5>
          <p class="mb-0">Reservation records are visible to administrators only.</p>
        </div>
      </div>
    <?php } ?>
  </div>
</section>
<script>
  (function(){
    const roomSelect = document.getElementById('room_id');
    const priceInput = document.getElementById('room_price');
    if (roomSelect && priceInput) {
      function updatePrice(){
        const opt = roomSelect.options[roomSelect.selectedIndex];
        if (opt && opt.dataset && opt.dataset.price) {
          priceInput.value = parseFloat(opt.dataset.price).toFixed(2);
        } else {
          priceInput.value = '';
        }
      }
      roomSelect.addEventListener('change', updatePrice);
      // set initial if preselected
      updatePrice();
    }
  })();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>