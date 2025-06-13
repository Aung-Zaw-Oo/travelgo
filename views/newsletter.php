<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Newsletter</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/newsletter.css">
</head>

<body>

    <?php
    include "../includes/header.php";
    ?>

    <main>
        <header>
            <h1><i class="fas fa-paper-plane"></i> TravelGO Newsletter</h1>
            <p>Discover trending destinations, travel news, and exclusive deals!</p>
        </header>

        <section>
            <h2>🌍 Trending Places</h2>
            <div class="trending">
                <div class="card">
                    <img src="../assets/imgs/tokyo.jpg" alt="Tokyo">
                    <h3>Tokyo, Japan</h3>
                    <p>Experience the future in Tokyo’s neon streets and cherry blossoms.</p>
                    <a href="#">Read More</a>
                </div>
                <div class="card">
                    <img src="../assets/imgs/paris.jpg" alt="Paris">
                    <h3>Paris, France</h3>
                    <p>Romance, art, and culture in the City of Lights.</p>
                    <a href="#">Read More</a>
                </div>
            </div>
        </section>

        <section>
            <h2>📰 Latest Travel News</h2>
            <div class="news">
                <div class="card">
                    <h3>New Visa-Free Destinations for 2025</h3>
                    <p>Travel just got easier! Check the latest visa-free countries for 2025.</p>
                    <a href="#">Read More</a>
                </div>
                <div class="card">
                    <h3>Top 10 Summer Destinations</h3>
                    <p>Sun, beaches, and adventure. Here’s where to go this summer.</p>
                    <a href="#">Read More</a>
                </div>
            </div>
        </section>

        <section>
            <h2>🎁 Exclusive Deals</h2>
            <div class="deals">
                <div class="card">
                    <h3>50% Off Bali Trips</h3>
                    <p>Book your Bali trip today and get 50% off for early bird travelers.</p>
                    <a href="#">Book Now</a>
                </div>
                <div class="card">
                    <h3>Free Night in Maldives</h3>
                    <p>Stay 4 nights, get the 5th night free in Maldives resorts.</p>
                    <a href="#">Book Now</a>
                </div>
            </div>
        </section>

        <div class="subscribe">
            <h2>Subscribe for More Updates</h2>
            <form>
                <input type="text" placeholder="Your Name" required>
                <input type="email" placeholder="Your Email" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </main>

    <?php
    include "../includes/footer.php";
    ?>

</body>

</html>