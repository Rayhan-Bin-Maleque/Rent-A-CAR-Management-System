<?php require_once "views/partials/header.php"; ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Rental Operations</h1>
<p>View current and previous rental bookings.</p>
</div>
<a class="btn-secondary" href="index.php?page=staff&action=dashboard">Back</a>
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
<th>Status</th>
<th>Pickup Verified</th>
<th>Return Verified</th>
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
<td><span class="status <?= e($row['status']); ?>"><?= e($row['status']); ?></span></td>
<td><?= $row['pickup_verified'] ? 'Yes' : 'No'; ?></td>
<td><?= $row['return_verified'] ? 'Yes' : 'No'; ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>

<?php require_once "views/partials/footer.php"; ?>
