<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Home</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/background.css">

    <style>
        main {
            width: 100%;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .search-bar {
            background: rgba(255, 255, 255, 0.6);
            padding: 1rem;
            border-radius: 8px;
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            justify-content: center;
            max-width: 900px;
            margin: 0 auto 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-bar input {
            padding: 0.7rem 1rem;
            border: 1px solid var(--primary-color);
            border-radius: 5px;
            flex: 1 1 150px;
            font-size: 0.95rem;
        }

        .search-bar button {
            padding: 0.7rem 1.2rem;
            background: var(--decent-color);
            color: var(--text-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.3s;
        }

        .search-bar button:hover {
            background: var(--accent-color);
        }

        .flights-list {
            background: rgba(255, 255, 255, 0.6);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 0 auto;
        }

        .flights-list h2 {
            text-align: center;
            margin-bottom: 1rem;
            color: #f0a500;
        }

        .flight-item {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr auto auto;
            gap: 1rem;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .flight-item:last-child {
            border-bottom: none;
        }

        .flight-item div i {
            margin-right: 0.3rem;
            color: #f0a500;
        }

        .flight-price i {
            color: #f0a500;
        }

        .book-btn {
            padding: 0.5rem 1rem;
            background: var(--decent-color);
            color: var(--text-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: .95rem;
            transition: background .3s;
        }

        .book-btn:hover {
            background: var(--accent-color);
        }

        @media (max-width: 600px) {
            .flights-list {
                display: grid;
                gap: 5px;
            }

            .flight-item {
                grid-template-columns: 1fr 1fr;
                gap: 0.5rem;
            }

            .flight-item div {
                text-align: left;
            }
        }
    </style>
</head>

<body>

    <?php
    include "../includes/header.php";
    ?>

    <main>
        <section class="search-bar">
            <input type="text" placeholder="Airline">
            <input type="text" placeholder="From">
            <input type="text" placeholder="To">
            <input type="text" placeholder="Departure Time">
            <input type="text" placeholder="Arrival Time">
            <button><i class="fas fa-search"></i> Search</button>
        </section>

        <section class="flights-list">
            <h2><i class="fas fa-plane"></i> Available Flights</h2>

            <div class="flight-item">
                <div><i class="fas fa-building"></i> Myanmar Airways</div>
                <div><i class="fas fa-plane-departure"></i> Yangon</div>
                <div><i class="fas fa-plane-arrival"></i> Bangkok</div>
                <div><i class="far fa-clock"></i> 10:00 AM - 12:30 PM</div>
                <div class="flight-price"><i class="fa-solid fa-dollar-sign"></i> 120</div>
                <button class="book-btn"><i class="fas fa-ticket-alt"></i> Book Now</button>
            </div>

            <div class="flight-item">
                <div><i class="fas fa-building"></i> Singapore Airlines</div>
                <div><i class="fas fa-plane-departure"></i> Yangon</div>
                <div><i class="fas fa-plane-arrival"></i> Singapore</div>
                <div><i class="far fa-clock"></i> 2:00 PM - 5:00 PM</div>
                <div class="flight-price"><i class="fa-solid fa-dollar-sign"></i> 180</div>
                <button class="book-btn"><i class="fas fa-ticket-alt"></i> Book Now</button>
            </div>

            <div class="flight-item">
                <div><i class="fas fa-building"></i> AirAsia</div>
                <div><i class="fas fa-plane-departure"></i> Yangon</div>
                <div><i class="fas fa-plane-arrival"></i> Kuala Lumpur</div>
                <div><i class="far fa-clock"></i> 6:00 PM - 9:00 PM</div>
                <div class="flight-price"><i class="fa-solid fa-dollar-sign"></i> 140</div>
                <button class="book-btn"><i class="fas fa-ticket-alt"></i> Book Now</button>
            </div>
        </section>
    </main>

    <?php
    include "../includes/footer.php";
    ?>

</body>

</html>