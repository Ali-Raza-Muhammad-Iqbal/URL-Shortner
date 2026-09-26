<?php
declare(strict_types=1);

session_start();

function isAdminLoggedIn(): bool
{
    return isset($_SESSION['admin_id']);
}

function requireAdmin(): void
{
    if (!isAdminLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}
