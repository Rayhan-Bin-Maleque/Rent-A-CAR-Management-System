<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Rental Payment</h1>
<p>Complete payment for your approved booking.</p>
</div>
<a class="btn-secondary" href="index.php?page=customer&action=bookings">Back</a>
</div>

<div class="box">

<h2>Payment Details</h2>

<div class="information">

<div>
<strong>Booking Code</strong>
<p><?= e($booking['booking_code']); ?></p>
</div>

<div>
<strong>Vehicle</strong>
<p><?= e($booking['brand']." ".$booking['model']); ?></p>
</div>

<div>
<strong>Rental Days</strong>
<p><?= e($booking['rental_days']); ?></p>
</div>

<div>
<strong>Total Amount</strong>
<p><?= CURRENCY." ".e($booking['total_amount']); ?></p>
</div>

</div>

<hr style="margin:25px 0;">

<form method="POST"
action="index.php?page=customer&action=payment&booking_id=<?= $booking['id']; ?>"
onsubmit="return confirmPayment();">

<div class="field">
<label>Payment Method</label>

<label>
<input type="radio" name="payment_method"
value="online" required>
Online Payment
</label>

<label>
<input type="radio" name="payment_method"
value="offline">
Offline Payment
</label>
</div>

<div class="field">
<label>Transaction ID</label>
<input type="text" name="transaction_id"
placeholder="Required for online payment">
</div>

<button class="btn-primary full-button">
Complete Payment
</button>

</form>

</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
