<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Rent This Car</h1>
<p>Choose your rental dates and pickup location.</p>
</div>
<a class="btn-secondary" href="index.php?page=customer&action=cars">Back</a>
</div>

<div class="box">

<div class="information">

<div>
<strong>Vehicle</strong>
<p><?= e($car['brand']." ".$car['model']); ?></p>
</div>

<div>
<strong>Type</strong>
<p><?= e($car['car_type']); ?></p>
</div>

<div>
<strong>Seats</strong>
<p><?= e($car['seats']); ?></p>
</div>

<div>
<strong>Daily Rate</strong>
<p><?= CURRENCY." ".e($car['daily_rate']); ?></p>
</div>

</div>

<hr style="margin:25px 0;">

<form method="POST"
action="index.php?page=customer&action=book&car_id=<?= $car['id']; ?>">

<input type="hidden" name="car_id" value="<?= $car['id']; ?>">

<div class="field">
<label>Pickup Date</label>
<input type="date" name="pickup_date"
min="<?= date('Y-m-d'); ?>" required>
</div>

<div class="field">
<label>Return Date</label>
<input type="date" name="return_date"
min="<?= date('Y-m-d'); ?>" required>
</div>

<div class="field">
<label>Pickup Location</label>
<input name="pickup_location"
placeholder="Example: Dhaka Office / Airport" required>
</div>

<button class="btn-primary full-button">
Submit Booking Request
</button>

</form>

</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
