<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>User Management</h1>
<p>Create, view and control system users.</p>
</div>
<a class="btn-primary" href="index.php?page=admin&action=add_user">Add User</a>
</div>

<div class="box">
<div class="table-container">
<table>
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Role</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php while($user=mysqli_fetch_assoc($users)): ?>
<tr>
<td><?= e($user['full_name']); ?></td>
<td><?= e($user['email']); ?></td>
<td><?= e($user['phone']); ?></td>
<td><?= e($user['role']); ?></td>
<td><span class="status <?= e($user['status']); ?>"><?= e($user['status']); ?></span></td>
<td>
<a class="small-btn btn-warning"
href="index.php?page=admin&action=toggle_user&id=<?= $user['id']; ?>">
Toggle Status
</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</div>

</div>

<?php require_once "views/partials/footer.php"; ?>
