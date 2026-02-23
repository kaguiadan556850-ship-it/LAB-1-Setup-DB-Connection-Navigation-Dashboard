
<?php
$current = basename($_SERVER['PHP_SELF']);
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --bg: #0f0f13;
    --surface: #1a1a22;
    --surface2: #22222d;
    --border: #2e2e3d;
    --accent: #c8a96e;
    --accent2: #e8c98e;
    --text: #e8e8f0;
    --muted: #7a7a9a;
    --danger: #e06b6b;
    --success: #6bcb8b;
    --sidebar-w: 240px;
  }

  body {
    background: var(--bg);
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    min-height: 100vh;
    display: flex;
  }

  
  .sidebar {
    width: var(--sidebar-w);
    min-height: 100vh;
    background: var(--surface);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0;
    z-index: 100;
  }

  .sidebar-logo {
    padding: 28px 24px 20px;
    border-bottom: 1px solid var(--border);
  }

  .sidebar-logo span {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    color: var(--accent);
    letter-spacing: 0.5px;
    display: block;
  }

  .sidebar-logo small {
    color: var(--muted);
    font-size: 11px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
  }

  .nav-section {
    padding: 16px 12px 8px;
    font-size: 10px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--muted);
    padding-left: 16px;
  }

  .sidebar nav a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 16px;
    color: var(--muted);
    text-decoration: none;
    border-radius: 8px;
    margin: 2px 8px;
    font-size: 14px;
    font-weight: 400;
    transition: all 0.2s;
  }

  .sidebar nav a:hover, .sidebar nav a.active {
    background: var(--surface2);
    color: var(--text);
  }

  .sidebar nav a.active {
    color: var(--accent);
    font-weight: 500;
  }

  .sidebar nav a svg {
    width: 16px; height: 16px;
    flex-shrink: 0;
    opacity: 0.7;
  }

  .sidebar nav a.active svg, .sidebar nav a:hover svg {
    opacity: 1;
  }

  
  .main-wrap {
    margin-left: var(--sidebar-w);
    flex: 1;
    min-height: 100vh;
    padding: 40px 48px;
    max-width: calc(100vw - var(--sidebar-w));
  }

  
  .page-header { margin-bottom: 32px; }
  .page-header h2 {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 600;
    color: var(--text);
  }
  .page-header p { color: var(--muted); margin-top: 4px; font-size: 13px; }

  
  .card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 28px 32px;
  }

  
  .stat-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 32px; }
  .stat-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 24px;
  }
  .stat-card .label { font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); }
  .stat-card .value { font-size: 32px; font-weight: 600; margin-top: 8px; color: var(--text); }
  .stat-card .value.accent { color: var(--accent); }

  
  .table-wrap { overflow-x: auto; }
  table { width: 100%; border-collapse: collapse; }
  thead th {
    text-align: left;
    padding: 12px 16px;
    font-size: 11px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--muted);
    border-bottom: 1px solid var(--border);
  }
  tbody tr { transition: background 0.15s; }
  tbody tr:hover { background: var(--surface2); }
  tbody td {
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    color: var(--text);
    font-size: 14px;
  }
  tbody tr:last-child td { border-bottom: none; }

  
  .btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 20px;
    border-radius: 8px;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    border: none;
    transition: all 0.2s;
    text-decoration: none;
  }
  .btn-primary { background: var(--accent); color: #1a1200; }
  .btn-primary:hover { background: var(--accent2); }
  .btn-ghost { background: transparent; color: var(--muted); border: 1px solid var(--border); }
  .btn-ghost:hover { border-color: var(--accent); color: var(--accent); }
  .btn-sm { padding: 6px 14px; font-size: 13px; }

  
  .form-group { margin-bottom: 20px; }
  .form-group label {
    display: block;
    font-size: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 8px;
    font-weight: 500;
  }
  .form-group input, .form-group select, .form-group textarea {
    width: 100%;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 11px 14px;
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    outline: none;
    transition: border-color 0.2s;
  }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
    border-color: var(--accent);
  }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

  
  .alert {
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 14px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .alert-danger { background: rgba(224,107,107,0.12); border: 1px solid rgba(224,107,107,0.3); color: var(--danger); }

  
  .badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
  }
  .badge-gold { background: rgba(200,169,110,0.15); color: var(--accent); }
</style>

<div class="sidebar">
  <div class="sidebar-logo">
    <span>Prestige</span>
    <small>Admin Panel</small>
  </div>
  <div class="nav-section">Main</div>
  <nav>
    <a href="/assessment_beginner/index.php" class="<?= ($current=='index.php')?'active':'' ?>">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Dashboard
    </a>
    <a href="/assessment_beginner/pages/clients_list.php" class="<?= (in_array($current,['clients_list.php','clients_add.php','clients_edit.php']))?'active':'' ?>">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
      Clients
    </a>
    <a href="/assessment_beginner/pages/services_list.php">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
      Services
    </a>
    <a href="/assessment_beginner/pages/bookings_list.php">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
      Bookings
    </a>
    <a href="/assessment_beginner/pages/payments_list.php">
      <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="1" y="4" width="22" height="16" rx="2"/><path d="M1 10h22"/></svg>
      Payments
    </a>
  </nav>
</div>

<div class="main-wrap">
