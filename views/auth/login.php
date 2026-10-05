<?php require_once "views/partials/header.php"; ?>

<div class="dashboard">
<div class="login-box">

<div class="box">

<h1 class="login-title">Rent A CAR</h1>
<p style="text-align:center;margin-bottom:25px;">
Login to manage your rental activities
</p>

<?php show_message(); ?>

<form method="POST"
action="index.php?page=auth&action=login">

<div class="field">
<label>Email</label>
<input type="email" name="email"
placeholder="Enter email" required>
</div>

<div class="field">
<label>Password</label>
<input type="password" name="password"
placeholder="Enter password" required>
</div>

<button class="btn-primary full-button" type="submit">
Login
</button>

</form>

<p style="text-align:center;margin-top:20px;">
Don't have an account?
<a href="index.php?page=auth&action=register"
style="color:#16345c;font-weight:bold;">
Register as Customer
</a>
</p>

</div>

<div class="box">
<h3>Demo Login</h3>
<p>Admin: admin@rentacar.com / password</p>
<p>Manager: manager@rentacar.com / password</p>
<p>Staff: staff@rentacar.com / password</p>
<p>Customer: customer@gmail.com / password</p>
</div>

</div>
</div>

<?php require_once "views/partials/footer.php"; ?>
