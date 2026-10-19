```php
<?php
require 'config.php';

$slug = $_GET['slug'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM events WHERE slug = ?");
$stmt->execute([$slug]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    http_response_code(404);
    $pageTitle = "Event not found - " . $STUDIO_NAME;
    include 'includes/header.php';
    ?>

    <section class="page-hero">
        <div class="wrap">
            <h1>Event not found</h1>
            <p class="hero-sub light">
                This event may have been removed.
                <a href="gallery.php">Back to gallery</a>
            </p>
        </div>
    </section>

    <?php
    include 'includes/footer.php';
    exit;
}

$pageTitle = $event['title'] . " - " . $STUDIO_NAME;
$activePage = 'gallery';

$eventFolders = [
    1 => 'wedding',
    2 => 'birthday',
    3 => 'engagement',
    5 => 'prewedding',
    6 => 'fashion'
];

$eventId = (int) $event['id'];
$folder = $eventFolders[$eventId] ?? '';
$photos = [];

if ($folder !== '') {
    $folderPath = __DIR__ . '/assets/images/events/' . $folder;
    $webFolder = '/gc_studio/assets/images/events/' . $folder;

    if (is_dir($folderPath)) {
        $files = scandir($folderPath);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'avif'], true)) {
                $photos[] = [
                    'name' => $file,
                    'url' => $webFolder . '/' . rawurlencode($file)
                ];
            }
        }
    }
}

usort($photos, function ($a, $b) {
    return strnatcasecmp($a['name'], $b['name']);
});

include 'includes/header.php';
?>

<section class="page-hero event-hero">
    <div class="wrap">
        <a href="gallery.php" class="back-link">
            &larr; Back to gallery
        </a>

        <span class="event-tag light">
            <?= htmlspecialchars($event['category'] ?? '', ENT_QUOTES, 'UTF-8') ?>
        </span>

        <h1>
            <?= htmlspecialchars($event['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>
        </h1>
    </div>
</section>

<section class="event-detail">
    <div class="wrap">

        <?php if (!empty($event['description'])): ?>
            <p class="event-description">
                <?= htmlspecialchars($event['description'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        <?php endif; ?>

        <?php if (count($photos) > 0): ?>

            <div class="photo-grid">
                <?php foreach ($photos as $index => $photo): ?>
                    <button
                        type="button"
                        class="photo-thumb"
                        data-index="<?= $index ?>"
                        data-full="<?= htmlspecialchars($photo['url'], ENT_QUOTES, 'UTF-8') ?>"
                        aria-label="Open photo <?= $index + 1 ?>"
                    >
                        <img
                            src="<?= htmlspecialchars($photo['url'], ENT_QUOTES, 'UTF-8') ?>"
                            alt="<?= htmlspecialchars($event['title'], ENT_QUOTES, 'UTF-8') ?>"
                            loading="lazy"
                        >
                    </button>
                <?php endforeach; ?>
            </div>

        <?php else: ?>

            <p class="empty-state">
                No photos have been added to this event yet.
            </p>

        <?php endif; ?>

    </div>
</section>

<div class="lightbox" id="lightbox" aria-hidden="true">

    <button
        type="button"
        class="lightbox-close"
        id="lightboxClose"
        aria-label="Close photo viewer"
    >&times;</button>

    <button
        type="button"
        class="lightbox-prev"
        id="lightboxPrev"
        aria-label="Previous photo"
    >&#10094;</button>

    <div class="lightbox-content">
        <img src="" alt="" id="lightboxImg" draggable="false">
        <p id="lightboxCaption"></p>
        <span id="lightboxCounter"></span>
    </div>

    <button
        type="button"
        class="lightbox-next"
        id="lightboxNext"
        aria-label="Next photo"
    >&#10095;</button>

</div>

<style>
.lightbox {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 999999;
    width: 100%;
    height: 100%;
    background: rgba(10, 7, 15, 0.97);
    align-items: center;
    justify-content: center;
    padding: 60px 65px;
    box-sizing: border-box;
    touch-action: pan-y;
}

.lightbox.active {
    display: flex;
}

.lightbox-content {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-width: 0;
    min-height: 0;
}

.lightbox-content img {
    display: block;
    max-width: 100%;
    max-height: 80vh;
    width: auto;
    height: auto;
    object-fit: contain;
    user-select: none;
    -webkit-user-drag: none;
    touch-action: pan-y;
}

#lightboxCaption {
    display: none;
}

#lightboxCounter {
    display: block;
    margin-top: 12px;
    color: #fff;
    font-size: 14px;
    text-align: center;
}

.lightbox-close,
.lightbox-prev,
.lightbox-next {
    position: absolute;
    z-index: 2;
    border: none;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.15);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s ease;
    -webkit-tap-highlight-color: transparent;
}

.lightbox-close:hover,
.lightbox-prev:hover,
.lightbox-next:hover {
    background: rgba(255, 255, 255, 0.3);
}

.lightbox-close {
    top: 18px;
    right: 20px;
    font-size: 32px;
}

.lightbox-prev {
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 22px;
}

.lightbox-next {
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 22px;
}

@media (max-width: 