<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Register</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="../includes/reset.css">
    <style>
        body {
            background: linear-gradient(to right, rgb(73, 93, 136), rgb(190, 131, 35));
            color: var(--text-color);
        }

        main {
            flex: 1;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(245, 245, 245, 0.5);
            padding: 1rem 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .container h2 {
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        form input:focus {
            border-color: var(--accent-color);
            outline: none;
        }

        form button {
            width: 100%;
            padding: 0.8rem;
            background: var(--decent-color);
            border: none;
            color: var(--text-color);
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
        }

        form button:hover {
            background: var(--accent-color);
        }

        form button i {
            margin-right: 0.5rem;
        }

        form a {
            color: var(--primary-color);
        }

        @media (max-width: 480px) {
            .container {
                padding: 1.25rem;
            }

            .container h2 {
                font-size: 1.5rem;
            }

            form a {
                font-size: 0.85rem;
            }
        }
    </style>

</head>

<body>

    <?php
    include "../includes/header.php";
    ?>

    <main>
        <div class="container">
            <h2>Login</h2>
            <?php
            if (isset($error)) {
                echo "<p>$error</p>";
            }
            ?>
            <form action="../controllers/UserController.php?action=login" method="post">
                <input type="email" name="email" placeholder="Enter Email" required>
                <input type="password" name="password" placeholder="Enter Password" required>

                <button type="submit"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
                <a href="../index.php?action=register">Don't have an account? Register</a>
                <br>
                <a href="../index.php?action=forgot">Forgot Password?</a>
            </form>
        </div>
    </main>

    <?php
    include "../includes/footer.php";
    ?>

</body>

</html>