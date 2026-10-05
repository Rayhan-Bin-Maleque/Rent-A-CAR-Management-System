<?php require_once "views/partials/header.php"; ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>All Bookings</h1>
<p>System-wide rental booking history.</p>
</div>
<a class="btn-secondary" href="index.php?page=admin&action=dashboard">Back</a>
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
<th>Total</th>
<th>Status</th>
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
<td><?= CURRENCY." ".e($row['total_amount']); ?></td>
<td><span class="status <?= e($row['status']); ?>"><?= e($row['status']); ?></span></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>

<?php require_once "views/partials/footer.php"; ?>
