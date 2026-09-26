<?php
declare(strict_types=1);

require_once __DIR__ . '/./config/database.php';
require_once __DIR__ . '/./includes/functions.php';

$database = new Database();
$db = $database->getConnection();

$shortUrl = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $originalUrl = trim($_POST['original_url'] ?? '');

    if (empty($originalUrl)) {
        $error = "Please enter a URL.";
    } else {
        $shortCode = createShortUrl($db, $originalUrl);

        if ($shortCode === null) {
            $error = "Invalid URL format.";
        } else {
            $baseUrl = "http://localhost/url-shortify/";
            $shortUrl = $baseUrl . $shortCode;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>URL Shortify</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg">
                <div class="card-body">

                    <h3 class="text-center mb-4">URL Shortify</h3>

                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($shortUrl): ?>
                        <div class="alert alert-success">
                            <strong>Your Short URL:</strong><br>
                            <a href="<?= htmlspecialchars($shortUrl) ?>" target="_blank">
                                <?= htmlspecialchars($shortUrl) ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Enter Long URL</label>
                            <input type="text" 
                                   name="original_url" 
                                   class="form-control" 
                                   placeholder="https://example.com/very/long/url"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Generate Short Link
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="admin/dashboard.php" class="btn btn-outline-primary">Admin Dashboard</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
