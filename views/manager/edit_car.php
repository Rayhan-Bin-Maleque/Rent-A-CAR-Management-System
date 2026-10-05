<?php require_once "views/partials/header.php"; ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Edit Car</h1>
<p>Update vehicle information.</p>
</div>
<a class="btn-secondary" href="index.php?page=manager&action=cars">Back</a>
</div>

<div class="box">

<form method="POST">

<div class="information">

<div class="field">
<label>Brand</label>
<input name="brand" value="<?= e($car['brand']); ?>" required>
</div>

<div class="field">
<label>Model</label>
<input name="model" value="<?= e($car['model']); ?>" required>
</div>

<div class="field">
<label>Year</label>
<input type="number" name="car_year" value="<?= e($car['car_year']); ?>" required>
</div>

<div class="field">
<label>Plate Number</label>
<input name="plate_number" value="<?= e($car['plate_number']); ?>" required>
</div>

<div class="field">
<label>Car Type</label>
<select name="car_type">
<?php foreach(['Sedan','SUV','Hatchback','Microbus','Luxury'] as $type): ?>
<option value="<?= e($type); ?>" <?= $car['car_type']==$type?'selected':''; ?>>
<?= e($type); ?>
</option>
<?php endforeach; ?>
</select>
</div>

<div class="field">
<label>Seats</label>
<input type="number" name="seats" value="<?= e($car['seats']); ?>" required>
</div>

<div class="field">
<label>Daily Rate</label>
<input type="number" name="daily_rate" step="0.01" value="<?= e($car['daily_rate']); ?>" required>
</div>

</div>

<div class="field">
<label>Description</label>
<textarea name="description"><?= e($car['description']); ?></textarea>
</div>

<button class="btn-primary">Update Car</button>

</form>

</div>
</div>

<?php require_once "views/partials/footer.php"; ?>
