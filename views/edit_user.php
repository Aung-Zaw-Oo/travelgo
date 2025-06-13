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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'role' => $_POST['role']
    ];
    $userController->update($id, $data);
}

if (!isset($_GET['id'])) {
    die("User ID not provided.");
}

$id = $_GET['id'];
$user = $userController->edit($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit User</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/edit_user.css">
</head>

<body>

    <?php include_once "../includes/header.php" ?>

    <main>
        <div class="container">
            <h2>Edit User</h2>

            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">

                <input type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($user['name']) ?>" required>

                <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($user['email']) ?>" required>

                <input type="password" name="password" placeholder="New Password (Leave blank to keep current)">


                <select name="role" required>
                    <option value="" disabled>Select role</option>
                    <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>

                <button type="submit" class="btn-submit"><i class="fa-solid fa-check"></i> Update User</button>
                <button type="button" onclick="history.back()" class="btn-back"> <i class="fa-solid fa-arrow-left"></i> Back</button>
            </form>
        </div>
    </main>

    <?php include_once "../includes/footer.php" ?>

</body>

</html>