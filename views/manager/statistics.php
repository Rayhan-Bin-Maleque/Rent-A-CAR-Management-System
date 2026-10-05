<?php require_once "views/partials/header.php"; ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Rental Statistics</h1>
<p>Quick performance overview of your fleet.</p>
</div>
<a class="btn-secondary" href="index.php?page=manager&action=dashboard">Back</a>
</div>

<div class="stats">
<div class="stat">
<h3><?= mysqli_num_rows($cars); ?></h3>
<p>Total Cars</p>
</div>

<div class="stat">
<h3><?= mysqli_num_rows($bookings); ?></h3>
<p>Total Bookings</p>
</div>

<div class="stat">
<h3><?= count_pending_bookings($conn); ?></h3>
<p>Pending Requests</p>
</div>

<div class="stat">
<h3><?= CURRENCY." ".number_format(booking_revenue($conn),2); ?></h3>
<p>System Revenue</p>
</div>
</div>

<div class="box">
<h2>Vehicle Status Summary</h2>
<?php
$available=0;
$rented=0;
$inactive=0;
while($c=mysqli_fetch_assoc($cars))
{
    if($c['status']==='available') $available++;
    elseif($c['status']==='rented') $rented++;
    else $inactive++;
}
?>
<div class="information">
<div><strong>Available</strong><p><?= $available; ?></p></div>
<div><strong>Rented</strong><p><?= $rented; ?></p></div>
<div><strong>Inactive</strong><p><?= $inactive; ?></p></div>
</div>
</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
