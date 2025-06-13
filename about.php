<?php
// About Us Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - AnyCompany Shop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            text-decoration: none;
            color: #333;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
        }

        .demo-btn {
            background: #007bff;
            color: white !important;
            padding: 0.5rem 1rem;
            border-radius: 5px;
        }

        .hero {
            background: #f8f9fa;
            padding: 4rem 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .about-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .about-card {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .about-card h3 {
            color: #007bff;
            margin-bottom: 1rem;
        }

        .values-section {
            padding: 4rem 2rem;
            background: white;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .value-card {
            text-align: center;
            padding: 2rem;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .value-card i {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 1rem;
        }

        footer {
            background: #333;
            color: white;
            padding: 2rem;
            text-align: center;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="/" class="logo">
                <span>🛒</span> AnyCompany
            </a>
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/about.php" class="active">About Us</a>
                <a href="/products.php">Products</a>
                <a href="/cart.php" class="demo-btn">Cart</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <h1>About AnyCompany</h1>
        <p>Your Trusted Online Shopping Destination</p>
    </section>

    <section class="about-section">
        <h2>Our Story</h2>
        <p>Established in 2020, AnyCompany started with a simple mission: to provide quality products at competitive prices. We believe in making shopping easy, secure, and enjoyable for everyone.</p>
        
        <div class="about-grid">
            <div class="about-card">
                <h3>Our Mission</h3>
                <p>To deliver exceptional online shopping experiences through quality products, competitive prices, and outstanding customer service.</p>
            </div>
            <div class="about-card">
                <h3>Our Vision</h3>
                <p>To become your preferred online marketplace by consistently exceeding customer expectations and adapting to evolving market needs.</p>
            </div>
            <div class="about-card">
                <h3>Our Promise</h3>
                <p>We guarantee authentic products, secure transactions, and reliable customer support for all your shopping needs.</p>
            </div>
        </div>
    </section>

    <section class="values-section">
        <h2 style="text-align: center;">What Sets Us Apart</h2>
        <div class="values-grid">
            <div class="value-card">
                <i>✨</i>
                <h3>Quality Products</h3>
                <p>Carefully selected items from trusted suppliers and manufacturers.</p>
            </div>
            <div class="value-card">
                <i>🛡️</i>
                <h3>Secure Shopping</h3>
                <p>Protected transactions and trusted payment methods for your peace of mind.</p>
            </div>
            <div class="value-card">
                <i>🚚</i>
                <h3>Fast Delivery</h3>
                <p>Quick and reliable shipping to get your products to you as soon as possible.</p>
            </div>
            <div class="value-card">
                <i>💬</i>
                <h3>Customer Support</h3>
                <p>Dedicated team ready to assist you with any questions or concerns.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 AnyCompany. All rights reserved.</p>
    </footer>
</body>
</html>


