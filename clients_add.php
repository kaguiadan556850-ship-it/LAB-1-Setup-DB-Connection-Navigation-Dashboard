<?php
include "../db.php";

$message = "";

if (isset($_POST['save'])) {
    $full_name = mysqli_real_escape_string($conn, trim($_POST['full_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $address = mysqli_real_escape_string($conn, trim($_POST['address']));

    if ($full_name === "" || $email === "") {
        $message = "Full name and email address are required.";
    } else {
        $sql = "INSERT INTO clients (full_name, email, phone, address)
                VALUES ('$full_name', '$email', '$phone', '$address')";
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
  <title>Add Client — Prestige</title>
</head>
<body>
<?php include "../nav.php"; ?>

  <div class="page-header">
    <h2>Add Client</h2>
    <p>Fill in the details to register a new client.</p>
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
          <input type="text" name="full_name" placeholder="e.g. Maria Santos"
                 value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>">
        </div>
        <div class="form-group">
          <label>Email Address <span style="color:var(--danger)">*</span></label>
          <input type="email" name="email" placeholder="e.g. maria@example.com"
                 value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Phone Number</label>
          <input type="text" name="phone" placeholder="e.g. 09XX-XXX-XXXX"
                 value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" name="address" placeholder="Street, City"
                 value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
        </div>
      </div>

      <div style="display:flex; gap:12px; margin-top:8px;">
        <button type="submit" name="save" class="btn btn-primary">Save Client</button>
        <a href="clients_list.php" class="btn btn-ghost">Cancel</a>
      </div>
    </form>
  </div>

</div><!-- /.main-wrap -->
</body>
</html>
