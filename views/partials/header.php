<?php

if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= e(APP_NAME); ?></title>

<link rel="stylesheet" href="assets/css/style.css">
<script src="assets/js/app.js" defer></script>
</head>

<body>

<?php if(isset($_SESSION['user'])): ?>

<div class="top-navigation">

<div>
<h2>Rent A CAR Management</h2>
<p>Welcome, <?= e($_SESSION['user']['name']); ?></p>
</div>

<div>
<a class="btn-secondary"
href="index.php?page=<?= e($_SESSION['user']['role']); ?>&action=dashboard">
Dashboard
</a>

<a class="btn-danger small-btn"
href="index.php?page=auth&action=logout">
Logout
</a>
</div>

</div>

<?php endif; ?>
