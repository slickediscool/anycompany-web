<?php
session_start();
require_once 'db_config.php';  // Add this line here

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding items to cart
if (isset($_GET['add'])) {
    $product_id = $_GET['add'];
    $_SESSION['cart'][] = $product_id;
}

// Handle removing items from cart
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    if (($key = array_search($remove_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

// Sample product data (replace with database in production)
$products = [
    1 => ['name' => 'Wireless Earbuds', 'price' => 79.99],
    2 => ['name' => 'Smart Watch', 'price' => 149.99],
    3 => ['name' => 'Bluetooth Speaker', 'price' => 59.99],
    4 => ['name' => 'Phone Case', 'price' => 24.99],
    5 => ['name' => 'Power Bank', 'price' => 39.99],
    6 => ['name' => 'USB-C Cable', 'price' => 14.99]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - AnyCompany</title>
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

        .cart-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 1rem;
        }

        .cart-title {
            text-align: center;
            margin-bottom: 2rem;
        }

        .cart-empty {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .cart-table {
            width: 100%;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-collapse: collapse;
        }

        .cart-table th {
            background: #f8f9fa;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }

        .cart-table td {
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }

        .remove-item {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }

        .cart-summary {
            margin-top: 2rem;
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-top: 2px solid #dee2e6;
            margin-top: 1rem;
        }

        .checkout-btn {
            display: block;
            width: 100%;
            padding: 1rem;
            background: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }

        .checkout-btn:hover {
            background: #218838;
        }

        .continue-shopping {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: #007bff;
            text-decoration: none;
        }

        footer {
            background: #333;
            color: white;
            padding: 2rem;
            text-align: center;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .cart-table {
                display: block;
                overflow-x: auto;
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
                <a href="/products.php">Products</a>
                <a href="/cart.php" class="demo-btn active">Cart</a>
            </div>
        </div>
    </nav>

    <div class="cart-container">
        <h1 class="cart-title">Shopping Cart</h1>

        <?php if (empty($_SESSION['cart'])): ?>
            <div class="cart-empty">
                <h2>Your cart is empty</h2>
                <p>Add some products to your cart!</p>
                <a href="/products.php" class="continue-shopping">Continue Shopping</a>
            </div>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $product_id):
                        if (isset($products[$product_id])):
                            $total += $products[$product_id]['price'];
                    ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <img src="https://via.placeholder.com/80" alt="Product" class="cart-item-image">
                                <span><?php echo htmlspecialchars($products[$product_id]['name']); ?></span>
                            </div>
                        </td>
                        <td>$<?php echo number_format($products[$product_id]['price'], 2); ?></td>
                        <td>
                            <a href="?remove=<?php echo $product_id; ?>" class="remove-item">Remove</a>
                        </td>
                    </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>

            <div class="cart-summary">
                <div class="cart-total">
                    <h3>Total</h3>
                    <h3>$<?php echo number_format($total, 2); ?></h3>
                </div>
                <a href="#" class="checkout-btn">Proceed to Checkout</a>
                <a href="/products.php" class="continue-shopping">Continue Shopping</a>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2025 AnyCompany. All rights reserved.</p>
    </footer>
</body>
</html>
