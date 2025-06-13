<?php
// AnyCompany E-commerce Home Page
require_once 'db_config.php';  // Add this line here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnyCompany E-commerce - Home</title>
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

        .nav-links a.active {
            color: #007bff;
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
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .gradient-text {
            color: #007bff;
        }

        .btn-primary {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 1rem 2rem;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 1rem;
        }

        .featured-products {
            padding: 4rem 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .product-card {
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: 5px;
            text-align: center;
        }

        .product-card img {
            max-width: 200px;
            height: auto;
        }

        .product-card h3 {
            margin: 1rem 0;
        }

        .product-card .price {
            color: #007bff;
            font-weight: bold;
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
                <span>🛒</span> AnyCompany Shop
            </a>
            <div class="nav-links">
                <a href="/" class="active">Home</a>
                <a href="/about.php">About Us</a>
                <a href="/products.php">Products</a>
                <a href="/cart.php" class="demo-btn">Cart</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to <span class="gradient-text">AnyCompany Shop</span></h1>
            <p>Discover amazing products - both digital and fashion</p>
            <a href="/products.php" class="btn-primary">Shop Now</a>
        </div>
    </section>

    <section class="featured-products">
        <div class="container">
            <h2>Featured Products</h2>
            <div class="product-grid">
                <div class="product-card">
                    <img src="https://via.placeholder.com/200" alt="Product 1">
                    <h3>Premium Notebook</h3>
                    <div class="price">$14.99</div>
                    <a href="/cart.php?add=1" class="btn-primary">Add to Cart</a>
                </div>
                <div class="product-card">
                    <img src="https://via.placeholder.com/200" alt="Product 2">
                    <h3>Study Desk Lamp</h3>
                    <div class="price">$29.99</div>
                    <a href="/cart.php?add=2" class="btn-primary">Add to Cart</a>
                </div>
                <div class="product-card">
                    <img src="https://via.placeholder.com/200" alt="Product 3">
                    <h3>Wireless Mouse</h3>
                    <div class="price">$19.99</div>
                    <a href="/cart.php?add=3" class="btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 AnyCompany Shop. All rights reserved.</p>
    </footer>
</body>
</html>

