<?php

declare(strict_types=1);

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function fetchJson(string $url): ?array
{
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $response = curl_exec($ch);
    $statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($response === false || $statusCode !== 200) {
        return null;
    }

    $data = json_decode($response, true);

    return is_array($data) ? $data : null;
}

$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$product = $productId > 0 ? fetchJson('https://dummyjson.com/products/' . $productId) : null;
$errorMessage = $productId <= 0 ? 'Missing product ID.' : ($product === null ? 'Unable to load product details.' : null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - cURL</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="page page-details">
        <a class="back-link" href="index.php">← Back to Products</a>

        <?php if ($errorMessage !== null): ?>
            <div class="alert"><?php echo e($errorMessage); ?></div>
        <?php else: ?>
            <article class="details-card">
                <img src="<?php echo e($product['thumbnail'] ?? ''); ?>" alt="<?php echo e($product['title'] ?? 'Product image'); ?>" class="details-image">
                <div class="details-content">
                    <h1><?php echo e($product['title'] ?? 'Untitled product'); ?></h1>
                    <p class="details-description"><?php echo e($product['description'] ?? ''); ?></p>
                    <div class="details-grid">
                        <div><span>Price</span><strong>$<?php echo e(number_format((float) ($product['price'] ?? 0), 2)); ?></strong></div>
                        <div><span>Discount</span><strong><?php echo e((string) ($product['discountPercentage'] ?? 0)); ?>%</strong></div>
                        <div><span>Rating</span><strong><?php echo e((string) ($product['rating'] ?? 0)); ?></strong></div>
                        <div><span>Stock</span><strong><?php echo e((string) ($product['stock'] ?? 0)); ?></strong></div>
                        <div><span>Brand</span><strong><?php echo e($product['brand'] ?? 'N/A'); ?></strong></div>
                        <div><span>Category</span><strong><?php echo e($product['category'] ?? 'N/A'); ?></strong></div>
                    </div>
                </div>
            </article>
        <?php endif; ?>
    </main>
</body>
</html>
