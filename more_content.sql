-- Add more categories
INSERT INTO categories (slug, status) VALUES ('entertainment', 'active'), ('tech', 'active'), ('health', 'active');
INSERT INTO category_translations (category_id, language, title) VALUES 
(4, 'en', 'Entertainment'), (4, 'hi', 'मनोरंजन'),
(5, 'en', 'Technology'), (5, 'hi', 'तकनीक'),
(6, 'en', 'Health'), (6, 'hi', 'स्वास्थ्य');

-- News Item 4: Entertainment (Hindi)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(4, 'bollywood-update-2026', 'ent1.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'hi', 'क्रिकेटर और बॉलीवुड स्टार्स की बड़ी वेडिंग: क्या बोले सितारे?', 'मुंबई में हुई भव्य शादी में देश-विदेश के कई दिग्गज शामिल हुए। निधि शर्मा की विशेष रिपोर्ट देखें कि कैसे इस समारोह ने सोशल मीडिया पर तहलका मचा दिया।');

-- News Item 5: Tech (English)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(5, 'ai-revolution-india', 'tech1.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'en', 'AI-Driven News Platforms: The Future of Media in India', 'Artificial Intelligence is transforming how news is consumed in regional languages. City News is at the forefront of this digital revolution.');

-- News Item 6: Health (Hindi)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(6, 'health-tips-winter', 'health1.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'hi', 'सर्दी के मौसम में स्वस्थ रहने के 5 बेहतरीन उपाय', 'बदलते मौसम में अपनी सेहत का ख्याल कैसे रखें? देखिए स्वास्थ्य विशेषज्ञों की राय और अपनाएं ये सरल उपाय जो आपको रखेंगे तरोताजा।');

-- News Item 7: Politics (Hindi - Video)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at, is_video_news) VALUES 
(1, 'up-election-analysis', 'pol1.jpg', 1, 'published', NOW(), 1);
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'hi', 'उत्तर प्रदेश चुनाव विश्‍लेषण: कौन मारेगा बाजी?', 'राजनीतिक हलचलों के बीच देखिए सबसे भरोसेमंद चुनावी विश्‍लेषण। निधि शर्मा के साथ ग्राउंड रिपोर्ट और जनता का मूड। वीडियो लिंक: https://www.youtube.com/watch?v=FjIdW_M3_lU');

-- News Item 8: Nation (English)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(3, 'clean-energy-mission', 'nation1.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'en', 'India Achieves Renewable Energy Milestones', 'New wind and solar farms across the northern plains mark a significant step towards the 2030 green energy goals.');

-- News Item 9: Sports (Hindi)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at) VALUES 
(2, 'local-cricket-talent', 'sports2.jpg', 1, 'published', NOW());
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'hi', 'बिजनौर के युवा क्रिकेटर का चयन: राष्ट्रीय स्तर पर चमकेगा नाम', 'बिजनौर के छोटे से गांव से निकले इस खिलाड़ी ने दिखाया दम। अब रणजी ट्रॉफी में दिखेगा इनका जलवा।');

-- News Item 10: Tech (Hindi - Video)
INSERT INTO news (category_id, slug, image, author_id, status, publish_at, is_video_news) VALUES 
(5, 'smartphone-launch-2026', 'tech2.jpg', 1, 'published', NOW(), 1);
INSERT INTO news_translations (news_id, language, title, description) VALUES 
(LAST_INSERT_ID(), 'hi', 'नया स्मार्टफोन लॉन्च: क्या है इसमें खास? देखिए अनबॉक्सिंग', 'कम बजट में बेहतरीन कैमरा और धांसू बैटरी। यहाँ देखें पूरा रिव्‍यू: https://www.youtube.com/watch?v=lO-L0W8fW3c');

-- Dummy Views update for trending
INSERT INTO news_views (news_id, view_date, view_count) VALUES 
(4, CURDATE(), 3200), (5, CURDATE(), 1100), (6, CURDATE(), 5600), (7, CURDATE(), 9100), (8, CURDATE(), 2300);
