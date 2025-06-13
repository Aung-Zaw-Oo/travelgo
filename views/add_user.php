<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
?>

<?php
require_once '../controllers/UserController.php';
$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->create($_POST);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add User</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/add_user.css">
    
</head>

<body>

    <?php include_once "../includes/header.php"; ?>

    <main>
        <div class="container">
            <h2>Add New User</h2>
            <form method="POST" action="">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="" disabled selected>Select role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" class="btn-submit"><i class="fa-solid fa-plus"></i> Add User</button>
                <button type="button" onclick="history.back()" class="btn-back"> <i class="fa-solid fa-arrow-left"></i> Back</button>
            </form>
        </div>
    </main>

    <?php include_once "../includes/footer.php"; ?>

</body>

</html>