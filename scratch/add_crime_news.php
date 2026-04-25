<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=news", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 1. Get Category ID for Crime
    $stmt = $pdo->prepare("SELECT id FROM categories WHERE slug = 'crime'");
    $stmt->execute();
    $catId = $stmt->fetchColumn();
    
    if (!$catId) {
        // Create it if missing
        $pdo->prepare("INSERT INTO categories (slug, status) VALUES ('crime', 'active')")->execute();
        $catId = $pdo->lastInsertId();
    }
    
    echo "Category ID: $catId\n";
    
    // 2. Add News Item
    $slug = 'cyber-crime-busted-2024';
    $stmt = $pdo->prepare("INSERT INTO news (slug, category_id, status, publish_at) VALUES (?, ?, 'published', NOW())");
    $stmt->execute([$slug, $catId]);
    $newsId = $pdo->lastInsertId();
    
    echo "News ID: $newsId\n";
    
    // 3. Add Translations
    $stmt = $pdo->prepare("INSERT INTO news_translations (news_id, language, title, description) VALUES (?, ?, ?, ?)");
    
    // Hindi
    $stmt->execute([$newsId, 'hi', 'बड़ी साइबर अपराध गिरोह का पर्दाफाश', 'पुलिस ने एक बड़े साइबर गिरोह को पकड़ा है जो लाखों की ठगी कर रहा था। <p>शहर की साइबर विंग ने एक बड़े गिरोह का पर्दाफाश किया है। इस गिरोह के तार देश के कई कोनों से जुड़े हुए हैं। पुलिस ने भारी मात्रा में मोबाइल और सिम कार्ड बरामद किए हैं।</p>']);
    
    // English
    $stmt->execute([$newsId, 'en', 'Major Cyber Crime Syndicate Busted', 'पुलिस ने एक बड़े साइबर गिरोह को पकड़ा है जो लाखों की ठगी कर रहा था। <p>The city\'s cyber wing has successfully dismantled a large syndicate. The gang had links across several states. Police have recovered numerous mobile devices and SIM cards used in the operation.</p>']);
    
    echo "Crime news added successfully.\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
