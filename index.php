<?php
require 'config.php';
$pageTitle = "$STUDIO_NAME - Photography in Cheyyar";
$activePage = 'home';

// Pull a few events to feature on the homepage
$stmt = $pdo->query("SELECT * FROM events ORDER BY event_date DESC LIMIT 3");
$featured = $stmt->fetchAll();

include 'includes/header.php';
?>

<section class="hero">
    <div class="wrap hero-inner">
        <div class="hero-copy">
            <p class="eyebrow-free">Photography studio, Cheyyar</p>
            <h1>We turn your <span class="hl">everyday moments</span> into frames worth keeping.</h1>
            <p class="hero-sub">Weddings, birthdays, maternity, corporate events and portfolio shoots — GokulClicks Studio has been behind the lens for families and brands across Tamilnadu.</p>
            <div class="hero-actions">
                <a href="gallery.php" class="btn btn-primary">See our work</a>
                <a href="<?= $STUDIO_WHATSAPP ?>" target="_blank" rel="noopener" class="btn btn-outline">Chat on WhatsApp</a>
            </div>
        </div>
       <div class="hero-collage">
    <img src="assets/images/download (18).jpg"
         alt="Sample portrait photograph">
</div>
    </div>
</section>

<section class="services">
    <div class="wrap">
        <h2>What we shoot</h2>
        <div class="service-grid">
            <div class="service-card">
                <span class="service-icon">💍</span>
                <h3>Weddings</h3>
                <p>Candid and traditional coverage across every ritual, from the engagement to the reception.</p>
            </div>
            <div class="service-card">
                <span class="service-icon">🎂</span>
                <h3>Birthdays</h3>
                <p>Themed setups, cake-smash sessions and family portraits for milestone birthdays.</p>
            </div>
            <div class="service-card">
                <span class="service-icon">🏢</span>
                <h3>Corporate Events</h3>
                <p>Conferences, product launches and award nights, delivered fast for same-day social posting.</p>
            </div>
            <div class="service-card">
                <span class="service-icon">🤰</span>
                <h3>Maternity &amp; Family</h3>
                <p>Gentle, studio-lit sessions that celebrate new chapters in your family's story.</p>
            </div>
            <div class="service-card">
                <span class="service-icon">🌅</span>
                <h3>Pre-Wedding</h3>
                <p>Outdoor and beach-side shoots designed around the story of how you met.</p>
            </div>
            <div class="service-card">
                <span class="service-icon">👗</span>
                <h3>Fashion &amp; Portfolio</h3>
                <p>Editorial-style shoots for models, actors and creators building a portfolio.</p>
            </div>
        </div>
    </div>
</section>


<section class="cta-band">
    <div class="wrap cta-band-inner">
        <h2>Have a date in mind?</h2>
        <p>Tell us about your event and we'll get back with a package that fits.</p>
        <a href="<?= $STUDIO_WHATSAPP ?>" target="_blank" rel="noopener" class="btn btn-light">Message us on WhatsApp</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
