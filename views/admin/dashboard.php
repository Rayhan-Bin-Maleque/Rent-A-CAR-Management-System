<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Admin Dashboard</h1>
<p>Manage users, vehicles, bookings, payments and system activities.</p>
</div>
</div>

<div class="stats">

<div class="stat">
<h3><?= count_users_by_role($conn,'customer'); ?></h3>
<p>Customers</p>
</div>

<div class="stat">
<h3><?= e($cars); ?></h3>
<p>Total Cars</p>
</div>

<div class="stat">
<h3><?= e($bookings); ?></h3>
<p>Total Bookings</p>
</div>

<div class="stat">
<h3><?= CURRENCY." ".number_format($revenue,2); ?></h3>
<p>Total Revenue</p>
</div>

</div>

<div class="box">
<h2>Admin Services</h2>

<div class="feature-container">
<a class="btn-primary" href="index.php?page=admin&action=users">Manage Users</a>
<a class="btn-primary" href="index.php?page=admin&action=cars">Manage Cars</a>
<a class="btn-primary" href="index.php?page=admin&action=bookings">All Bookings</a>
<a class="btn-primary" href="index.php?page=admin&action=payments">Payments</a>
<a class="btn-primary" href="index.php?page=admin&action=logs">Activity Logs</a>
</div>
</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
