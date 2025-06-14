<?php
session_start();
require_once 'db-config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: register.php?checkout=true');
    exit;
}
// Verify cart is not empty
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

// Get cart items from database
$cart_items = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $placeholders = str_repeat('?,', count($_SESSION['cart']) - 1) . '?';
    $stmt = $db->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($_SESSION['cart']);
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($cart_items as $item) {
        $total += $item['price'];
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Here we'll add order processing later
    // For now, just clear the cart and show success
    $_SESSION['cart'] = [];
    header('Location: order-confirmation.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - AnyCompany</title>
    <style>
        /* Copy your existing CSS styles */
        .checkout-form {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }

        .order-summary {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #dee2e6;
        }

        .submit-btn {
            background: #28a745;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 1.1rem;
        }

        .submit-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <nav>
        <!-- Copy your navigation code -->
    </nav>

    <section class="hero">
        <h1>Checkout</h1>
        <p>Complete your order</p>
    </section>

    <div class="cart-container">
        <div class="checkout-form">
            <form method="POST" action="checkout.php">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="address">Shipping Address</label>
                    <input type="text" id="address" name="address" required>
                </div>

                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" required>
                </div>

                <div class="form-group">
                    <label for="zip">ZIP Code</label>
                    <input type="text" id="zip" name="zip" required>
                </div>

                <div class="order-summary">
                    <h3>Order Summary</h3>
                    <?php foreach ($cart_items as $item): ?>
                        <p>
                            <?php echo htmlspecialchars($item['name']); ?> - 
                            $<?php echo number_format($item['price'], 2); ?>
                        </p>
                    <?php endforeach; ?>
                    <h4>Total: $<?php echo number_format($total, 2); ?></h4>
                </div>

                <button type="submit" class="submit-btn">Place Order</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 AnyCompany. All rights reserved.</p>
    </footer>
</body>
</html>
