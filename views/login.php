<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/login.css">
</head>

<body>

    <?php
    include "../includes/header.php";
    ?>

    <main>
        <div class="container">
            <h2>Login</h2>

            <?php
            if (isset($_SESSION['error'])) {
                echo "<div class='alert error'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']);
            }
            ?>


            <form action="../controllers/AuthController.php?action=login" method="post">
                <input
                    type="email"
                    name="email"
                    placeholder="Enter Email">

                <input type="password" name="password" placeholder="Enter Password">

                <button type="submit"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                <a href="../index.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Cancel</a>
                <a href="../index.php?action=register">Don't have an account? Register</a><br>
                <a href="../index.php?action=forgot">Forgot Password?</a>
            </form>


        </div>
    </main>

    <?php
    include "../includes/footer.php";
    ?>

</body>

</html>