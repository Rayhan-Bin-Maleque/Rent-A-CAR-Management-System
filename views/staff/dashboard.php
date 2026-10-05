<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Staff Dashboard</h1>
<p>Handle vehicle pickup, return and maintenance operations.</p>
</div>
</div>

<div class="stats">

<div class="stat">
<h3><?= mysqli_num_rows($bookings); ?></h3>
<p>Total Bookings</p>
</div>

<div class="stat">
<h3><?= mysqli_num_rows($maintenance); ?></h3>
<p>Maintenance Records</p>
</div>

<div class="stat">
<h3><?= count_available_cars($conn); ?></h3>
<p>Available Cars</p>
</div>

<div class="stat">
<h3><?= mysqli_num_rows($bookings); ?></h3>
<p>Rental Operations</p>
</div>

</div>

<div class="box">
<h2>Staff Services</h2>
<div class="feature-container">
<a class="btn-primary" href="index.php?page=staff&action=verify">Verify Pickup / Return</a>
<a class="btn-primary" href="index.php?page=staff&action=maintenance">Maintenance</a>
<a class="btn-primary" href="index.php?page=staff&action=bookings">Bookings</a>
<a class="btn-primary" href="index.php?page=staff&action=payments">Payments</a>
</div>
</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
