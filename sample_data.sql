-- Sample Categories
INSERT INTO categories (slug, status) VALUES ('politics', 'active'), ('sports', 'active'), ('nation', 'active');
INSERT INTO category_translations (category_id, language, title) VALUES 
(1, 'en', 'Politics'), (1, 'hi', 'राजनीति'),
(2, 'en', 'Sports'), (2, 'hi', 'खेल'),
(3, 'en', 'National'), (3, 'hi', 'राष्ट्रीय');

-- Sample News 1 (Hindi)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(3, 'breaking-news-city-update', 'news1.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'hi', 'शहर की ताजा खबरें: निधि शर्मा के साथ सीधी रिपोर्ट', 'आज की मुख्य खबरें और शहर की सभी बड़ी घटनाओं का विस्तृत विवरण। शहर में विकास कार्यों और सरकारी योजनाओं की जानकारी।');

-- Sample News 2 (Hindi - Video News)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at, is_video_news) VALUES 
(2, 'sports-update-video', 'news2.jpg', 1, 'published', NOW(), 1);
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'hi', 'खेल जगत की बड़ी खबर: देखें वीडियो रिपोर्ट', 'खेल जगत में मचे घमासान और आने वाले मैचों की पूरी जानकारी। यहाँ देखें विशेष वीडियो रिपोर्ट: https://www.youtube.com/watch?v=ScMzIvxBSi4');

-- Sample News 3 (English)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(1, 'politics-india-2026', 'news3.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'en', 'Indian Politics 2026: Major Shifts Expected', 'Political analysts predict significant shifts in the upcoming state elections based on recent survey data.');

-- Dummy Views
INSERT INTO news_views (news_id, view_date, view_count) VALUES (1, CURDATE(), 4500), (2, CURDATE(), 8200), (3, CURDATE(), 1200);
