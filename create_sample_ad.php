<?php
$p = new PDO('mysql:host=localhost;dbname=news', 'root', '');
// Check if it exists
$check = $p->query("SELECT id FROM ad_management WHERE slot_name = 'HOME_TOP_BANNER'");
if (!$check->fetch()) {
    $p->exec("INSERT INTO ad_management (slot_name, target_page, ad_type, custom_code, is_active) 
              VALUES ('HOME_TOP_BANNER', 'home', 'custom_code', '<div style=\"width:100%; height:90px; background:#f3f4f6; color:#9ca3af; display:flex; align-items:center; justify-content:center; font-weight:900; border:2px dashed #ddd; border-radius:12px;\">HOME TOP BANNER AD (728x90)</div>', 1)");
    echo "SAMPLE_AD_CREATED";
} else {
    echo "AD_ALREADY_EXISTS";
}
