<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>My Bookings</h1>
<p>Manage your rental bookings, payments and receipts.</p>
</div>
<a class="btn-secondary" href="index.php?page=customer&action=dashboard">Back</a>
</div>

<div class="box">

<div class="table-container">
<table>
<thead>
<tr>
<th>Vehicle</th>
<th>Booking Code</th>
<th>Pickup</th>
<th>Return</th>
<th>Days</th>
<th>Total</th>
<th>Status</th>
<th>Payment</th>
<th>Receipt</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php if(mysqli_num_rows($bookings)>0): ?>

<?php while($row=mysqli_fetch_assoc($bookings)): ?>

<?php $payment=get_booking_payment($conn,$row['id']); ?>

<tr>

<td><?= e($row['brand']." ".$row['model']); ?></td>
<td><?= e($row['booking_code']); ?></td>
<td><?= e($row['pickup_date']); ?></td>
<td><?= e($row['return_date']); ?></td>
<td><?= e($row['rental_days']); ?></td>
<td><?= CURRENCY." ".e($row['total_amount']); ?></td>

<td>
<span class="status <?= e($row['status']); ?>">
<?= e($row['status']); ?>
</span>
</td>

<td>
<?php if($payment): ?>
<span class="status paid">Paid</span>
<?php elseif(in_array($row['status'],['approved','picked_up','returned'],true)): ?>
<a class="small-btn btn-primary"
href="index.php?page=customer&action=payment&booking_id=<?= $row['id']; ?>">
Pay Now
</a>
<?php else: ?>
Pending
<?php endif; ?>
</td>

<td>
<?php if($payment): ?>
<a class="small-btn btn-success"
href="index.php?page=customer&action=receipt&booking_id=<?= $row['id']; ?>">
View
</a>
<?php else: ?>-<?php endif; ?>
</td>

<td>
<?php if(in_array($row['status'],['pending','approved'],true)): ?>
<a class="small-btn btn-danger"
onclick="return confirmAction('Cancel this booking?')"
href="index.php?page=customer&action=cancel&id=<?= $row['id']; ?>">
Cancel
</a>
<?php else: ?>-<?php endif; ?>
</td>

</tr>

<?php endwhile; ?>

<?php else: ?>

<tr>
<td colspan="10">No bookings found.</td>
</tr>

<?php endif; ?>

</tbody>
</table>
</div>

</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
