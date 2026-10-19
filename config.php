<?php
/**
 * GokulClicks Studio - Database Connection
 * Default XAMPP/WAMP settings: username "root", empty password.
 * Change these if your local MySQL setup is different.
 */
$DB_HOST = 'localhost';
$DB_NAME = 'gc_studio';
$DB_USER = 'root';
$DB_PASS = '';
try {
    $pdo = new PDO(
        "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
        $DB_USER,
        $DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('Database connection failed. Make sure you have imported database.sql into phpMyAdmin, and that MySQL is running. (' . $e->getMessage() . ')');
}

// ---- Studio details (shown across all pages) ----
$STUDIO_NAME    = 'GokulClicks Studio';
$STUDIO_PHONE   = '9025605907';
$STUDIO_PHONE_DISPLAY = '+91 90256 05907';
$STUDIO_EMAIL   = 'gokulclicks239@gmail.com';
$STUDIO_WHATSAPP = 'https://wa.me/919025605907?text=Hi%20GokulClicks%20Studio%2C%20I%27d%20like%20to%20know%20more%20about%20your%20photography%20packages.';
