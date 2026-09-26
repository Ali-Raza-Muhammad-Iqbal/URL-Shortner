<?php
declare(strict_types=1);

/**
 * Get all URLs (with pagination & optional search)
 */
function getAllUrls(PDO $db, int $limit = 50, int $offset = 0, string $search = ''): array
{
    if ($search !== '') {
        $stmt = $db->prepare("
            SELECT * 
            FROM urls 
            WHERE original_url LIKE :search
               OR short_code LIKE :search
            ORDER BY id DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    } else {
        $stmt = $db->prepare("
            SELECT *
            FROM urls
            ORDER BY id DESC
            LIMIT :limit OFFSET :offset
        ");
    }

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}


/**
 * Get total count (for pagination)
 */
function getUrlsCount(PDO $db, string $search = ''): int
{
    if ($search !== '') {
        $stmt = $db->prepare("
            SELECT COUNT(*) as total
            FROM urls
            WHERE original_url LIKE :search
               OR short_code LIKE :search
        ");
        $stmt->execute(['search' => "%$search%"]);
    } else {
        $stmt = $db->query("SELECT COUNT(*) as total FROM urls");
    }

    $row = $stmt->fetch();
    return (int)($row['total'] ?? 0);
}


/**
 * Update status (active/disabled)
 */
function updateUrlStatus(PDO $db, string $shortCode, string $status): bool
{
    $stmt = $db->prepare("
        UPDATE urls
        SET status = :status
        WHERE short_code = :short_code
    ");

    return $stmt->execute([
        'status' => $status,
        'short_code' => $shortCode
    ]);
}
