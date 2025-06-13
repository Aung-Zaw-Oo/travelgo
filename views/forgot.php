<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Register</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/forgot.css">
    

</head>

<body>

    <?php
    include "../includes/header.php";
    ?>

    <main>
        <div class="container">
            <h2>Reset Password</h2>
            <form action="" method="post">
                <input type="email" name="email" placeholder="Enter Email" required>
                <button type="submit"><i class="fa-solid fa-unlock"></i></i> Reset Password</button>
                <a href="../index.php?action=login">Back to Login</a>
                <br>
            </form>
        </div>
    </main>

    <?php
    include "../includes/footer.php";
    ?>

</body>

</html>