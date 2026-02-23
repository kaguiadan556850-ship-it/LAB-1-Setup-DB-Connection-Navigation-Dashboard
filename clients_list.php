<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM clients ORDER BY client_id DESC");
$total = mysqli_num_rows($result);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clients — Prestige</title>
</head>
<body>
<?php include "../nav.php"; ?>

  <div class="page-header" style="display:flex; align-items:flex-start; justify-content:space-between;">
    <div>
      <h2>Clients</h2>
      <p><?php echo number_format($total); ?> client<?php echo $total !== 1 ? 's' : ''; ?> registered</p>
    </div>
    <a href="clients_add.php" class="btn btn-primary">+ Add Client</a>
  </div>

  <div class="card" style="padding: 0; overflow:hidden;">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($total === 0): ?>
            <tr>
              <td colspan="6" style="text-align:center; padding:40px; color:var(--muted);">
                No clients found. <a href="clients_add.php" style="color:var(--accent);">Add the first one →</a>
              </td>
            </tr>
          <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td style="color:var(--muted); font-size:13px;"><?php echo $row['client_id']; ?></td>
                <td style="font-weight:500;"><?php echo htmlspecialchars($row['full_name']); ?></td>
                <td style="color:var(--muted);"><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone'] ?: '—'); ?></td>
                <td style="color:var(--muted); max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                  <?php echo htmlspecialchars($row['address'] ?: '—'); ?>
                </td>
                <td>
                  <a href="clients_edit.php?id=<?php echo $row['client_id']; ?>" class="btn btn-ghost btn-sm">Edit</a>
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

