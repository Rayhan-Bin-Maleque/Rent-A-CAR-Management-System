<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Add New Car</h1>
<p>Add a vehicle to the rental fleet.</p>
</div>
<a class="btn-secondary" href="index.php?page=manager&action=cars">Back</a>
</div>

<div class="box">

<form method="POST" action="index.php?page=manager&action=add_car">

<div class="information">

<div class="field">
<label>Brand</label>
<input name="brand" placeholder="Toyota" required>
</div>

<div class="field">
<label>Model</label>
<input name="model" placeholder="Axio" required>
</div>

<div class="field">
<label>Year</label>
<input type="number" name="car_year" min="1990" max="2100" required>
</div>

<div class="field">
<label>Plate Number</label>
<input name="plate_number" placeholder="DHAKA-METRO-12-1234" required>
</div>

<div class="field">
<label>Car Type</label>
<select name="car_type" required>
<option value="Sedan">Sedan</option>
<option value="SUV">SUV</option>
<option value="Hatchback">Hatchback</option>
<option value="Microbus">Microbus</option>
<option value="Luxury">Luxury</option>
</select>
</div>

<div class="field">
<label>Seats</label>
<input type="number" name="seats" min="2" max="20" required>
</div>

<div class="field">
<label>Daily Rate</label>
<input type="number" name="daily_rate" min="0" step="0.01" required>
</div>

</div>

<div class="field">
<label>Description</label>
<textarea name="description" placeholder="Vehicle details"></textarea>
</div>

<button class="btn-primary">Add Car</button>

</form>

</div>
</div>

<?php require_once "views/partials/footer.php"; ?>
