<?php
session_start();
require_once 'db-config.php';

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding items to cart
if (isset($_GET['add'])) {
    $product_id = (int)$_GET['add'];
    $_SESSION['cart'][] = $product_id;
    header('Location: cart.php');
    exit;
}

// Handle removing items from cart
if (isset($_GET['remove'])) {
    $remove_id = (int)$_GET['remove'];
    $key = array_search($remove_id, $_SESSION['cart']);
    
    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
    }
    
    header('Location: cart.php');
    exit;
}

// Get products in cart from database
$cart_items = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $placeholders = str_repeat('?,', count($_SESSION['cart']) - 1) . '?';
    $stmt = $db->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($_SESSION['cart']);
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Calculate total
    foreach ($cart_items as $item) {
        $total += $item['price'];
    }
}
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

        .hero {
            background: white;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
            border-bottom: 1px solid #dee2e6;
        }

        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .cart-table {
            width: 100%;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .cart-table th,
        .cart-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .cart-table th {
            background: #f8f9fa;
            font-weight: bold;
        }

        .remove-btn {
            color: #dc3545;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            background: #fff;
            border: 1px solid #dc3545;
        }

        .remove-btn:hover {
            background: #dc3545;
            color: white;
        }

        .cart-total {
            text-align: right;
            font-size: 1.25rem;
            margin-bottom: 2rem;
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .checkout-btn {
            display: inline-block;
            padding: 1rem 2rem;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .checkout-btn:hover {
            background: #218838;
        }

        .empty-cart {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .empty-cart h2 {
            margin-bottom: 1rem;
        }

        .continue-shopping {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.75rem 1.5rem;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
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
                <a href="/about.php">About Us</a>
                <a href="/products.php">Products</a>
                <a href="/cart.php" class="demo-btn active">Cart</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <h1>Shopping Cart</h1>
        <p>Review your items and checkout</p>
    </section>

    <div class="cart-container">
        <?php if (empty($cart_items)): ?>
            <div class="empty-cart">
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added any items to your cart yet.</p>
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
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <a href="#" onclick="return removeItem(<?php echo $item['id']; ?>)" class="remove-btn">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-total">
                <strong>Total: $<?php echo number_format($total, 2); ?></strong>
            </div>

            <div style="text-align: right;">
                <a href="/register.php?checkout=true" class="checkout-btn">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2025 AnyCompany. All rights reserved.</p>
    </footer>

    <script>
    function removeItem(id) {
        if (confirm('Are you sure you want to remove this item?')) {
            window.location.href = 'cart.php?remove=' + id;
            return true;
        }
        return false;
    }
    </script>
</body>
</html>




