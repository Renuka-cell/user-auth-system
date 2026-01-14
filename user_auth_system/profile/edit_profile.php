<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_SESSION['user_id'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['full_name']);
    mysqli_query($conn, "UPDATE users SET full_name='$name' WHERE id=$id");
    $message = "Profile updated successfully!";
}

$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM users WHERE id=$id")
);

include("../includes/header.php");
?>

<div class="auth-card">
    <h2>Your Profile</h2>
    <p class="subtitle">Update your personal details</p>

    <?php if ($message): ?>
        <p class="success"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" value="<?= htmlspecialchars($user['email']) ?>" disabled>
        <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
        <button type="submit">Update Profile</button>
    </form>
</div>

<?php include("../includes/footer.php"); ?>