<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../includes/reset.css">
    <style>
        nav {
            background-color: var(--primary-color);
            color: var(--text-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav .menu {
            display: flex;
            gap: 1rem;
        }

        nav .menu a {
            text-decoration: none;
            color: var(--text-color);
            transition: color 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        nav .menu a:hover {
            color: var(--accent-color);
        }

        .hamburger {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            nav .menu {
                position: absolute;
                top: 60px;
                left: 0;
                right: 0;
                background: #333;
                flex-direction: column;
                align-items: center;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease-out;
            }

            nav .menu.active {
                max-height: 300px;
                padding: 1rem 0;
            }

            .hamburger {
                display: block;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="logo">
            <a href="../index.php">
                <i class="fa-solid fa-route" style="color: var(--accent-color);"></i> TravelGO
            </a>
        </div>
        <div class="menu" id="menu">
            <a href="../index.php"><i class="fas fa-home"></i> Home</a>
            <a href="../index.php?action=newsletter"><i class="fas fa-paper-plane"></i> Newsletter</a>

            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <a href="../index.php?action=manage_tickets"><i class="fa-solid fa-ticket"></i> Manage Tickets</a>
                    <a href="../index.php?action=manage_flights"><i class="fa-solid fa-plane"></i> Manage Flights</a>
                    <a href="../index.php?action=manage_users"><i class="fa-solid fa-users"></i> Manage Users</a>
                <?php else: ?>
                    <a href="../my_bookings.php"><i class="fa-solid fa-ticket"></i> My Bookings</a>
                    <a href="../profile.php"><i class="fa-solid fa-user"></i> Profile</a>
                <?php endif; ?>

                <a href="../controllers/AuthController.php?action=logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            <?php else: ?>
                <a href="../views/register.php"><i class="fa-solid fa-user-plus"></i> Register</a>
                <a href="../views/login.php"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
            <?php endif; ?>
        </div>
        <div class="hamburger" id="hamburger">
            <i class="fas fa-bars"></i>
        </div>
    </nav>

    </nav>

    <script>
        const hamburger = document.getElementById('hamburger');
        const menu = document.getElementById('menu');

        hamburger.addEventListener('click', () => {
            menu.classList.toggle('active');
        });

        const links = document.querySelectorAll('.menu a');
        links.forEach(link => {
            link.addEventListener('click', () => {
                if (menu.classList.contains('active')) {
                    menu.classList.remove('active');
                }
            });
        });
    </script>
</body>

</html>