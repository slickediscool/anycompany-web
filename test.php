<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db_config.php';

try {
    echo "Attempting database connection...<br>";
    $stmt = $db->query("SELECT COUNT(*) FROM products");
    $count = $stmt->fetchColumn();
    echo "Success! Found $count products in database.";
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
