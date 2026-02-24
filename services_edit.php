<?php
include "../db.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: services_list.php");
    exit;
}

$id = (int) $_GET['id'];
$get = mysqli_query($conn, "SELECT * FROM services WHERE service_id = $id");
$service = mysqli_fetch_assoc($get);

if (!$service) {
    header("Location: services_list.php");
    exit;
}

$message = "";

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, trim($_POST['service_name']));
    $desc = mysqli_real_escape_string($conn, trim($_POST['description']));
    $rate = mysqli_real_escape_string($conn, trim($_POST['hourly_rate']));
    $active = (int) $_POST['is_active'];

    if ($name === "") {
        $message = "Service name is required.";
    } elseif (!is_numeric($rate) || $rate < 0) {
        $message = "Please enter a valid hourly rate.";
    } else {
        mysqli_query($conn, "UPDATE services
            SET service_name='$name', description='$desc', hourly_rate='$rate', is_active='$active'
            WHERE service_id=$id");
        header("Location: services_list.php");
        exit;
    }
}

// Use POST values on validation error, otherwise use DB values
$val = function($field) use ($service) {
    return htmlspecialchars(isset($_POST[$field]) ? $_POST[$field] : $service[$field]);
};
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Service — Prestige</title>
</head>
<body>
<?php include "../nav.php"; ?>

  <div class="page-header" style="display:flex; align-items:flex-start; justify-content:space-between;">
    <div>
      <h2>Edit Service</h2>
      <p>Updating — <span style="color:var(--accent);"><?php echo htmlspecialchars($service['service_name']); ?></span></p>
    </div>
    <a href="services_list.php" class="btn btn-ghost">← Back to Services</a>
  </div>

  <?php if ($message): ?>
    <div class="alert alert-danger">
      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
      </svg>
      <?php echo htmlspecialchars($message); ?>
    </div>
  <?php endif; ?>

  <div class="card" style="max-width:640px;">
    <form method="post">

      <div class="form-group">
        <label>Service Name <span style="color:var(--danger)">*</span></label>
        <input type="text" name="service_name" placeholder="e.g. Deep Tissue Massage"
               value="<?php echo $val('service_name'); ?>">
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="description" rows="4" placeholder="Brief description of the service..."
                  style="resize:vertical;"><?php echo $val('description'); ?></textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Hourly Rate (₱) <span style="color:var(--danger)">*</span></label>
          <input type="number" name="hourly_rate" step="0.01" min="0" placeholder="0.00"
                 value="<?php echo $val('hourly_rate'); ?>">
        </div>
        <div class="form-group">
          <label>Status</label>
          <select name="is_active">
            <option value="1" <?php if ((isset($_POST['is_active']) ? $_POST['is_active'] : $service['is_active']) == 1) echo 'selected'; ?>>Active</option>
            <option value="0" <?php if ((isset($_POST['is_active']) ? $_POST['is_active'] : $service['is_active']) == 0) echo 'selected'; ?>>Inactive</option>
          </select>
        </div>
      </div>

      <div style="display:flex; gap:12px; margin-top:8px;">
        <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
        <a href="services_list.php" class="btn btn-ghost">Cancel</a>
      </div>

    </form>
  </div>

</div><!-- /.main-wrap -->
</body>
</html>
