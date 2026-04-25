<?php
try {
    $p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
    $q = $p->query("SELECT categories.id, categories.slug, categories.sort_order, ct.title 
                    FROM categories 
                    JOIN category_translations ct ON ct.category_id = categories.id AND ct.language = 'hi' 
                    ORDER BY categories.sort_order ASC");
    print_r($q->fetchAll(PDO::FETCH_ASSOC));
} catch(Exception $e) {
    echo $e->getMessage();
}
