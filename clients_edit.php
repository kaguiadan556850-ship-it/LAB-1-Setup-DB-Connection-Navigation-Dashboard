<?php
include "../db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: clients_list.php");
    exit;
}

$id = (int) $_GET['id'];
$get = mysqli_query($conn, "SELECT * FROM clients WHERE client_id = $id");
$client = mysqli_fetch_assoc($get);

if (!$client) {
    header("Location: clients_list.php");
    exit;
}

$message = "";

if (isset($_POST['update'])) {
    $full_name = mysqli_real_escape_string($conn, trim($_POST['full_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $address = mysqli_real_escape_string($conn, trim($_POST['address']));

    if ($full_name === "" || $email === "") {
        $message = "Full name and email address are required.";
    } else {
        $sql = "UPDATE clients
                SET full_name='$full_name', email='$email', phone='$phone', address='$address'
                WHERE client_id=$id";
        mysqli_query($conn, $sql);
        header("Location: clients_list.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Client — Prestige</title>
</head>
<body>
<?php include "../nav.php"; ?>

  <div class="page-header" style="display:flex; align-items:flex-start; justify-content:space-between;">
    <div>
      <h2>Edit Client</h2>
      <p>Updating record for <span style="color:var(--accent);"><?php echo htmlspecialchars($client['full_name']); ?></span></p>
    </div>
    <a href="clients_list.php" class="btn btn-ghost">← Back to Clients</a>
  </div>

  <?php if ($message): ?>
    <div class="alert alert-danger">
      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <?php echo htmlspecialchars($message); ?>
    </div>
  <?php endif; ?>

  <div class="card" style="max-width: 640px;">
    <form method="post">
      <div class="form-row">
        <div class="form-group">
          <label>Full Name <span style="color:var(--danger)">*</span></label>
          <input type="text" name="full_name"
                 value="<?php echo htmlspecialchars(isset($_POST['full_name']) ? $_POST['full_name'] : $client['full_name']); ?>">
        </div>
        <div class="form-group">
          <label>Email Address <span style="color:var(--danger)">*</span></label>
          <input type="email" name="email"
                 value="<?php echo htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : $client['email']); ?>">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Phone Number</label>
          <input type="text" name="phone"
                 value="<?php echo htmlspecialchars(isset($_POST['phone']) ? $_POST['phone'] : $client['phone']); ?>">
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" name="address"
                 value="<?php echo htmlspecialchars(isset($_POST['address']) ? $_POST['address'] : $client['address']); ?>">
        </div>
      </div>

      <div style="display:flex; gap:12px; margin-top:8px;">
        <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
        <a href="clients_list.php" class="btn btn-ghost">Cancel</a>
      </div>
    </form>
  </div>

</div><!-- /.main-wrap -->
</body>
</html>
