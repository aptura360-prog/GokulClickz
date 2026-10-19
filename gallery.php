<?php
require 'config.php';

$pageTitle = "Gallery - $STUDIO_NAME";
$activePage = 'gallery';

$cat = $_GET['cat'] ?? '';

if ($cat !== '') {
    $stmt = $pdo->prepare("
        SELECT *
        FROM events
        WHERE category = ?
        AND id IN (1, 2, 5, 6)
        ORDER BY id DESC
    ");
    $stmt->execute([$cat]);
} else {
    $stmt = $pdo->query("
        SELECT *
        FROM events
        WHERE id IN (1, 2, 5, 6)
        ORDER BY id DESC
    ");
}

$events = $stmt->fetchAll();

$categories = $pdo->query("
    SELECT DISTINCT category
    FROM events
    WHERE id IN (1, 2, 5, 6)
    ORDER BY category
")->fetchAll(PDO::FETCH_COLUMN);

$coverImages = [
    6 => '/gc_studio/assets/images/fashion.jpg',
    5 => '/gc_studio/assets/images/prewed.jpg',
    2 => '/gc_studio/assets/images/download.jpg',
    1 => '/gc_studio/assets/images/wedding.jpg'
];

include 'includes/header.php';
?>

<section class="page-hero">

    <div class="wrap">

        <p class="eyebrow-free">
            Our portfolio
        </p>

        <h1>
            Our Photography
        </h1>

        <p class="hero-sub light">
            Explore our photography portfolio.
        </p>

    </div>

</section>


<section class="gallery-section">

    <div class="wrap">

        <div class="filter-row">

            <a href="gallery.php"
               class="filter-chip <?= $cat === '' ? 'active' : '' ?>">
                All
            </a>

            <?php foreach ($categories as $c): ?>

                <a href="gallery.php?cat=<?= urlencode($c) ?>"
                   class="filter-chip <?= $cat === $c ? 'active' : '' ?>">

                    <?= htmlspecialchars($c) ?>

                </a>

            <?php endforeach; ?>

        </div>


        <?php if (count($events) === 0): ?>

            <p class="empty-state">
                No photos found in this category yet.
            </p>

        <?php else: ?>

            <div class="event-grid event-grid-full">

                <?php foreach ($events as $ev): ?>

                    <?php
                    $image = $coverImages[$ev['id']] ?? '';
                    ?>

                    <a href="event.php?slug=<?= urlencode($ev['slug']) ?>"
                       class="event-card">

                        <div class="event-card-img"
     style="background-image: url('<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>');">
</div>

                        <div class="event-card-body">

                            <span class="event-tag">
                                <?= htmlspecialchars($ev['category']) ?>
                            </span>

                            <h3>
                                <?= htmlspecialchars($ev['title']) ?>
                            </h3>

                        </div>

                    </a>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

</section>


<?php include 'includes/footer.php'; ?>