-- =========================================================
-- GokulClicks Studio - Database Schema
-- Import this file in phpMyAdmin:
-- http://localhost/phpmyadmin  ->  Import  ->  choose this file
-- It will create the database "gc_studio" for you.
-- =========================================================
use gc_studio;

CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    category VARCHAR(80) NOT NULL,
    event_date DATE DEFAULT NULL,
    location VARCHAR(150) DEFAULT NULL,
    description TEXT,
    cover_image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS photos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    caption VARCHAR(200) DEFAULT NULL,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30) DEFAULT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



INSERT INTO events
(id, title, slug, category, event_date, location, description, cover_image)
VALUES
(1, 'Wedding', 'wedding', 'Wedding', '2026-02-14', 'Chennai',
'A joyful two-day wedding celebration full of colour, rituals and candid moments.',
''),

(2, 'Baby shoots', 'Birthday', 'Birthday', '2026-03-02', 'Tambaram',
'A pastel-themed first birthday shoot.',
''),

(3, 'Engagement', 'Engagement', 'Engagement', '2026-01-20', 'OMR, Chennai',
'Corporate event coverage — stage, awards and candid networking shots.',
''),

(5, 'Pre-Wedding', 'Pre-Wedding', 'Pre-Wedding', '2026-05-05', '',
'A breezy beachside pre-wedding shoot at sunset.',
''),

(6, 'Fashion Portfolio', 'Fashion Portfolio', 'Fashion', '2026-05-22', 'Studio',
'Editorial-style portfolio shoot for an upcoming fashion model.',
'');