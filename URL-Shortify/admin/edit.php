<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/admin_functions.php';

$database = new Database();
$db = $database->getConnection();

$code = $_GET['code'] ?? '';
$action = $_GET['action'] ?? '';

if ($code && in_array($action, ['enable', 'disable'])) {

    $status = $action === 'enable' ? 'active' : 'disabled';
    updateUrlStatus($db, $code, $status);
}

header("Location: dashboard.php");
exit();
