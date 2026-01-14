<?php
session_start();
include("../config/db.php");

/* 
   If user is already logged in,
   redirect to dashboard
*/
if (isset($_SESSION['user_id'])) {
    header("Location: ../dashboard.php");
    exit();
}

$error = "";

/*
   Handle form submission
*/
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $full_name = trim($_POST['full_name']);
    $email     = trim($_POST['email']);
    $password  = $_POST['password'];

    // Hash password (security best practice)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $sql = "INSERT INTO users (full_name, email, password)
            VALUES ('$full_name', '$email', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to login after successful registration
        header("Location: login.php");
        exit();
    } else {
        $error = "Email already exists or registration failed!";
    }
}

include("../includes/header.php");
?>

<div class="auth-card">
    <h2>Create Account</h2>
    <p class="subtitle">Register to get started</p>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
        <input
            type="text"
            name="full_name"
            placeholder="Full Name"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="Email address"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
            pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}"
            title="At least 8 characters, include uppercase, lowercase, number, and special character"
        >


        <button type="submit">Register</button>
    </form>

    <p class="switch">
        Already have an account?
        <a href="login.php">Login</a>
    </p>
</div>

<?php include("../includes/footer.php"); ?>