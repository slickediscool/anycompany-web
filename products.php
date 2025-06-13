<?php
// Products Page
require_once 'db_config.php';  // Add this line here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - AnyCompany</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background: #f8f9fa;
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
            background: white;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            border-bottom: 1px solid #dee2e6;
        }

        .products-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .filters {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .filters select {
            padding: 0.5rem;
            margin-right: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-title {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .product-price {
            font-size: 1.2rem;
            color: #007bff;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .product-description {
            color: #6c757d;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .add-to-cart {
            display: block;
            width: 100%;
            padding: 0.8rem;
            background: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .add-to-cart:hover {
            background: #0056b3;
        }

        footer {
            background: #333;
            color: white;
            padding: 2rem;
            text-align: center;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
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
                <a href="/about.php">About Us</a>
                <a href="/products.php" class="active">Products</a>
                <a href="/cart.php" class="demo-btn">Cart</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <h1>Our Products</h1>
        <p>Browse our collection of quality items</p>
    </section>

    <div class="products-container">
        <div class="filters">
            <select id="category">
                <option value="">All Categories</option>
                <option value="electronics">Electronics</option>
                <option value="clothing">Clothing</option>
                <option value="accessories">Accessories</option>
            </select>
            <select id="sort">
                <option value="price-asc">Price: Low to High</option>
                <option value="price-desc">Price: High to Low</option>
                <option value="name-asc">Name: A to Z</option>
            </select>
        </div>

        <div class="product-grid">
            <!-- Product 1 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/300" alt="Product 1" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Wireless Earbuds</h3>
                    <div class="product-price">$79.99</div>
                    <p class="product-description">High-quality wireless earbuds with noise cancellation.</p>
                    <a href="/cart.php?add=1" class="add-to-cart">Add to Cart</a>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/300" alt="Product 2" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Smart Watch</h3>
                    <div class="product-price">$149.99</div>
                    <p class="product-description">Feature-rich smartwatch with health tracking.</p>
                    <a href="/cart.php?add=2" class="add-to-cart">Add to Cart</a>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/300" alt="Product 3" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Bluetooth Speaker</h3>
                    <div class="product-price">$59.99</div>
                    <p class="product-description">Portable speaker with rich, clear sound.</p>
                    <a href="/cart.php?add=3" class="add-to-cart">Add to Cart</a>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/300" alt="Product 4" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Phone Case</h3>
                    <div class="product-price">$24.99</div>
                    <p class="product-description">Durable protection for your smartphone.</p>
                    <a href="/cart.php?add=4" class="add-to-cart">Add to Cart</a>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/300" alt="Product 5" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">Power Bank</h3>
                    <div class="product-price">$39.99</div>
                    <p class="product-description">10000mAh portable charger for your devices.</p>
                    <a href="/cart.php?add=5" class="add-to-cart">Add to Cart</a>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/300" alt="Product 6" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">USB-C Cable</h3>
                    <div class="product-price">$14.99</div>
                    <p class="product-description">Fast charging cable with braided nylon.</p>
                    <a href="/cart.php?add=6" class="add-to-cart">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 AnyCompany. All rights reserved.</p>
    </footer>
</body>
</html>
