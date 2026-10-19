<?php
require 'config.php';
$pageTitle = "About - $STUDIO_NAME";
$activePage = 'about';
include 'includes/header.php';
?>

<section class="page-hero">
    <div class="wrap">
        <p class="eyebrow-free">Our story</p>
        <h1>Behind the lens at GokulClicks</h1>
        <p class="hero-sub light">A Cheyyar -based photography studio built on one idea: real moments, well lit, well timed.</p>
    </div>
</section>

<section class="about-section">
    <div class="wrap about-grid">
        <img src="/gc_studio/assets/images/events/fashion/gokul.jpg" alt="GokulClicks Photography">
        <div class="about-copy">
            <h2>What we believe</h2>
            <p>GokulClicks Studio started with weekend wedding shoots and grew into a full-time studio covering weddings, birthdays, corporate events and portfolio shoots across Cheyyar. Every shoot is treated as its own story — we spend time understanding the day before we ever pick up a camera.</p>
            <p>We shoot in a documentary style first, and step in for posed portraits only where they add something the candid frame can't. The result is a gallery that feels like your day, not a template.</p>

            <div class="about-stats">
                <div>
                    <strong>150+</strong>
                    <span>Events covered</span>
                </div>
                <div>
                    <strong>30+</strong>
                    <span>Photo stories in our gallery</span>
                </div>
                <div>
                    <strong>5★</strong>
                    <span>Client rating</span>
                </div>
            </div>

            <a href="<?= $STUDIO_WHATSAPP ?>" target="_blank" rel="noopener" class="btn btn-primary">Talk to us about your event</a>
        </div>
    </div>
</section>

<section class="services">
    <div class="wrap">
        <h2>How we work</h2>
        <div class="service-grid">
            <div class="service-card">
                <span class="service-icon">1️⃣</span>
                <h3>Chat with us</h3>
                <p>Tell us the date, venue and what matters most about your event on WhatsApp or by phone.</p>
            </div>
            <div class="service-card">
                <span class="service-icon">2️⃣</span>
                <h3>We plan the shoot</h3>
                <p>We share a shot list and timeline so nothing important is missed on the day.</p>
            </div>
            <div class="service-card">
                <span class="service-icon">3️⃣</span>
                <h3>You get your gallery</h3>
                <p>Edited photos are delivered as an online gallery, organised exactly like the events on this site.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
