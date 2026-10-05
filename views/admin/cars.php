<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Car Inventory</h1>
<p>All vehicles registered in the rental system.</p>
</div>
<a class="btn-secondary" href="index.php?page=admin&action=dashboard">Back</a>
</div>

<div class="box">
<div class="table-container">
<table>
<thead>
<tr>
<th>Vehicle</th>
<th>Type</th>
<th>Plate</th>
<th>Seats</th>
<th>Daily Rate</th>
<th>Status</th>
<th>Maintenance</th>
</tr>
</thead>
<tbody>
<?php while($car=mysqli_fetch_assoc($cars)): ?>
<tr>
<td><?= e($car['brand']." ".$car['model']); ?></td>
<td><?= e($car['car_type']); ?></td>
<td><?= e($car['plate_number']); ?></td>
<td><?= e($car['seats']); ?></td>
<td><?= CURRENCY." ".e($car['daily_rate']); ?></td>
<td><span class="status <?= e($car['status']); ?>"><?= e($car['status']); ?></span></td>
<td><?= e($car['maintenance_status']); ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
