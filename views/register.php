<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Register</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/register.css">
    <style>
        .btn-back {
            width: 100%;
            padding: 0.8rem;
            border: none;
            color: white;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
        }

        .btn-back {
            background: #14213d;
            display: block;
            width: 100%;
            padding: 0.8rem;
        }

        .btn-back:hover {
            background: #0f1b2c;
        }
    </style>
</head>

<body>

    <?php
    include "../includes/header.php";
    ?>

    <main>
        <div class="container">
            <h2>Register</h2>

            <?php
            if (isset($_SESSION['error'])) {
                echo "<div class='alert error'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']);
            }

            if (isset($_SESSION['success'])) {
                echo "<div class='alert success'>" . $_SESSION['success'] . "</div>";
                unset($_SESSION['success']);
            }
            ?>


            <form action="../controllers/AuthController.php?action=register" method="post">
                <input type="text" name="name" placeholder="Enter Full Name">
                <input type="email" name="email" placeholder="Enter Valid Email">
                <input type="password" name="password" placeholder="Enter Password">
                <input type="password" name="confirm_password" placeholder="Confirm Password">
                <button type="submit"><i class="fas fa-user-plus"></i> Register</button>
                <a href="../index.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Cancel</a>
                <a href="../index.php?action=login">Already have an account? Login</a>
            </form>
        </div>
    </main>

    <?php
    include "../includes/footer.php";
    ?>

</body>

</html>