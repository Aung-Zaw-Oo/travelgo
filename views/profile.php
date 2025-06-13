<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Profile</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/profile.css">
</head>

<body>
    <?php include_once "../includes/header.php" ?>

    <main>
        <div class="container">

        </div>
        <h2>My Profile</h2>

        <?php if (isset($_SESSION['success'])): ?>
            <p style="color: green;"><?php echo $_SESSION['success'];
                                        unset($_SESSION['success']); ?></p>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?php echo $_SESSION['error'];
                                    unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <form action="../controllers/profile_action.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label>New Password (optional):</label>
            <input type="password" name="password">

            <button type="submit" name="update">Update Profile</button>
        </form>
    </main>

    <?php include_once "../includes/footer.php" ?>
</body>

</html>