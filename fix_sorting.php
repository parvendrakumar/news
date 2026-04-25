<?php
try {
    $p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
    $p->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 1. First reset all 0s to a neutral high number (like 10)
    $p->exec("UPDATE categories SET sort_order = 10 WHERE sort_order = 0");
    
    // 2. Set Bijnor to 1 (Home is fixed at 0 implicitly)
    $p->exec("UPDATE categories SET sort_order = 1 WHERE slug = 'bijnor-news'");
    
    // 3. Set Rajya (State) to 2
    $p->exec("UPDATE categories SET sort_order = 2 WHERE slug = 'state'");
    
    // 4. Force clear cache
    array_map('unlink', glob('writable/cache/dynamic_nav_*'));
    
    echo "Database sorting updated and cache cleared.";
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
