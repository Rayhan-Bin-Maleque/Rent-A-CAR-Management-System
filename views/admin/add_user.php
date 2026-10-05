<?php require_once "views/partials/header.php"; show_message(); ?>

<div class="dashboard">

<div class="topbar">
<div>
<h1>Add User</h1>
<p>Create an admin, manager, staff or customer account.</p>
</div>

<a class="btn-secondary" href="index.php?page=admin&action=users">Back</a>
</div>

<div class="box">

<form method="POST"
action="index.php?page=admin&action=add_user">

<div class="field">
<label>Full Name</label>
<input name="full_name" required>
</div>

<div class="field">
<label>Email</label>
<input type="email" name="email" required>
</div>

<div class="field">
<label>Phone</label>
<input name="phone">
</div>

<div class="field">
<label>Password</label>
<input type="password" name="password" required>
</div>

<div class="field">
<label>Role</label>
<select name="role" required>
<option value="customer">Customer</option>
<option value="manager">Manager</option>
<option value="staff">Staff</option>
<option value="admin">Admin</option>
</select>
</div>

<button class="btn-primary">Create User</button>

</form>

</div>
</div>

<?php require_once "views/partials/footer.php"; ?>
