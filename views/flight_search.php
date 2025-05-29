<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Home</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <style>
        main {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .search-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #f0a500;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        form .input-group {
            flex: 1 1 45%;
            display: flex;
            flex-direction: column;
        }

        form .input-group.full {
            flex: 1 1 100%;
        }

        form label {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-weight: bold;
        }

        form input,
        form select {
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        form input:focus,
        form select:focus {
            border-color: #f0a500;
            outline: none;
        }

        form button {
            width: 100%;
            padding: 1rem;
            background: #f0a500;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            transition: background 0.3s;
        }

        form button:hover {
            background: #d18f00;
        }

        @media (max-width: 480px) {
            form .input-group {
                flex: 1 1 100%;
            }
        }
    </style>
</head>

<body>

    <?php
    include "../includes/header.php";
    ?>

    <main>
        <div class="search-container">
            <h2><i class="fas fa-plane"></i> Search Flights</h2>
            <form>
                <div class="input-group">
                    <label for="from">From</label>
                    <input type="text" id="from" name="from" placeholder="Departure City" required>
                </div>
                <div class="input-group">
                    <label for="to">To</label>
                    <input type="text" id="to" name="to" placeholder="Arrival City" required>
                </div>
                <div class="input-group">
                    <label for="departure">Departure Date</label>
                    <input type="date" id="departure" name="departure" required>
                </div>
                <div class="input-group">
                    <label for="return">Return Date</label>
                    <input type="date" id="return" name="return">
                </div>
                <div class="input-group">
                    <label for="passengers">Passengers</label>
                    <select id="passengers" name="passengers" required>
                        <option value="">Select</option>
                        <option value="1">1 Passenger</option>
                        <option value="2">2 Passengers</option>
                        <option value="3">3 Passengers</option>
                        <option value="4+">4+ Passengers</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="class">Class</label>
                    <select id="class" name="class" required>
                        <option value="">Select</option>
                        <option value="economy">Economy</option>
                        <option value="business">Business</option>
                        <option value="first">First Class</option>
                    </select>
                </div>
                <div class="input-group full">
                    <button type="submit"><i class="fas fa-search"></i> Search Flights</button>
                </div>
            </form>
        </div>
    </main>

    <?php
    include "../includes/footer.php";
    ?>

</body>

</html>