USE news;
INSERT INTO ad_management (slot_name, target_page, ad_type, custom_code, is_active) VALUES 
('header_banner_1', 'all', 'custom_code', '<div style="width:100%; height:90px; background:#c90000; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:900; font-size:24px; border-radius:8px;">PREMIUM BANNER AD 1 (728x90)</div>', 1),
('header_banner_2', 'all', 'custom_code', '<div style="width:100%; height:90px; background:#002e5b; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:900; font-size:24px; border-radius:8px;">PREMIUM BANNER AD 2 (728x90)</div>', 1),
('header_banner_3', 'all', 'custom_code', '<div style="width:100%; height:90px; background:#ffb81c; color:#111; display:flex; align-items:center; justify-content:center; font-weight:900; font-size:24px; border-radius:8px;">PREMIUM BANNER AD 3 (728x90)</div>', 1),
('header_banner_4', 'all', 'custom_code', '<div style="width:100%; height:90px; background:#111111; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:900; font-size:24px; border-radius:8px;">PREMIUM BANNER AD 4 (728x90)</div>', 1),
('header_banner_5', 'all', 'custom_code', '<div style="width:100%; height:90px; background:#e6f3ff; color:#002e5b; display:flex; align-items:center; justify-content:center; font-weight:900; font-size:24px; border-radius:8px; border:2px dashed #002e5b;">PREMIUM BANNER AD 5 (728x90)</div>', 1)
ON DUPLICATE KEY UPDATE custom_code=VALUES(custom_code), is_active=1;
