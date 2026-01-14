<?php
session_start();
include("../config/db.php");

if (isset($_SESSION['user_id'])) {
    header("Location: ../dashboard.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}

include("../includes/header.php");
?>

<div class="auth-card">
    <h2>Welcome Back</h2>
    <p class="subtitle">Login to continue</p>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <p class="switch">
        Don’t have an account?
        <a href="register.php">Register</a>
    </p>
</div>

<?php include("../includes/footer.php"); ?>