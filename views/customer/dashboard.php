<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Customer Dashboard</h1>
<p>Find a car, make a booking and manage your rentals.</p>
</div>
</div>

<div class="stats">

<div class="stat">
<h3><?= mysqli_num_rows($cars); ?></h3>
<p>Available Cars</p>
</div>

<div class="stat">
<h3><?= mysqli_num_rows($bookings); ?></h3>
<p>My Bookings</p>
</div>

<div class="stat">
<h3><?= mysqli_num_rows($payments); ?></h3>
<p>My Payments</p>
</div>

<div class="stat">
<h3><?= count_customer_bookings($conn,$_SESSION['user']['id']); ?></h3>
<p>Total Rentals</p>
</div>

</div>

<div class="box">

<h2>Available Cars</h2>

<div class="search-box">
<input type="text"
id="carSearch"
placeholder="Search brand, model, type or plate number...">
</div>

<div class="table-container">
<table>
<thead>
<tr>
<th>Vehicle</th>
<th>Type</th>
<th>Year</th>
<th>Seats</th>
<th>Daily Rate</th>
<th>Status</th>
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
<td><?= CURRENCY." ".e($car['daily_rate']); ?></td>
<td><span class="status available">Available</span></td>
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

<div class="box">
<h2>Customer Services</h2>
<div class="feature-container">
<a class="btn-primary" href="index.php?page=customer&action=cars">Browse Cars</a>
<a class="btn-primary" href="index.php?page=customer&action=bookings">My Bookings</a>
</div>
</div>

</div>

<script>
document.addEventListener("DOMContentLoaded",function(){
    ajaxSearch("carSearch","search_cars","carTable");
});
</script>

<?php require_once "views/partials/footer.php"; ?>
