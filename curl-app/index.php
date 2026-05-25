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

$apiData = fetchJson('https://dummyjson.com/products?limit=3');
$products = $apiData['products'] ?? [];
$errorMessage = $apiData === null ? 'Unable to load products right now.' : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog Dashboard - cURL</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="page">
        <header class="hero">
            <p class="eyebrow">cURL Implementation</p>
            <h1>Product Catalog Dashboard</h1>
            <p class="subtitle">Browse products from the DummyJSON API in a responsive card layout.</p>
        </header>

        <?php if ($errorMessage !== null): ?>
            <div class="alert"><?php echo e($errorMessage); ?></div>
        <?php endif; ?>

        <?php if (!$products): ?>
            <div class="alert">No products available.</div>
        <?php else: ?>
            <section class="grid">
                <?php foreach ($products as $product): ?>
                    <?php
                        $id = (int) ($product['id'] ?? 0);
                        $title = $product['title'] ?? 'Untitled product';
                        $description = $product['description'] ?? '';
                        $shortDescription = strlen($description) > 90
                            ? substr($description, 0, 87) . '...'
                            : $description;
                        $price = $product['price'] ?? 0;
                        $rating = $product['rating'] ?? 0;
                        $thumbnail = $product['thumbnail'] ?? '';
                    ?>
                    <article class="card">
                        <a class="card-image-link" href="product.php?id=<?php echo $id; ?>">
                            <img src="<?php echo e($thumbnail); ?>" alt="<?php echo e($title); ?>" class="card-image">
                        </a>
                        <div class="card-body">
                            <a class="card-title" href="product.php?id=<?php echo $id; ?>"><?php echo e($title); ?></a>
                            <p class="card-description"><?php echo e($shortDescription); ?></p>
                            <div class="card-meta">
                                <span class="price">$<?php echo e(number_format((float) $price, 2)); ?></span>
                                <span class="rating">★ <?php echo e((string) $rating); ?></span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>
