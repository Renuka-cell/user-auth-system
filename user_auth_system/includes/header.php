<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Authentication System</title>
    <link rel="stylesheet" href="/user_auth_system/assets/css/style.css">
</head>
<body>

<?php if (isset($_SESSION['user_id'])): ?>
    <!-- NAVBAR VISIBLE ONLY WHEN LOGGED IN -->
    <div class="navbar">
        <span class="brand">Auth System</span>
        <a href="/user_auth_system/dashboard.php">Dashboard</a>
        <a href="/user_auth_system/profile/edit_profile.php">Profile</a>
        <a href="/user_auth_system/auth/change_password.php">Change Password</a>
        <a href="/user_auth_system/auth/logout.php">Logout</a>
    </div>
<?php endif; ?>

<div class="container">
