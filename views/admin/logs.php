<?php require_once "views/partials/header.php"; ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Activity Logs</h1>
<p>Monitor user activities and system actions.</p>
</div>
<a class="btn-secondary" href="index.php?page=admin&action=dashboard">Back</a>
</div>

<div class="box">
<div class="search-box">
<input type="text" id="logSearch" placeholder="Search user, role, action or IP...">
</div>

<div class="table-container">
<table>
<thead>
<tr>
<th>User</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
<th>IP Address</th>
<th>Date</th>
</tr>
</thead>
<tbody id="logTable">
<?php while($row=mysqli_fetch_assoc($logs)): ?>
<tr>
<td><?= e($row['full_name']); ?></td>
<td><?= e($row['email']); ?></td>
<td><?= e($row['role']); ?></td>
<td><?= e($row['action']); ?></td>
<td><?= e($row['ip_address']); ?></td>
<td><?= e($row['created_at']); ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>
</div>

<script>
document.addEventListener("DOMContentLoaded",function(){
    ajaxSearch("logSearch","search_logs","logTable");
});
</script>

<?php require_once "views/partials/footer.php"; ?>
