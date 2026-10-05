<?php require_once "views/partials/header.php"; ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Available Cars</h1>
<p>Choose a vehicle for your next rental.</p>
</div>
<a class="btn-secondary" href="index.php?page=customer&action=dashboard">Back</a>
</div>

<div class="box">

<div class="search-box">
<input type="text" id="carSearch"
placeholder="Search car...">
</div>

<div class="table-container">
<table>
<thead>
<tr>
<th>Vehicle</th>
<th>Type</th>
<th>Year</th>
<th>Seats</th>
<th>Plate</th>
<th>Daily Rate</th>
<th>Action</th>
</tr>
</thead>

<tbody id="carTable">
<?php while($car=mysqli_fetch_assoc($cars)): ?>
<tr>
<td><?= e($car['brand']." ".$car['model']); ?></td>
<td><?= e($car['car_type']); ?></td>
<td><?= e($car['car_year']); ?></td>
<td><?= e($car['seats']); ?></td>
<td><?= e($car['plate_number']); ?></td>
<td><?= CURRENCY." ".e($car['daily_rate']); ?></td>
<td>
<a class="small-btn btn-primary"
href="index.php?page=customer&action=book&car_id=<?= $car['id']; ?>">
Book
</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>

</div>

<script>
document.addEventListener("DOMContentLoaded",function(){
    ajaxSearch("carSearch","search_cars","carTable");
});
</script>

<?php require_once "views/partials/footer.php"; ?>
