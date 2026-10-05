<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Booking Requests</h1>
<p>Approve or reject customer rental requests.</p>
</div>
<a class="btn-secondary" href="index.php?page=manager&action=dashboard">Back</a>
</div>

<div class="box">
<div class="table-container">
<table>
<thead>
<tr>
<th>Customer</th>
<th>Vehicle</th>
<th>Booking Code</th>
<th>Pickup</th>
<th>Return</th>
<th>Days</th>
<th>Total</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php while($row=mysqli_fetch_assoc($bookings)): ?>
<tr>
<td><?= e($row['customer_name']); ?></td>
<td><?= e($row['brand']." ".$row['model']); ?></td>
<td><?= e($row['booking_code']); ?></td>
<td><?= e($row['pickup_date']); ?></td>
<td><?= e($row['return_date']); ?></td>
<td><?= e($row['rental_days']); ?></td>
<td><?= CURRENCY." ".e($row['total_amount']); ?></td>
<td><span class="status <?= e($row['status']); ?>"><?= e($row['status']); ?></span></td>
<td>
<?php if($row['status']==='pending'): ?>
<a class="small-btn btn-success" href="index.php?page=manager&action=update_booking&id=<?= $row['id']; ?>&status=approved">Approve</a>
<a class="small-btn btn-danger" href="index.php?page=manager&action=update_booking&id=<?= $row['id']; ?>&status=rejected">Reject</a>
<?php else: ?>
-
<?php endif; ?>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
