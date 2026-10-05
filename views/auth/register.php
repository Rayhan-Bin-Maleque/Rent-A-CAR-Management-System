<?php require_once "views/partials/header.php"; ?>

<div class="dashboard">
<div class="login-box">

<div class="box">

<h2 class="login-title">Customer Registration</h2>

<?php show_message(); ?>

<form method="POST"
action="index.php?page=auth&action=register">

<div class="field">
<label>Full Name</label>
<input type="text" name="full_name" required>
</div>

<div class="field">
<label>Email</label>
<input type="email" name="email" required>
</div>

<div class="field">
<label>Phone</label>
<input type="text" name="phone" required>
</div>

<div class="field">
<label>Password</label>
<input type="password" name="password" required minlength="6">
</div>

<button class="btn-primary full-button">
Create Account
</button>

</form>

<p style="text-align:center;margin-top:20px;">
Already have an account?
<a href="index.php?page=auth&action=login"
style="color:#16345c;font-weight:bold;">
Login
</a>
</p>

</div>

</div>
</div>

<?php require_once "views/partials/footer.php"; ?>
