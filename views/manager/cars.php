<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>My Car Fleet</h1>
<p>Add, edit and control rental vehicles.</p>
</div>
<a class="btn-primary" href="index.php?page=manager&action=add_car">Add Car</a>
</div>

<div class="box">
<div class="table-container">
<table>
<thead>
<tr>
<th>Vehicle</th>
<th>Year</th>
<th>Plate</th>
<th>Type</th>
<th>Seats</th>
<th>Daily Rate</th>
<th>Status</th>
<th>Maintenance</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php while($car=mysqli_fetch_assoc($cars)): ?>
<tr>
<td><?= e($car['brand']." ".$car['model']); ?></td>
<td><?= e($car['car_year']); ?></td>
<td><?= e($car['plate_number']); ?></td>
<td><?= e($car['car_type']); ?></td>
<td><?= e($car['seats']); ?></td>
<td><?= CURRENCY." ".e($car['daily_rate']); ?></td>
<td><span class="status <?= e($car['status']); ?>"><?= e($car['status']); ?></span></td>
<td><span class="status <?= e($car['maintenance_status']); ?>"><?= e($car['maintenance_status']); ?></span></td>
<td>
<a class="small-btn btn-primary" href="index.php?page=manager&action=edit_car&id=<?= $car['id']; ?>">Edit</a>
<a class="small-btn btn-warning" href="index.php?page=manager&action=car_status&id=<?= $car['id']; ?>&status=available">Available</a>
<a class="small-btn btn-danger" href="index.php?page=manager&action=car_status&id=<?= $car['id']; ?>&status=inactive">Inactive</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
