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
$message = '';
if (isset($_GET['remove'])) {
    $remove_id = (int)$_GET['remove'];
    $key = array_search($remove_id, $_SESSION['cart']);
    
    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
        $message = "Item removed from cart";
    }
    
    // Redirect to prevent double-removal on refresh
    header('Location: cart.php?removed=true');
    exit;
}

if (isset($_GET['removed'])) {
    $message = "Item removed from cart";
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
        /* Your existing CSS styles here */
        .alert {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            margin: 10px auto;
            max-width: 1200px;
            text-align: center;
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

    <?php if ($message): ?>
        <div class="alert">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

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



