<?php require_once "views/partials/header.php"; ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Rental Receipt</h1>
<p>Your official rental payment receipt.</p>
</div>

<a class="btn-secondary"
href="index.php?page=customer&action=bookings">
Back
</a>
</div>

<div class="box">

<?php if($payment): ?>

<div class="ticket-card">

<div class="receipt-header">
<h2>Rent A CAR</h2>
<h3>RENTAL RECEIPT</h3>
</div>

<div class="receipt-details">

<div>
<strong>Customer</strong>
<p><?= e($booking['customer_name']); ?></p>
</div>

<div>
<strong>Email</strong>
<p><?= e($booking['email']); ?></p>
</div>

<div>
<strong>Vehicle</strong>
<p><?= e($booking['brand']." ".$booking['model']); ?></p>
</div>

<div>
<strong>Plate Number</strong>
<p><?= e($booking['plate_number']); ?></p>
</div>

<div>
<strong>Rental Period</strong>
<p><?= e($booking['pickup_date']); ?> to <?= e($booking['return_date']); ?></p>
</div>

<div>
<strong>Rental Days</strong>
<p><?= e($booking['rental_days']); ?></p>
</div>

<div>
<strong>Amount Paid</strong>
<p><?= CURRENCY." ".e($payment['amount']); ?></p>
</div>

<div>
<strong>Payment Method</strong>
<p><?= e($payment['payment_method']); ?></p>
</div>

<div>
<strong>Transaction ID</strong>
<p><?= e($payment['transaction_id']); ?></p>
</div>

</div>

<div class="receipt-code">
<strong>Receipt Code</strong>
<p><?= e($payment['receipt_code']); ?></p>
</div>

<br>

<button onclick="window.print()" class="btn-primary full-button">
Print Receipt
</button>

</div>

<?php else: ?>

<h2>Payment Not Found</h2>
<p>This booking does not have a completed payment.</p>

<?php endif; ?>

</div>
</div>

<?php require_once "views/partials/footer.php"; ?>
