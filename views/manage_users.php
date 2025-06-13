<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

require_once '../controllers/UserController.php';

$userController = new UserController();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $userController->delete($_GET['id']);
    exit;
}

$users = $userController->index();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Manage Users</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/manage_users.css">
</head>

<body>

    <?php include "../includes/header.php" ?>

    <main>
        <div class="container">
            <h1><i class="fa-solid fa-users"></i> Manage Users</h1>
            <a href="add_user.php" class="btn-add"><i class="fa-solid fa-plus"></i> Add New User</a>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registered On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $index => $user): ?>
                            <tr>
                                <td data-label="#"><?= $index + 1 ?></td>
                                <td data-label="Name"><?= htmlspecialchars($user['name']) ?></td>
                                <td data-label="Email"><?= htmlspecialchars($user['email']) ?></td>
                                <td data-label="Role"><?= htmlspecialchars(ucfirst($user['role'])) ?></td>
                                <td data-label="Registered On"><?= htmlspecialchars($user['created_at']) ?></td>
                                <td data-label="Actions" class="actions">
                                    <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn-edit"><i class="fa-solid fa-pen"></i></a>
                                    <a href="manage_users.php?action=delete&id=<?= $user['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa-solid fa-trash"></i></a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include "../includes/footer.php" ?>

</body>

</html>