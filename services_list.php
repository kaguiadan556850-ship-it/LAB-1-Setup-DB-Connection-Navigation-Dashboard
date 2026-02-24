<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
$total = mysqli_num_rows($result);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Services — Prestige</title>
</head>
<body>
<?php include "../nav.php"; ?>

  <div class="page-header" style="display:flex; align-items:flex-start; justify-content:space-between;">
    <div>
      <h2>Services</h2>
      <p><?php echo number_format($total); ?> service<?php echo $total !== 1 ? 's' : ''; ?> available</p>
    </div>
    <a href="services_add.php" class="btn btn-primary">+ Add Service</a>
  </div>

  <div class="card" style="padding:0; overflow:hidden;">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Service Name</th>
            <th>Description</th>
            <th>Hourly Rate</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($total === 0): ?>
            <tr>
              <td colspan="6" style="text-align:center; padding:40px; color:var(--muted);">
                No services found. <a href="services_add.php" style="color:var(--accent);">Add the first one →</a>
              </td>
            </tr>
          <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td style="color:var(--muted); font-size:13px;"><?php echo $row['service_id']; ?></td>
                <td style="font-weight:500;"><?php echo htmlspecialchars($row['service_name']); ?></td>
                <td style="color:var(--muted); max-width:260px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                  <?php echo htmlspecialchars($row['description'] ?: '—'); ?>
                </td>
                <td style="color:var(--accent); font-weight:500;">
                  ₱<?php echo number_format($row['hourly_rate'], 2); ?>
                </td>
                <td>
                  <?php if ($row['is_active']): ?>
                    <span class="badge" style="background:rgba(107,203,139,0.12); color:#6bcb8b;">Active</span>
                  <?php else: ?>
                    <span class="badge" style="background:rgba(122,122,154,0.12); color:var(--muted);">Inactive</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="services_edit.php?id=<?php echo $row['service_id']; ?>" class="btn btn-ghost btn-sm">Edit</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div><!-- /.main-wrap -->
</body>
</html>