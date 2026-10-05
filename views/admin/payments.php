<?php require_once "views/partials/header.php"; ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Payment Records</h1>
<p>View all completed rental payments.</p>
</div>
<a class="btn-secondary" href="index.php?page=admin&action=dashboard">Back</a>
</div>

<div class="box">
<div class="table-container">
<table>
<thead>
<tr>
<th>Customer</th>
<th>Booking</th>
<th>Vehicle</th>
<th>Amount</th>
<th>Method</th>
<th>Transaction</th>
<th>Status</th>
<th>Date</th>
</tr>
</thead>
<tbody>
<?php while($row=mysqli_fetch_assoc($payments)): ?>
<tr>
<td><?= e($row['customer_name']); ?></td>
<td><?= e($row['booking_code']); ?></td>
<td><?= e($row['brand']." ".$row['model']); ?></td>
<td><?= CURRENCY." ".e($row['amount']); ?></td>
<td><?= e($row['payment_method']); ?></td>
<td><?= e($row['transaction_id']); ?></td>
<td><span class="status <?= e($row['payment_status']); ?>"><?= e($row['payment_status']); ?></span></td>
<td><?= e($row['payment_date']); ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>

<?php require_once "views/partials/footer.php"; ?>
