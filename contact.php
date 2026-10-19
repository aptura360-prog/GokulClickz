<?php
require 'config.php';
$pageTitle = "Contact - $STUDIO_NAME";
$activePage = 'contact';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');
    

    if ($name === '' || $email === '' || $message === '') {
        $error = 'Please fill in your name, email and message.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $message]);
        $success = true;
    }
}

include 'includes/header.php';
?>

<section class="page-hero">
    <div class="wrap">
        <p class="eyebrow-free">Let's talk</p>
        <h1>Book your date with us</h1>
        <p class="hero-sub light">Fill in the form, WhatsApp us directly, or call — whichever is easiest for you.</p>
    </div>
</section>

<section class="contact-section">
    <div class="wrap contact-grid">
        <div class="contact-info">
            <h2>Reach us directly</h2>
            <a class="contact-line" href="tel:+91<?= $STUDIO_PHONE ?>">
                <span class="contact-icon">📞</span> <?= $STUDIO_PHONE_DISPLAY ?>
            </a>
            <a class="contact-line" href="mailto:<?= $STUDIO_EMAIL ?>">
                <span class="contact-icon">✉️</span> <?= $STUDIO_EMAIL ?>
            </a>
            <a class="contact-line" href="<?= $STUDIO_WHATSAPP ?>" target="_blank" rel="noopener">
                <span class="contact-icon">💬</span> Chat on WhatsApp
            </a>
          

            <div class="contact-note">
                <h3>Studio hours</h3>
                <p>Monday – Saturday, 10:00 AM – 7:00 PM<br>Sundays by appointment for shoots.</p>
            </div>
        </div>

        <form class="contact-form" method="post" novalidate>
            <?php if ($success): ?>
                <div class="form-alert success">Thanks! Your message has been sent — we'll get back to you shortly.</div>
            <?php elseif ($error): ?>
                <div class="form-alert error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <label>Your name
                <input type="text" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </label>
            <label>Email address
                <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </label>
            <label>Phone number
                <input type="tel" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
            </label>
            <label>Tell us about your event
                <textarea name="message" rows="5" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            </label>
            <button type="submit" class="btn btn-primary">Send message</button>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
