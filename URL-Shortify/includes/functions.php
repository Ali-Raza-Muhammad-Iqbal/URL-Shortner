<?php
declare(strict_types=1);

/**
 * Validate URL format
 */
function validateUrl(string $url): bool
{
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}


/**
 * Base62 characters
 */
function base62Characters(): string
{
    return '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
}


/**
 * Convert integer ID to Base62 short code
 */
function encodeBase62(int $number): string
{
    $characters = base62Characters();
    $base = strlen($characters);
    $shortCode = '';

    if ($number === 0) {
        return $characters[0];
    }

    while ($number > 0) {
        $remainder = $number % $base;
        $shortCode = $characters[$remainder] . $shortCode;
        $number = intdiv($number, $base);
    }

    return $shortCode;
}


/**
 * Create short URL entry
 */
function createShortUrl(PDO $db, string $originalUrl): ?string
{
    if (!validateUrl($originalUrl)) {
        return null;
    }

    // Insert original URL first (short_code empty temporarily)
    $stmt = $db->prepare("INSERT INTO urls (original_url, short_code) VALUES (:original_url, '')");
    $stmt->execute(['original_url' => $originalUrl]);

    $id = (int)$db->lastInsertId();

    // Generate Base62 short code from ID
    $shortCode = encodeBase62($id);

    // Update record with short code
    $updateStmt = $db->prepare("UPDATE urls SET short_code = :short_code WHERE id = :id");
    $updateStmt->execute([
        'short_code' => $shortCode,
        'id' => $id
    ]);

    return $shortCode;
}


/**
 * Get original URL by short code
 */
function getOriginalUrl(PDO $db, string $shortCode): ?string
{
    $stmt = $db->prepare("
        SELECT original_url 
        FROM urls 
        WHERE short_code = :short_code 
        AND status = 'active'
        AND (expires_at IS NULL OR expires_at > NOW())
        LIMIT 1
    ");

    $stmt->execute(['short_code' => $shortCode]);
    $result = $stmt->fetch();

    return $result['original_url'] ?? null;
}


/**
 * Increase click count
 */
function incrementClickCount(PDO $db, string $shortCode): void
{
    $stmt = $db->prepare("
        UPDATE urls 
        SET click_count = click_count + 1 
        WHERE short_code = :short_code
    ");

    $stmt->execute(['short_code' => $shortCode]);
}
