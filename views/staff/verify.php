<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Booking Verification</h1>
<p>Verify a customer using the rental booking code.</p>
</div>
<a class="btn-secondary" href="index.php?page=staff&action=dashboard">Back</a>
</div>

<div class="box">
<h2>Enter Booking Code</h2>

<form method="POST" action="index.php?page=staff&action=verify">
<div class="field">
<label>Booking Code</label>
<input name="booking_code" placeholder="Example: RENT-2026-ABC12345" required>
</div>
<button class="btn-primary">Verify Booking</button>
</form>
</div>

<?php if($booking): ?>

<div class="box">

<h2>Booking Information</h2>

<div class="information">

<div><strong>Customer</strong><p><?= e($booking['customer_name']); ?></p></div>
<div><strong>Email</strong><p><?= e($booking['email']); ?></p></div>
<div><strong>Vehicle</strong><p><?= e($booking['brand']." ".$booking['model']); ?></p></div>
<div><strong>Plate</strong><p><?= e($booking['plate_number']); ?></p></div>
<div><strong>Pickup Date</strong><p><?= e($booking['pickup_date']); ?></p></div>
<div><strong>Return Date</strong><p><?= e($booking['return_date']); ?></p></div>
<div><strong>Status</strong><p><?= e($booking['status']); ?></p></div>
<div><strong>Booking Code</strong><p><?= e($booking['booking_code']); ?></p></div>

</div>

<br>

<?php if($booking['status']==='approved'): ?>
<a class="btn-success full-button"
href="index.php?page=staff&action=pickup&id=<?= $booking['id']; ?>">
Verify Pickup
</a>
<?php elseif($booking['status']==='picked_up'): ?>
<a class="btn-primary full-button"
href="index.php?page=staff&action=return&id=<?= $booking['id']; ?>">
Verify Vehicle Return
</a>
<?php elseif($booking['status']==='returned'): ?>
<p class="status returned">Vehicle already returned.</p>
<?php else: ?>
<p>Booking must be approved before pickup verification.</p>
<?php endif; ?>

</div>

<?php endif; ?>

</div>

<?php require_once "views/partials/footer.php"; ?>
