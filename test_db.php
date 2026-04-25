<?php
try {
    $p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
    $q = $p->query("SELECT categories.id, category_translations.title FROM categories JOIN category_translations ON category_translations.category_id = categories.id WHERE language = 'hi'");
    print_r($q->fetchAll(PDO::FETCH_ASSOC));
} catch(Exception $e) {
    echo $e->getMessage();
}
