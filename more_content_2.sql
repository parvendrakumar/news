-- Batch 2: Even more content
-- Entertainment (English)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(4, 'hollywood-oscar-2026', 'ent2.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'en', 'Oscar 2026: Predictions and Favorites', 'The academy awards are just around the corner, and critics are buzzing about the top contenders in the best film category.');

-- Health (English)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(6, 'mental-health-awareness', 'health2.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'en', 'Prioritizing Mental Health in the Workplace', 'Employers are increasingly focusing on the well-being of their employees to foster a more productive and positive work environment.');

-- Politics (English)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(1, 'global-summit-delhi', 'pol2.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'en', 'Global Leaders Meet in Delhi for Climate Action', 'The upcoming summit will host representatives from over 50 nations to discuss sustainable development and energy transitions.');

-- Tech (Hindi)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(5, '5g-expansion-india', 'tech3.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'hi', 'भारत में 5G का विस्तार: अब गांवों में भी मिलेगी सुपरफास्ट स्पीड', 'दूरदराज के इलाकों में इंटरनेट की रफ्तार बढ़ाने के लिए सरकार की नई योजना। देखिए निधि शर्मा की रिपोर्ट।');

-- Nation (Hindi)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(3, 'railway-safety-update', 'nation2.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'hi', 'भारतीय रेलवे में सुरक्षा के लिए नया कवच सिस्टम तैनात', 'हादसों को रोकने के लिए रेलवे ने आधुनिक तकनीक का सहारा लिया है। यात्री सुरक्षा के लिए यह एक बड़ा कदम है।');

-- Add views for these too
INSERT INTO news_views (news_id, view_date, view_count) VALUES 
(11, CURDATE(), 2500), (12, CURDATE(), 4200), (13, CURDATE(), 1100), (14, CURDATE(), 800), (15, CURDATE(), 3400);
