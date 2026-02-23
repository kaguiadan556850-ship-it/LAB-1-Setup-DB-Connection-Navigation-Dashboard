<?php
include "db.php";

$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM clients"))['c'];
$services = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM services"))['c'];
$bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM bookings"))['c'];
$revenue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS s FROM payments"))['s'];
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard — Prestige</title>
</head>
<body>
<?php include "nav.php"; ?>

  <div class="page-header">
    <h2>Dashboard</h2>
    <p>Welcome back. Here's an overview of your business.</p>
  </div>

  <div class="stat-grid">
    <div class="stat-card">
      <div class="label">Total Clients</div>
      <div class="value"><?php echo number_format($clients); ?></div>
    </div>
    <div class="stat-card">
      <div class="label">Total Services</div>
      <div class="value"><?php echo number_format($services); ?></div>
    </div>
    <div class="stat-card">
      <div class="label">Total Bookings</div>
      <div class="value"><?php echo number_format($bookings); ?></div>
    </div>
    <div class="stat-card">
      <div class="label">Total Revenue</div>
      <div class="value accent">₱<?php echo number_format($revenue, 2); ?></div>
    </div>
  </div>

  <div class="card" style="display:flex; gap:12px; align-items:center; background: linear-gradient(135deg, #1a1a22, #22222d); border-color: rgba(200,169,110,0.2);">
    <div style="flex:1">
      <div style="font-size:13px; color:var(--muted); margin-bottom:4px;">Quick Actions</div>
      <div style="font-size:15px; font-weight:500;">Get started quickly</div>
    </div>
    <a href="/assessment_beginner/pages/clients_add.php" class="btn btn-primary">+ Add Client</a>
    <a href="/assessment_beginner/pages/bookings_create.php" class="btn btn-ghost">+ Create Booking</a>
  </div>

</div>
</body>
</html>

