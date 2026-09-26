
<?php


require_once __DIR__ . '/../includes/auth.php';
requireAdmin();



require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/admin_functions.php';

$database = new Database();
$db = $database->getConnection();

// Pagination
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 20;
$offset = ($page - 1) * $limit;

// Search
$search = trim($_GET['search'] ?? '');

$urls = getAllUrls($db, $limit, $offset, $search);
$total = getUrlsCount($db, $search);
$totalPages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2>Admin Dashboard</h2>
    <a href="logout.php" class="btn btn-danger btn-sm float-end">
    Logout
</a>


    <form class="row g-3 mb-4">
        <div class="col-auto">
            <input type="text" name="search" class="form-control"
                   placeholder="Search URLs" value="<?= htmlspecialchars($search) ?>">
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    <table class="table table-bordered table-hover bg-white">
        <thead>
            <tr>
                <th>#</th>
                <th>Original URL</th>
                <th>Short Code</th>
                <th>Clicks</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($urls as $url): ?>
            <tr>
                <td><?= htmlspecialchars($url['id']) ?></td>
                <td style="max-width: 300px; overflow-x: auto;">
                    <?= htmlspecialchars($url['original_url']) ?>
                </td>
                <td><?= htmlspecialchars($url['short_code']) ?></td>
                <td><?= htmlspecialchars($url['click_count']) ?></td>
                <td><?= htmlspecialchars($url['status']) ?></td>
                <td><?= htmlspecialchars($url['created_at']) ?></td>
                <td>
                    <?php if ($url['status'] === 'active'): ?>
                        <a href="edit.php?code=<?= urlencode($url['short_code']) ?>&action=disable"
                           class="btn btn-sm btn-warning">Disable</a>
                    <?php else: ?>
                        <a href="edit.php?code=<?= urlencode($url['short_code']) ?>&action=enable"
                           class="btn btn-sm btn-success">Enable</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                <li class="page-item <?= $p === $page ? 'active' : '' ?>">
                    <a class="page-link"
                       href="?page=<?= $p ?>&search=<?= urlencode($search) ?>">
                        <?= $p ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>

</div>
</body>
</html>
