<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'news';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Visual Stories
    $stories = [
        ['City Lights: Night Life in 2026', 'night-life', 'story1.jpg', 'शहर की रातें: 2026 में आधुनिक जीवन', 'Exploring the vibrant neon streets of the future city.'],
        ['Green Revolution in Urban Spaces', 'green-urban', 'story2.jpg', 'शहरी क्षेत्रों में हरित क्रांति', 'How vertical gardens are changing our skyline.'],
        ['Tech Expo: The AI Breakthrough', 'tech-expo', 'story3.jpg', 'टेक एक्सपो: एआई की बड़ी उपलब्धि', 'A deep dive into the latest neural interface technology.'],
        ['Future Food: What We Will Eat', 'future-food', 'story4.jpg', 'भविष्य का भोजन: हम क्या खाएंगे', 'Lab-grown meat and sustainable farming at scale.'],
        ['Mars Colony: First 100 Days', 'mars-colony', 'story5.jpg', 'मंगल कॉलोनी: पहले 100 दिन', 'Live updates from the first human settlement on Mars.']
    ];
    foreach($stories as $s) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO visual_stories (title_en, title_hi, slug, image, content_en, content_hi, status) VALUES (?, ?, ?, ?, ?, ?, 'published')");
        $stmt->execute([$s[0], $s[3], $s[1], $s[2], $s[4], $s[3]]);
    }

    // 2. Video News
    $videos = [
        ['Global Climate Summit 2026', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'global-summit', 'vid1.jpg'],
        ['The Rise of Quantum Computing', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'quantum-rise', 'vid2.jpg'],
        ['SpaceX: Moon Mission Launch', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'spacex-moon', 'vid3.jpg'],
        ['Economic Shift: The Digital Rupee', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'digital-rupee', 'vid4.jpg'],
        ['Olympics 2026: Closing Ceremony', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'olympics-closing', 'vid5.jpg']
    ];
    foreach($videos as $v) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO video_news (title_en, title_hi, video_url, slug, thumbnail, status, author_name) VALUES (?, ?, ?, ?, ?, 'published', 'Editor')");
        $stmt->execute([$v[0], $v[0] . ' (हिन्दी)', $v[1], $v[2], $v[3]]);
    }

    // 3. Ad Management
    $ads = [
        ['HOMEPAGE_HERO_AD', 'image', 'banner_hero.jpg', 'https://google.com'],
        ['SIDEBAR_PREMIUM_SLOT', 'google_ads', NULL, NULL],
        ['ARTICLE_BOTTOM_BANNER', 'custom_code', NULL, NULL],
        ['CATEGORY_HEADER_ADS', 'image', 'banner_cat.jpg', 'https://example.com'],
        ['FOOTER_WIDGET_AD', 'image', 'footer_ad.jpg', 'https://shop.com']
    ];
    foreach($ads as $a) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO ad_management (slot_name, ad_type, image, link, custom_code, is_active) VALUES (?, ?, ?, ?, ?, 1)");
        $stmt->execute([$a[0], $a[1], $a[2], $a[3], ($a[1] == 'google_ads' ? '<!-- Google Ads Placeholder -->' : ($a[1] == 'custom_code' ? '<div class="custom-ad">Ad Sample</div>' : NULL))]);
    }

    // 4. Breaking Ticker
    $tickers = [
        ['Breaking: New Policy announced by the Central Bank.', 'ब्रेकिंग: केंद्रीय बैंक द्वारा नई नीति की घोषणा।'],
        ['Sensex touches record high of 85,000 points.', 'सेंसेक्स ने 85,000 अंकों का रिकॉर्ड स्तर छुआ।'],
        ['Heavy rainfall warning for the next 48 hours.', 'अगले 48 घंटों के लिए भारी बारिश की चेतावनी।'],
        ['Local city election results to be declared tonight.', 'स्थानीय शहर के चुनाव परिणाम आज रात घोषित किए जाएंगे।'],
        ['International space station records a rare cosmic event.', 'अंतर्राष्ट्रीय अंतरिक्ष स्टेशन ने एक दुर्लभ ब्रह्मांडीय घटना दर्ज की।']
    ];
    foreach($tickers as $t) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO breaking_ticker (content_en, content_hi, is_active) VALUES (?, ?, 1)");
        $stmt->execute($t);
    }

    // 5. Subscribers
    $subs = ['admin@citynews.com', 'user1@gmail.com', 'reader@yahoo.com', 'news.lover@outlook.com', 'editor@test.com'];
    foreach($subs as $email) {
        $stmt = $pdo->prepare("INSERT IGNORE INTO subscribers (email, status) VALUES (?, 'active')");
        $stmt->execute([$email]);
    }

    echo "Sample data seeded successfully across 5 modules.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
