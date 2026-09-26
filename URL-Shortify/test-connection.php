<?php

require_once __DIR__ . '/config/database.php';

$database = new Database();
$db = $database->getConnection();

echo "Connected Successfully!";
