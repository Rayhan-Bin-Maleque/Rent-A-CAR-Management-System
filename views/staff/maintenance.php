<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Vehicle Maintenance</h1>
<p>Record maintenance and service history.</p>
</div>
<a class="btn-secondary" href="index.php?page=staff&action=dashboard">Back</a>
</div>

<div class="box">

<h2>Add Maintenance Record</h2>

<form method="POST"
action="index.php?page=staff&action=add_maintenance">

<div class="field">
<label>Vehicle</label>
<select name="car_id" required>
<?php while($car=mysqli_fetch_assoc($cars)): ?>
<option value="<?= $car['id']; ?>">
<?= e($car['brand']." ".$car['model']." - ".$car['plate_number']); ?>
</option>
<?php endwhile; ?>
</select>
</div>

<div class="field">
<label>Maintenance Type</label>
<input name="maintenance_type" placeholder="Oil change / Service / Repair" required>
</div>

<div class="field">
<label>Description</label>
<textarea name="description" required></textarea>
</div>

<div class="field">
<label>Cost</label>
<input type="number" name="cost" min="0" step="0.01" required>
</div>

<button class="btn-primary">Save Maintenance</button>

</form>
</div>

<div class="box">
<h2>Maintenance History</h2>

<div class="table-container">
<table>
<thead>
<tr>
<th>Vehicle</th>
<th>Type</th>
<th>Description</th>
<th>Cost</th>
<th>Staff</th>
<th>Date</th>
</tr>
</thead>
<tbody>
<?php while($row=mysqli_fetch_assoc($maintenance)): ?>
<tr>
<td><?= e($row['brand']." ".$row['model']." - ".$row['plate_number']); ?></td>
<td><?= e($row['maintenance_type']); ?></td>
<td><?= e($row['description']); ?></td>
<td><?= CURRENCY." ".e($row['cost']); ?></td>
<td><?= e($row['staff_name']); ?></td>
<td><?= e($row['maintenance_date']); ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
