<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

include("includes/header.php");
?>

<h2>Dashboard</h2>
<p>Welcome! You are logged in successfully.</p>

<?php include("includes/footer.php"); ?>