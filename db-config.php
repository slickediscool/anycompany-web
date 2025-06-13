<?php
$db_host = 'ecommerce-db.cmx22ymccmu0.us-east-1.rds.amazonaws.com';
$db_name = 'ecommerce-db';
$db_user = 'admin';
$db_pass = 'zor156!75';  // Use your actual RDS password

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Log error but don't break the site
    error_log("Database connection failed: " . $e->getMessage());
    $db = null;
}
?>
