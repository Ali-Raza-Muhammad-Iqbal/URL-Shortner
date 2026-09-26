<?php
declare(strict_types=1);

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';

$database = new Database();
$db = $database->getConnection();

// Get short code from URL
$shortCode = $_GET['code'] ?? '';

if (empty($shortCode)) {
    http_response_code(404);
    die("Invalid short link.");
}

// Get original URL
$originalUrl = getOriginalUrl($db, $shortCode);

if ($originalUrl === null) {
    http_response_code(404);
    die("Link not found or expired.");
}

// Increase click count
incrementClickCount($db, $shortCode);

// Redirect
header("Location: " . $originalUrl);
exit();
