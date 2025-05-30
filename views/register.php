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
            border-color: #f0a500;
            outline: none;
        }

        form button {
            width: 100%;
            padding: 0.8rem;
            background: #f0a500;
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

        form button:hover {
            background: #d18f00;
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
            <h2>Register</h2>
            <form action="../controllers/AuthController.php?action=register" method="post">
                <input type="text" name="name" placeholder="Enter Full Name" required>
                <input type="email" name="email" placeholder="Enter Valid Email" required>
                <input type="password" name="password" placeholder="Enter Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit"><i class="fas fa-user-plus"></i> Register</button>
                <a href="../index.php?action=login">Already have an account? Login</a>
            </form>
        </div>
    </main>

    <?php
    include "../includes/footer.php";
    ?>

</body>

</html>