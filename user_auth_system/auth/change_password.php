<?php
session_start();
include("../config/db.php");

/*
    If user is not logged in,
    redirect to login page
*/
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/*
    Strong password validation function
*/
function isStrongPassword($password) {
    return preg_match(
        '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        $password
    );
}

$id = $_SESSION['user_id'];
$message = "";
$message_type = "";

/*
    Handle form submission
*/
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Validate new password strength
    if (!isStrongPassword($new_password)) {
        $message = "Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.";
        $message_type = "error";
    } else {

        // Fetch current password from database
        $result = mysqli_query($conn, "SELECT password FROM users WHERE id = $id");
        $user = mysqli_fetch_assoc($result);

        // Verify old password
        if (password_verify($old_password, $user['password'])) {

            // Hash and update new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE users SET password='$hashed_password' WHERE id=$id");

            $message = "Password changed successfully!";
            $message_type = "success";
        } else {
            $message = "Old password is incorrect!";
            $message_type = "error";
        }
    }
}

include("../includes/header.php");
?>

<div class="auth-card">
    <h2>Change Password</h2>
    <p class="subtitle">Keep your account secure</p>

    <?php if (!empty($message)): ?>
        <p class="<?= $message_type ?>"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST" autocomplete="off">

        <input
            type="password"
            name="old_password"
            placeholder="Current Password"
            required
        >

        <input
            type="password"
            name="new_password"
            placeholder="New Password"
            required
            pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&]).{8,}"
            title="At least 8 characters, include uppercase, lowercase, number, and special character"
        >

        <button type="submit">Update Password</button>
    </form>
</div>

<?php include("../includes/footer.php"); ?>
