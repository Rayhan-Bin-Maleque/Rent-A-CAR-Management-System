<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Manager Dashboard</h1>
<p>Manage vehicles, bookings and rental operations.</p>
</div>
</div>

<div class="stats">

<div class="stat">
<h3><?= mysqli_num_rows($cars); ?></h3>
<p>Total Cars</p>
</div>

<div class="stat">
<h3><?= mysqli_num_rows($bookings); ?></h3>
<p>My Car Bookings</p>
</div>

<div class="stat">
<h3><?= e($pending); ?></h3>
<p>Pending Requests</p>
</div>

<div class="stat">
<h3><?= CURRENCY." ".number_format($revenue,2); ?></h3>
<p>Rental Revenue</p>
</div>

</div>

<div class="box">
<h2>Manager Services</h2>
<div class="feature-container">
<a class="btn-primary" href="index.php?page=manager&action=cars">Manage Cars</a>
<a class="btn-primary" href="index.php?page=manager&action=add_car">Add Car</a>
<a class="btn-primary" href="index.php?page=manager&action=bookings">Manage Bookings</a>
<a class="btn-primary" href="index.php?page=manager&action=finance">Finance</a>
<a class="btn-primary" href="index.php?page=manager&action=statistics">Statistics</a>
</div>
</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
