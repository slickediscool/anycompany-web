<?php
$db_host = 'ecommerce-db.cmx22ymccmu0.us-east-1.rds.amazonaws.com';
$db_name = 'ecommerce';
$db_user = 'admin';
$db_pass = 'zor156!75';

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Log error but don't stop execution
    error_log("Database connection failed: " . $e->getMessage());
    // Set $db to null but allow the page to continue loading
    $db = null;
}
?>
