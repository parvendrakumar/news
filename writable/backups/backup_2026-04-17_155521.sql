-- City News Database Backup
-- Generated: 2026-04-17 15:55:21

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES ('1', '1', 'PUBLISH_NEWS', 'Published article: Breaking News Ticker Launched', '127.0.0.1', '2026-04-14 06:47:27');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES ('2', '1', 'UPDATE_STORY', 'Updated visual story: City Lights 2026', '127.0.0.1', '2026-04-14 06:47:27');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES ('3', '1', 'DELETE_SUBSCRIBER', 'Removed invalid email: test@spam.com', '127.0.0.1', '2026-04-14 06:47:27');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES ('4', '1', 'CREATE_AD', 'Initialized slot: HOMEPAGE_TOP_BANNER', '127.0.0.1', '2026-04-14 06:47:27');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES ('5', '1', 'PUBLISH_VIDEO', 'Published video: SpaceX Moon Mission', '127.0.0.1', '2026-04-14 06:47:27');
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `details`, `ip_address`, `created_at`) VALUES ('6', '2', 'DB_BACKUP', 'Generated backup file: backup_2026-04-15_050142.sql', '192.168.20.26', '2026-04-15 05:01:42');


DROP TABLE IF EXISTS `ad_management`;
CREATE TABLE `ad_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slot_name` varchar(100) NOT NULL,
  `target_page` varchar(50) DEFAULT 'all',
  `ad_type` enum('image','google_ads','custom_code') DEFAULT 'image',
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `custom_code` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slot_name` (`slot_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `ad_management` (`id`, `slot_name`, `target_page`, `ad_type`, `image`, `link`, `custom_code`, `is_active`, `updated_at`) VALUES ('1', 'HOMEPAGE_HERO_AD', 'all', 'image', '1776344250_47d1324c4ae1735e1528.png', 'https://google.com', '', '1', '2026-04-16 18:27:30');
INSERT INTO `ad_management` (`id`, `slot_name`, `target_page`, `ad_type`, `image`, `link`, `custom_code`, `is_active`, `updated_at`) VALUES ('2', 'SIDEBAR_PREMIUM_SLOT', 'all', 'google_ads', NULL, NULL, '<!-- Google Ads Placeholder -->', '1', '2026-04-14 06:41:05');
INSERT INTO `ad_management` (`id`, `slot_name`, `target_page`, `ad_type`, `image`, `link`, `custom_code`, `is_active`, `updated_at`) VALUES ('3', 'ARTICLE_BOTTOM_BANNER', 'all', 'custom_code', NULL, NULL, '<div class=\"custom-ad\">Ad Sample</div>', '1', '2026-04-14 06:41:05');
INSERT INTO `ad_management` (`id`, `slot_name`, `target_page`, `ad_type`, `image`, `link`, `custom_code`, `is_active`, `updated_at`) VALUES ('4', 'CATEGORY_HEADER_ADS', 'all', 'image', 'banner_cat.jpg', 'https://example.com', NULL, '1', '2026-04-14 06:41:05');
INSERT INTO `ad_management` (`id`, `slot_name`, `target_page`, `ad_type`, `image`, `link`, `custom_code`, `is_active`, `updated_at`) VALUES ('5', 'FOOTER_WIDGET_AD', 'all', 'image', 'footer_ad.jpg', 'https://shop.com', NULL, '1', '2026-04-14 06:41:05');
INSERT INTO `ad_management` (`id`, `slot_name`, `target_page`, `ad_type`, `image`, `link`, `custom_code`, `is_active`, `updated_at`) VALUES ('6', 'HOME_TOP_BANNER', 'home', 'image', '1776344293_a11081627fdf4f99d1da.jpeg', '', '<div style=\"width:100%; height:90px; background:#f3f4f6; color:#9ca3af; display:flex; align-items:center; justify-content:center; font-weight:900; border:2px dashed #ddd; border-radius:12px;\">HOME TOP BANNER AD (728x90)</div>', '0', '2026-04-16 18:28:57');


DROP TABLE IF EXISTS `blocked_ips`;
CREATE TABLE `blocked_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `blocked_until` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE `bookmarks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `news_id` int(11) unsigned NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_news` (`user_id`,`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `breaking_ticker`;
CREATE TABLE `breaking_ticker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_hi` text NOT NULL,
  `content_en` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `breaking_ticker` (`id`, `content_hi`, `content_en`, `link`, `is_active`, `created_at`) VALUES ('1', 'ब्रेकिंग: केंद्रीय बैंक द्वारा नई नीति की घोषणा।', 'Breaking: New Policy announced by the Central Bank.', NULL, '1', '2026-04-14 06:41:05');
INSERT INTO `breaking_ticker` (`id`, `content_hi`, `content_en`, `link`, `is_active`, `created_at`) VALUES ('2', 'सेंसेक्स ने 85,000 अंकों का रिकॉर्ड स्तर छुआ।', 'Sensex touches record high of 85,000 points.', NULL, '1', '2026-04-14 06:41:05');
INSERT INTO `breaking_ticker` (`id`, `content_hi`, `content_en`, `link`, `is_active`, `created_at`) VALUES ('3', 'अगले 48 घंटों के लिए भारी बारिश की चेतावनी।', 'Heavy rainfall warning for the next 48 hours.', NULL, '1', '2026-04-14 06:41:05');
INSERT INTO `breaking_ticker` (`id`, `content_hi`, `content_en`, `link`, `is_active`, `created_at`) VALUES ('4', 'स्थानीय शहर के चुनाव परिणाम आज रात घोषित किए जाएंगे।', 'Local city election results to be declared tonight.', NULL, '1', '2026-04-14 06:41:05');
INSERT INTO `breaking_ticker` (`id`, `content_hi`, `content_en`, `link`, `is_active`, `created_at`) VALUES ('5', 'अंतर्राष्ट्रीय अंतरिक्ष स्टेशन ने एक दुर्लभ ब्रह्मांडीय घटना दर्ज की।', 'International space station records a rare cosmic event.', NULL, '1', '2026-04-14 06:41:05');


DROP TABLE IF EXISTS `broadcast_templates`;
CREATE TABLE `broadcast_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` enum('email','sms','whatsapp','telegram') NOT NULL,
  `template_name` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `placeholders` varchar(255) DEFAULT '{title}, {url}, {summary}, {category}',
  `is_active` tinyint(1) DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `broadcast_templates` (`id`, `module`, `template_name`, `subject`, `content`, `placeholders`, `is_active`, `updated_at`) VALUES ('1', 'email', 'News Broadcast', 'Breaking News: {title}', '<h3>{title}</h3><p>{summary}</p><a href=\"{url}\">Read Full Story</a>', '{title}, {url}, {summary}', '1', '2026-04-14 07:08:46');
INSERT INTO `broadcast_templates` (`id`, `module`, `template_name`, `subject`, `content`, `placeholders`, `is_active`, `updated_at`) VALUES ('2', 'sms', 'News Flash', NULL, 'Breaking: {title} - Read more at {url}', '{title}, {url}', '1', '2026-04-14 07:08:46');
INSERT INTO `broadcast_templates` (`id`, `module`, `template_name`, `subject`, `content`, `placeholders`, `is_active`, `updated_at`) VALUES ('3', 'whatsapp', 'Direct Bulletin', NULL, '🚀 *{title}*\\n\\n{summary}\\n\\n🔗 Read More: {url}', '{title}, {url}, {summary}', '1', '2026-04-14 07:08:46');
INSERT INTO `broadcast_templates` (`id`, `module`, `template_name`, `subject`, `content`, `placeholders`, `is_active`, `updated_at`) VALUES ('4', 'telegram', 'Channel Update', NULL, '🔥 *{title}*\\n\\n{summary}\\n\\n👉 [Read Full Story]({url})', '{title}, {url}, {summary}', '1', '2026-04-14 07:08:46');
INSERT INTO `broadcast_templates` (`id`, `module`, `template_name`, `subject`, `content`, `placeholders`, `is_active`, `updated_at`) VALUES ('5', 'email', 'OTP Verification', 'Your Secure Login Code - {otp}', '\n    <div style=\"font-family: \'Outfit\', Helvetica, Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f9fafb; border-radius: 24px; overflow: hidden; border: 1px solid #e5e7eb;\">\n        <div style=\"background-color: #ffffff; padding: 30px; text-align: center; border-bottom: 2px solid #f3f4f6;\">\n            <img src=\"{logo}\" alt=\"City News Logo\" style=\"height: 60px; width: auto;\">\n        </div>\n        <div style=\"background-color: #dc2626; padding: 20px; text-align: center;\">\n            <p style=\"color: rgba(255,255,255,0.8); margin: 0; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 2px;\">Secure Authentication</p>\n        </div>\n        <div style=\"padding: 40px; background-color: white;\">\n            <h2 style=\"color: #111827; margin-top: 0; font-size: 22px; font-weight: 700;\">Security Verification</h2>\n            <p style=\"color: #4b5550; line-height: 1.6; font-size: 16px;\">Hello,<br>We received a request to access your account. Please use the verification code below to complete your login:</p>\n            \n            <div style=\"margin: 40px 0; text-align: center;\">\n                <div style=\"display: inline-block; background-color: #fef2f2; border: 2px dashed #f87171; padding: 20px 40px; border-radius: 16px;\">\n                    <span style=\"display: block; font-size: 12px; color: #ef4444; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;\">Your OTP Code</span>\n                    <span style=\"font-size: 48px; font-weight: 900; color: #111827; letter-spacing: 12px; font-family: monospace;\">{otp}</span>\n                </div>\n                <p style=\"color: #9ca3af; font-size: 13px; margin-top: 15px;\">This code is valid for <b>5 minutes</b>.</p>\n            </div>\n\n            <p style=\"color: #4b5563; line-height: 1.6; font-size: 14px;\">If you did not request this code, your account security might be at risk. Please contact support immediately.</p>\n        </div>\n        <div style=\"background-color: #111827; padding: 30px; text-align: center;\">\n            <p style=\"color: #9ca3af; font-size: 12px; margin: 0;\">&copy; 2026 City News Media Group. All rights reserved.</p>\n        </div>\n    </div>', '{otp}', '1', '2026-04-16 08:10:07');
INSERT INTO `broadcast_templates` (`id`, `module`, `template_name`, `subject`, `content`, `placeholders`, `is_active`, `updated_at`) VALUES ('6', 'email', 'Password Reset', 'Password Reset Request', '\n    <div style=\"font-family: \'Outfit\', Helvetica, Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f9fafb; border-radius: 24px; overflow: hidden; border: 1px solid #e5e7eb;\">\n        <div style=\"background-color: #ffffff; padding: 30px; text-align: center; border-bottom: 2px solid #f3f4f6;\">\n            <img src=\"{logo}\" alt=\"City News Logo\" style=\"height: 60px; width: auto;\">\n        </div>\n        <div style=\"background-color: #dc2626; padding: 20px; text-align: center;\">\n            <p style=\"color: rgba(255,255,255,0.8); margin: 0; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 2px;\">Password Recovery</p>\n        </div>\n        <div style=\"padding: 40px; background-color: white;\">\n            <h2 style=\"color: #111827; margin-top: 0; font-size: 22px; font-weight: 700;\">Reset Your Password</h2>\n            <p style=\"color: #4b5563; line-height: 1.6; font-size: 16px;\">Hello,<br>You recently requested to reset your password for your City News account. Click the button below to set a new password:</p>\n            \n            <div style=\"margin: 40px 0; text-align: center;\">\n                <a href=\"{link}\" style=\"display: inline-block; background-color: #dc2626; color: white; padding: 18px 40px; border-radius: 16px; font-weight: 800; text-decoration: none; font-size: 18px; box-shadow: 0 10px 15px -3px rgba(220, 38, 38, 0.3);\">Reset Password</a>\n                <p style=\"color: #9ca3af; font-size: 13px; margin-top: 25px;\">This link will expire in <b>60 minutes</b>.</p>\n            </div>\n\n            <p style=\"color: #4b5563; line-height: 1.6; font-size: 14px;\">If the button above doesn\'t work, copy and paste this URL into your browser:</p>\n            <p style=\"color: #dc2626; font-size: 12px; word-break: break-all; background: #fef2f2; padding: 10px; border-radius: 8px;\">{link}</p>\n        </div>\n        <div style=\"background-color: #111827; padding: 30px; text-align: center;\">\n            <p style=\"color: #9ca3af; font-size: 12px; margin: 0;\">&copy; 2026 City News Media Group. All rights reserved.</p>\n        </div>\n    </div>', '{link}', '1', '2026-04-16 08:10:07');


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `slug` varchar(150) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(200) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `parent_id` (`parent_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('1', '0', 'politics', '1776345811_1399d8d07771231e834c.jpg', '', '', 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('2', '0', 'sports', '1776345993_67b83529c5b6266c7ee8.jpg', '', '', 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('3', '0', 'nation', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('4', '0', 'entertainment', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('5', '0', 'tech', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('6', '0', 'health', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('7', '4', 'movies', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('8', '4', 'music', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('9', '2', 'cricket', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('10', '0', 'visual-stories', NULL, '', '', 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('11', '0', 'video', NULL, '', '', 'inactive');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('12', '0', 'state-news', NULL, '', '', 'inactive');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('13', '0', 'crime', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('14', '0', 'games', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('15', '0', 'lifestyle', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('16', '0', 'religion', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('17', '0', 'education', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('18', '0', 'business', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('19', '0', 'world', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('20', '0', 'science', NULL, NULL, NULL, 'active');
INSERT INTO `categories` (`id`, `parent_id`, `slug`, `image`, `meta_title`, `meta_description`, `status`) VALUES ('21', '0', 'auto', NULL, NULL, NULL, 'active');


DROP TABLE IF EXISTS `category_translations`;
CREATE TABLE `category_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `language` varchar(5) NOT NULL,
  `title` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `language` (`language`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('1', '1', 'en', 'Politics');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('2', '1', 'hi', 'राजनीति');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('3', '2', 'en', 'Sports');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('4', '2', 'hi', 'खेल');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('5', '3', 'en', 'National');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('6', '3', 'hi', 'राष्ट्रीय');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('7', '4', 'en', 'Entertainment');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('8', '4', 'hi', 'मनोरंजन');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('9', '5', 'en', 'Technology');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('10', '5', 'hi', 'तकनीक');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('11', '6', 'en', 'Health');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('12', '6', 'hi', 'स्वास्थ्य');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('13', '7', 'en', 'Movies');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('14', '7', 'hi', 'मूवी');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('15', '8', 'en', 'Music');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('16', '8', 'hi', 'गाना');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('17', '9', 'en', 'Cricket');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('18', '9', 'hi', 'क्रिकेट');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('19', '10', 'en', 'Visual Stories');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('20', '10', 'hi', 'विजुअल स्टोरीज');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('21', '11', 'en', 'Video');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('22', '11', 'hi', 'वीडियो');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('23', '12', 'en', 'State Wise News');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('24', '12', 'hi', 'राज्यवार खबरें');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('25', '13', 'en', 'Crime');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('26', '13', 'hi', 'क्राइम');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('27', '14', 'en', 'Games');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('28', '14', 'hi', 'गेम्स');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('29', '15', 'en', 'Lifestyle');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('30', '15', 'hi', 'लाइफस्टाइल');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('31', '16', 'en', 'Religion');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('32', '16', 'hi', 'धर्म-अध्यात्म');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('33', '17', 'en', 'Education');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('34', '17', 'hi', 'शिक्षा');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('35', '18', 'en', 'Business');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('36', '18', 'hi', 'बिजनेस');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('37', '19', 'en', 'World');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('38', '19', 'hi', 'दुनिया');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('39', '20', 'en', 'Science');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('40', '20', 'hi', 'विज्ञान');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('41', '21', 'en', 'Auto');
INSERT INTO `category_translations` (`id`, `category_id`, `language`, `title`) VALUES ('42', '21', 'hi', 'ऑटो');


DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`,`ip_address`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `comments` (`id`, `news_id`, `name`, `email`, `comment`, `status`, `created_at`) VALUES ('1', '49', 'parvendra kumar', 'pk8265850659@gmail.com', 'Leave a Comment', 'approved', '2026-04-13 23:33:45');


DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `email` varchar(180) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `global_modules`;
CREATE TABLE `global_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_key` varchar(50) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `is_enabled` tinyint(1) DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `module_key` (`module_key`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `global_modules` (`id`, `module_key`, `module_name`, `is_enabled`, `updated_at`) VALUES ('1', 'visual_stories', 'Visual Stories (9:16)', '1', '2026-04-14 07:12:09');
INSERT INTO `global_modules` (`id`, `module_key`, `module_name`, `is_enabled`, `updated_at`) VALUES ('2', 'video_news', 'Video News Library', '1', '2026-04-14 07:12:09');
INSERT INTO `global_modules` (`id`, `module_key`, `module_name`, `is_enabled`, `updated_at`) VALUES ('3', 'ad_manager', 'Ad Management Engine', '1', '2026-04-14 07:12:09');
INSERT INTO `global_modules` (`id`, `module_key`, `module_name`, `is_enabled`, `updated_at`) VALUES ('4', 'breaking_ticker', 'Breaking News Ticker', '1', '2026-04-14 07:12:09');
INSERT INTO `global_modules` (`id`, `module_key`, `module_name`, `is_enabled`, `updated_at`) VALUES ('5', 'polls', 'Polls & Surveys', '1', '2026-04-14 07:12:09');
INSERT INTO `global_modules` (`id`, `module_key`, `module_name`, `is_enabled`, `updated_at`) VALUES ('6', 'subscribers', 'Subscriber Management', '1', '2026-04-14 07:12:09');
INSERT INTO `global_modules` (`id`, `module_key`, `module_name`, `is_enabled`, `updated_at`) VALUES ('7', 'smtp', 'SMTP Email Gateway', '1', '2026-04-14 07:12:09');
INSERT INTO `global_modules` (`id`, `module_key`, `module_name`, `is_enabled`, `updated_at`) VALUES ('8', 'sms', 'SMS API Gateway', '1', '2026-04-14 07:12:09');
INSERT INTO `global_modules` (`id`, `module_key`, `module_name`, `is_enabled`, `updated_at`) VALUES ('9', 'whatsapp', 'WhatsApp Business API', '1', '2026-04-14 07:12:09');
INSERT INTO `global_modules` (`id`, `module_key`, `module_name`, `is_enabled`, `updated_at`) VALUES ('10', 'telegram', 'Telegram Bot API', '1', '2026-04-14 07:12:09');
INSERT INTO `global_modules` (`id`, `module_key`, `module_name`, `is_enabled`, `updated_at`) VALUES ('11', 'live_tv', 'Live TV Streaming', '1', '2026-04-14 07:21:58');


DROP TABLE IF EXISTS `live_streams`;
CREATE TABLE `live_streams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stream_title` varchar(255) NOT NULL,
  `stream_url` text NOT NULL,
  `provider` enum('youtube','facebook','other') DEFAULT 'youtube',
  `is_active` tinyint(1) DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `live_streams` (`id`, `stream_title`, `stream_url`, `provider`, `is_active`, `updated_at`) VALUES ('1', 'City News Live TV', 'https://www.youtube.com/embed/jfKfPfyJRdk?si=l-Hgx4HwNMQBWVek', 'youtube', '0', '2026-04-17 11:26:13');


DROP TABLE IF EXISTS `login_logs`;
CREATE TABLE `login_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `status` enum('success','failed') NOT NULL,
  `attempted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('1', NULL, 'test@test.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'failed', '2026-04-15 23:48:20');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('2', NULL, 'test@test.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'failed', '2026-04-15 23:49:42');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('3', NULL, 'test@example.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'failed', '2026-04-15 23:51:28');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('4', '2', 'admin@citynews.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-16 00:03:20');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('5', '2', 'Parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'failed', '2026-04-16 00:24:59');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('6', '2', 'parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-16 00:25:23');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('7', '2', 'parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-16 00:31:41');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('8', '2', 'Parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'failed', '2026-04-16 09:17:28');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('9', '2', 'parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'failed', '2026-04-16 09:17:43');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('10', '2', 'parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'failed', '2026-04-16 09:26:22');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('11', '2', 'parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'failed', '2026-04-16 09:30:21');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('12', '2', 'parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', 'success', '2026-04-16 09:33:13');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('13', '2', 'parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-16 09:39:32');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('14', '2', 'parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-16 09:39:57');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('15', '2', 'parvendra@xsinfosol.com', '192.168.20.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-16 18:22:21');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('16', '2', 'parvendra@xsinfosol.com', '192.168.20.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-16 18:51:11');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('17', '2', 'parvendra@xsinfosol.com', '192.168.20.67', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'failed', '2026-04-16 19:12:21');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('18', '2', 'parvendra@xsinfosol.com', '192.168.20.67', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'success', '2026-04-16 19:12:40');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('19', '2', 'parvendra@xsinfosol.com', '192.168.29.138', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'success', '2026-04-16 21:45:19');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('20', '2', 'parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-17 00:30:35');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('21', '2', 'parvendra@xsinfosol.com', '192.168.29.138', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'failed', '2026-04-17 00:32:24');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('22', '2', 'parvendra@xsinfosol.com', '192.168.29.138', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'success', '2026-04-17 00:32:41');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('23', '2', 'parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'failed', '2026-04-17 07:56:24');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('24', '2', 'parvendra@xsinfosol.com', '192.168.29.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-17 07:56:36');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('25', '4', 'pk8265850659@gmail.com', '192.168.29.138', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'success', '2026-04-17 09:25:13');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('26', '4', 'pk8265850659@gmail.com', '192.168.29.138', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-17 09:33:11');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('27', '4', 'pk8265850659@gmail.com', '192.168.20.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-17 10:12:14');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('28', '4', 'pk8265850659@gmail.com', '192.168.20.67', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'success', '2026-04-17 10:20:48');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('29', '4', 'pk8265850659@gmail.com', '192.168.20.67', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'success', '2026-04-17 14:44:38');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('30', '4', 'pk8265850659@gmail.com', '192.168.20.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'success', '2026-04-17 14:50:39');
INSERT INTO `login_logs` (`id`, `user_id`, `email`, `ip_address`, `user_agent`, `status`, `attempted_at`) VALUES ('31', '2', 'parvendra@xsinfosol.com', '192.168.20.67', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'success', '2026-04-17 15:46:58');


DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `author_id` int(11) NOT NULL,
  `custom_author` varchar(255) DEFAULT NULL,
  `status` enum('published','draft','scheduled') DEFAULT 'draft',
  `publish_at` timestamp NULL DEFAULT NULL,
  `is_video_news` tinyint(1) DEFAULT 0,
  `is_breaking` tinyint(1) DEFAULT 0,
  `video_url` varchar(255) DEFAULT NULL,
  `video_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`),
  KEY `publish_at` (`publish_at`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('1', '3', 'breaking-news-city-update', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 00:33:08', '0', '1', NULL, NULL, '2026-04-12 00:33:08', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('2', '2', 'sports-update-video', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 00:33:08', '1', '1', NULL, NULL, '2026-04-12 00:33:08', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('3', '1', 'politics-india-2026', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 00:33:08', '0', '1', NULL, NULL, '2026-04-12 00:33:08', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('4', '4', 'bollywood-update-2026', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:31', '0', '1', NULL, NULL, '2026-04-12 00:49:31', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('5', '5', 'ai-revolution-india', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:31', '0', '1', NULL, NULL, '2026-04-12 00:49:31', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('6', '6', 'health-tips-winter', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:31', '0', '0', NULL, NULL, '2026-04-12 00:49:31', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('7', '1', 'up-election-analysis', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:31', '1', '0', NULL, NULL, '2026-04-12 00:49:31', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('8', '3', 'clean-energy-mission', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:31', '0', '0', NULL, NULL, '2026-04-12 00:49:31', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('9', '2', 'local-cricket-talent', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:31', '0', '0', NULL, NULL, '2026-04-12 00:49:31', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('10', '5', 'smartphone-launch-2026', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:31', '1', '0', NULL, NULL, '2026-04-12 00:49:31', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('11', '4', 'hollywood-oscar-2026', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:45', '0', '0', NULL, NULL, '2026-04-12 00:49:45', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('12', '6', 'mental-health-awareness', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:45', '0', '0', NULL, NULL, '2026-04-12 00:49:45', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('13', '1', 'global-summit-delhi', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:45', '0', '0', NULL, NULL, '2026-04-12 00:49:45', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('14', '5', '5g-expansion-india', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:45', '0', '0', NULL, NULL, '2026-04-12 00:49:45', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('15', '3', 'railway-safety-update', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 00:49:45', '0', '0', NULL, NULL, '2026-04-12 00:49:45', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('16', '1', 'india-wins-world-cup', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 01:30:55', '0', '1', NULL, NULL, '2026-04-12 01:30:55', '2026-04-12 01:52:12');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('17', '1', 'new-metro-route', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 01:30:55', '0', '1', NULL, NULL, '2026-04-12 01:30:55', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('18', '1', 'gold-price-drop', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 01:30:55', '0', '1', NULL, NULL, '2026-04-12 01:30:55', '2026-04-12 01:52:12');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('19', '1', 'bollywood-movie-records', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 01:30:55', '0', '1', NULL, NULL, '2026-04-12 01:30:55', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('20', '1', 'heavy-rain-alert', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 01:30:55', '0', '1', NULL, NULL, '2026-04-12 01:30:55', '2026-04-12 01:52:12');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('21', '7', 'chandrayaan-4-preps', 'news2.png', '[]', '1', NULL, 'published', '2026-04-12 01:41:00', '0', '1', NULL, NULL, '2026-04-12 01:41:56', '2026-04-12 02:14:58');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('22', '8', 'new-ev-launch', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 01:41:56', '0', '0', NULL, NULL, '2026-04-12 01:41:56', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('23', '3', 'govt-job-notification', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 01:41:56', '0', '0', NULL, NULL, '2026-04-12 01:41:56', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('24', '9', 'forex-reserve-up', '1776099091_890859c841f7ab07992d.jpg', '[]', '1', NULL, 'published', '2026-04-12 01:41:00', '0', '0', NULL, NULL, '2026-04-12 01:41:56', '2026-04-13 16:51:31');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('25', '8', 'india-wins-asia-cup', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 01:41:56', '0', '0', NULL, NULL, '2026-04-12 01:41:56', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('26', '2', 'smartphone-price-slash', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 01:41:56', '0', '0', NULL, NULL, '2026-04-12 01:41:56', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('27', '9', 'new-startup-hub', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 01:41:56', '0', '0', NULL, NULL, '2026-04-12 01:41:56', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('28', '2', 'digital-india-next-phase', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 01:41:56', '0', '0', NULL, NULL, '2026-04-12 01:41:56', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('29', '4', 'health-facility-launch', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 01:41:56', '0', '0', NULL, NULL, '2026-04-12 01:41:56', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('30', '4', 'edu-policy-changes', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 01:41:56', '0', '0', NULL, NULL, '2026-04-12 01:41:56', '2026-04-12 01:54:20');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('31', '1', 'stock-market-record', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 07:57:40', '0', '0', NULL, NULL, '2026-04-12 07:57:40', '2026-04-12 07:57:40');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('32', '4', 'new-edu-rules', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 07:57:40', '0', '0', NULL, NULL, '2026-04-12 07:57:40', '2026-04-12 07:57:40');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('33', '9', 'water-metro-project', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 07:57:40', '0', '0', NULL, NULL, '2026-04-12 07:57:40', '2026-04-12 07:57:40');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('34', '4', 'festival-special-trains', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 07:57:40', '0', '0', NULL, NULL, '2026-04-12 07:57:40', '2026-04-12 07:57:40');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('35', '1', 'smart-health-card', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 07:57:40', '0', '0', NULL, NULL, '2026-04-12 07:57:40', '2026-04-12 07:57:40');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('36', '8', 'farmer-subsidy-scheme', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 07:57:40', '0', '0', NULL, NULL, '2026-04-12 07:57:40', '2026-04-12 07:57:40');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('37', '4', 'filmfare-winners-2026', 'news1.png', NULL, '1', NULL, 'published', '2026-04-12 07:57:40', '0', '0', NULL, NULL, '2026-04-12 07:57:40', '2026-04-12 07:57:40');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('38', '6', 'india-olympics-bid', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 07:57:40', '0', '0', NULL, NULL, '2026-04-12 07:57:40', '2026-04-12 07:57:40');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('39', '5', 'cyber-security-law', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 07:57:40', '0', '0', NULL, NULL, '2026-04-12 07:57:40', '2026-04-12 07:57:40');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('40', '6', 'space-tourism-launch', 'news2.png', NULL, '1', NULL, 'published', '2026-04-12 07:57:40', '0', '0', NULL, NULL, '2026-04-12 07:57:40', '2026-04-12 07:57:40');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('55', '10', 'visual-story-ai', 'default.jpg', NULL, '0', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-12 20:40:20', '2026-04-12 20:46:00');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('56', '11', 'video-news-smartphone', 'default.jpg', NULL, '0', NULL, 'published', '2026-04-12 10:00:00', '1', '0', NULL, NULL, '2026-04-12 20:40:20', '2026-04-12 20:46:00');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('57', '19', 'world-summit-2026', 'default.jpg', NULL, '0', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-12 20:40:20', '2026-04-12 20:46:00');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('58', '18', 'business-market-record', '1776157909_1234d1faf6a49f12097d.jpg', '[]', '0', NULL, NULL, NULL, '0', '0', NULL, NULL, '2026-04-12 20:40:20', '2026-04-14 09:13:00');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('59', '20', 'science-discovery', 'default.jpg', NULL, '0', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-12 20:40:20', '2026-04-12 20:46:00');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('60', '5', 'tech-ai-chip', 'default.jpg', NULL, '0', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-12 20:40:20', '2026-04-12 20:46:00');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('61', '10', 'summer-fashion-2026', '1776104255_5a848f7fe1d2f6dd8129.jpg', '[]', '1', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-13 21:09:41', '2026-04-13 18:17:35');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('62', '10', 'city-nightlife-guide', '1776104274_d67e38a0eadc50c30d61.jpg', '[]', '1', '', 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-13 21:09:41', '2026-04-13 18:17:54');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('63', '10', 'best-street-food-city', 'v3.jpg', NULL, '1', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-13 21:09:41', '2026-04-13 21:19:52');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('64', '10', 'future-tech-gadgets-2026', 'v4.jpg', NULL, '1', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-13 21:09:41', '2026-04-13 21:19:52');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('65', '10', 'hidden-travel-gems', 'v5.jpg', NULL, '1', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-13 21:09:41', '2026-04-13 21:19:52');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('66', '10', 'weekend-getaway-ideas', 'v6.jpg', NULL, '1', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-13 21:09:41', '2026-04-13 21:19:52');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('67', '10', 'yoga-for-beginners-tips', 'v7.jpg', NULL, '1', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-13 21:09:41', '2026-04-13 21:19:52');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('68', '10', 'pro-gaming-setup-2026', 'v8.jpg', NULL, '1', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-13 21:09:41', '2026-04-13 21:19:52');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('69', '10', 'quick-healthy-recipes', 'v9.jpg', NULL, '1', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-13 21:09:41', '2026-04-13 21:19:52');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('70', '10', 'space-exploration-milestones', 'v10.jpg', NULL, '1', NULL, 'published', '2026-04-12 10:00:00', '0', '0', NULL, NULL, '2026-04-13 21:09:41', '2026-04-13 21:19:52');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('71', '13', 'us-navy-begins-blockade-of-all-iranian-ports-and-coastal-areas', '1776132487_65d81251808bf5b76497.jpg', '[\"1776132487_2b873ac9fcbbee6bc5e2.jpg\"]', '2', '', 'published', '2026-04-14 02:05:00', '0', '1', NULL, NULL, '2026-04-14 02:08:07', '2026-04-14 02:08:07');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('72', '10', 'top-10-bijnor', NULL, NULL, '0', NULL, 'published', '2026-04-14 07:49:30', '0', '0', NULL, NULL, '2026-04-14 07:49:30', '2026-04-14 07:49:30');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('73', '10', 'indian-street-food', 'indian_street_food.png', NULL, '0', NULL, 'published', '2026-04-14 07:49:30', '0', '0', NULL, NULL, '2026-04-14 07:49:30', '2026-04-17 15:06:12');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('74', '10', 'digital-india-towns', NULL, NULL, '0', NULL, 'published', '2026-04-14 07:49:30', '0', '0', NULL, NULL, '2026-04-14 07:49:30', '2026-04-14 07:49:30');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('75', '10', 'monsoon-hill-stations', NULL, NULL, '0', NULL, 'published', '2026-04-14 07:49:30', '0', '0', NULL, NULL, '2026-04-14 07:49:30', '2026-04-14 07:49:30');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('76', '10', 'budget-tech-2026', NULL, NULL, '0', NULL, 'published', '2026-04-14 07:49:30', '0', '0', NULL, NULL, '2026-04-14 07:49:30', '2026-04-14 07:49:30');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('77', '10', 'fitness-tips-pro', NULL, NULL, '0', NULL, 'published', '2026-04-14 07:49:30', '0', '0', NULL, NULL, '2026-04-14 07:49:30', '2026-04-14 07:49:30');
INSERT INTO `news` (`id`, `category_id`, `slug`, `image`, `gallery`, `author_id`, `custom_author`, `status`, `publish_at`, `is_video_news`, `is_breaking`, `video_url`, `video_file`, `created_at`, `updated_at`) VALUES ('78', '3', 'nagina-youth-drowns-in-canal-in-kerala', '1776307659_d9a5943c42306b1e2af5.png', '[]', '2', '', 'published', '2026-04-16 08:16:00', '0', '1', '', NULL, '2026-04-16 02:47:01', '2026-04-16 02:47:39');


DROP TABLE IF EXISTS `news_tag`;
CREATE TABLE `news_tag` (
  `news_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`news_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `news_translations`;
CREATE TABLE `news_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `language` varchar(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `meta_title` varchar(200) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`),
  KEY `language` (`language`),
  FULLTEXT KEY `title` (`title`,`description`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('1', '1', 'hi', 'शहर की ताजा खबरें: निधि शर्मा के साथ सीधी रिपोर्ट', 'आज की मुख्य खबरें और शहर की सभी बड़ी घटनाओं का विस्तृत विवरण। शहर में विकास कार्यों और सरकारी योजनाओं की जानकारी।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('2', '2', 'hi', 'खेल जगत की बड़ी खबर: देखें वीडियो रिपोर्ट', 'खेल जगत में मचे घमासान और आने वाले मैचों की पूरी जानकारी। यहाँ देखें विशेष वीडियो रिपोर्ट: https://www.youtube.com/watch?v=ScMzIvxBSi4', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('3', '3', 'en', 'Indian Politics 2026: Major Shifts Expected', 'Political analysts predict significant shifts in the upcoming state elections based on recent survey data.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('4', '4', 'hi', 'क्रिकेटर और बॉलीवुड स्टार्स की बड़ी वेडिंग: क्या बोले सितारे?', 'मुंबई में हुई भव्य शादी में देश-विदेश के कई दिग्गज शामिल हुए। निधि शर्मा की विशेष रिपोर्ट देखें कि कैसे इस समारोह ने सोशल मीडिया पर तहलका मचा दिया।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('5', '5', 'en', 'AI-Driven News Platforms: The Future of Media in India', 'Artificial Intelligence is transforming how news is consumed in regional languages. City News is at the forefront of this digital revolution.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('6', '6', 'hi', 'सर्दी के मौसम में स्वस्थ रहने के 5 बेहतरीन उपाय', 'बदलते मौसम में अपनी सेहत का ख्याल कैसे रखें? देखिए स्वास्थ्य विशेषज्ञों की राय और अपनाएं ये सरल उपाय जो आपको रखेंगे तरोताजा।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('7', '7', 'hi', 'उत्तर प्रदेश चुनाव विश्‍लेषण: कौन मारेगा बाजी?', 'राजनीतिक हलचलों के बीच देखिए सबसे भरोसेमंद चुनावी विश्‍लेषण। निधि शर्मा के साथ ग्राउंड रिपोर्ट और जनता का मूड। वीडियो लिंक: https://www.youtube.com/watch?v=FjIdW_M3_lU', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('8', '8', 'en', 'India Achieves Renewable Energy Milestones', 'New wind and solar farms across the northern plains mark a significant step towards the 2030 green energy goals.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('9', '9', 'hi', 'बिजनौर के युवा क्रिकेटर का चयन: राष्ट्रीय स्तर पर चमकेगा नाम', 'बिजनौर के छोटे से गांव से निकले इस खिलाड़ी ने दिखाया दम। अब रणजी ट्रॉफी में दिखेगा इनका जलवा।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('10', '10', 'hi', 'नया स्मार्टफोन लॉन्च: क्या है इसमें खास? देखिए अनबॉक्सिंग', 'कम बजट में बेहतरीन कैमरा और धांसू बैटरी। यहाँ देखें पूरा रिव्‍यू: https://www.youtube.com/watch?v=lO-L0W8fW3c', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('11', '11', 'en', 'Oscar 2026: Predictions and Favorites', 'The academy awards are just around the corner, and critics are buzzing about the top contenders in the best film category.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('12', '12', 'en', 'Prioritizing Mental Health in the Workplace', 'Employers are increasingly focusing on the well-being of their employees to foster a more productive and positive work environment.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('13', '13', 'en', 'Global Leaders Meet in Delhi for Climate Action', 'The upcoming summit will host representatives from over 50 nations to discuss sustainable development and energy transitions.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('14', '14', 'hi', 'भारत में 5G का विस्तार: अब गांवों में भी मिलेगी सुपरफास्ट स्पीड', 'दूरदराज के इलाकों में इंटरनेट की रफ्तार बढ़ाने के लिए सरकार की नई योजना। देखिए निधि शर्मा की रिपोर्ट।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('15', '15', 'hi', 'भारतीय रेलवे में सुरक्षा के लिए नया कवच सिस्टम तैनात', 'हादसों को रोकने के लिए रेलवे ने आधुनिक तकनीक का सहारा लिया है। यात्री सुरक्षा के लिए यह एक बड़ा कदम है।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('16', '16', 'hi', 'भारत ने जीती क्रिकेट वर्ल्ड कप की ट्रॉफी!', 'भारत ने जीती क्रिकेट वर्ल्ड कप की ट्रॉफी!', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('17', '16', 'en', 'India wins Cricket World Cup Trophy!', 'India wins Cricket World Cup Trophy!', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('18', '17', 'hi', 'शहर में मेट्रो का नया रूट शुरू, लोगों में खुशी।', 'शहर में मेट्रो का नया रूट शुरू, लोगों में खुशी।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('19', '17', 'en', 'New Metro route started in city, locals happy.', 'New Metro route started in city, locals happy.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('20', '18', 'hi', 'सोने की कीमतों में भारी गिरावट, खरीदारी बढ़ी।', 'सोने की कीमतों में भारी गिरावट, खरीदारी बढ़ी।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('21', '18', 'en', 'Gold prices drop sharply, buying increases.', 'Gold prices drop sharply, buying increases.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('22', '19', 'hi', 'बॉलीवुड सुपरस्टार की नई फिल्म ने तोड़े सारे रिकॉर्ड।', 'बॉलीवुड सुपरस्टार की नई फिल्म ने तोड़े सारे रिकॉर्ड।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('23', '19', 'en', 'Bollywood superstar\'s new movie breaks all records.', 'Bollywood superstar\'s new movie breaks all records.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('24', '20', 'hi', 'मौसम विभाग की चेतावनी: भारी बारिश का अलर्ट।', 'मौसम विभाग की चेतावनी: भारी बारिश का अलर्ट।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('25', '20', 'en', 'Weather Alert: Heavy rain warnings issued.', 'Weather Alert: Heavy rain warnings issued.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('26', '21', 'hi', 'चंद्रयान-4 की तैयारी शुरू, इसरो का बड़ा धमाका।', 'चंद्रयान-4 की तैयारी शुरू, इसरो का बड़ा धमाका।', '', '', NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('27', '21', 'en', 'Chandrayaan-4 preparations begin, ISRO\'s big announcement.', 'Chandrayaan-4 preparations begin, ISRO\'s big announcement.', '', '', NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('28', '22', 'hi', 'नई इलेक्ट्रिक कार लॉन्च, सिंगल चार्ज में 500KM का सफर।', 'नई इलेक्ट्रिक कार लॉन्च, सिंगल चार्ज में 500KM का सफर।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('29', '22', 'en', 'New electric car launched, 500KM range on single charge.', 'New electric car launched, 500KM range on single charge.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('30', '23', 'hi', 'सरकारी नौकरियों में भर्ती का नया नोटिफिकेशन जारी।', 'सरकारी नौकरियों में भर्ती का नया नोटिफिकेशन जारी।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('31', '23', 'en', 'New notification issued for government job recruitment.', 'New notification issued for government job recruitment.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('32', '24', 'hi', ' भारत का विदेशी मुद्रा भंडार 728 अरब अमेरिकी डॉलर से अधिक के रिकॉर्ड उच्च स्तर पर पहुंच गया है।', '<pre>\r\nभारत का विदेशी मुद्रा भंडार 27 फरवरी को समाप्त हुए सप्ताह के दौरान 4.88 अरब अमेरिकी डॉलर से अधिक बढ़कर सर्वकालिक उच्च स्तर 728.49 अरब डॉलर पर पहुंच गया। भारतीय रिज़र्व बैंक के अनुसार, विदेशी मुद्रा भंडार के एक प्रमुख घटक, स्वर्ण भंडार का मूल्य 4.14 अरब अमेरिकी डॉलर से अधिक बढ़कर 131.63 अरब डॉलर हो गया। विदेशी मुद्रा परिसंपत्तियां (एफसीए), जो विदेशी मुद्रा भंडार का सबसे बड़ा घटक है, 561 मिलियन अमेरिकी डॉलर बढ़कर 573.12 अरब डॉलर से अधिक हो गईं। डॉलर के संदर्भ में व्यक्त की गई एफसीए में विदेशी मुद्रा भंडार में मौजूद यूरो, पाउंड और येन सहित गैर-अमेरिकी मुद्राओं के मूल्य में वृद्धि या कमी का प्रभाव शामिल है। इसी बीच, अंतर्राष्ट्रीय मुद्रा कोष में केंद्रीय बैंक की हिस्सेदारी भी 158 मिलियन डॉलर बढ़कर 4.87 अरब डॉलर हो गई। विशेष आहरण अधिकार (एसपीडी) का मूल्य 26 मिलियन डॉलर बढ़कर 18.86 अरब अमेरिकी डॉलर हो गया। विदेशी मुद्रा भंडार किसी देश के लिए अत्यंत महत्वपूर्ण होते हैं और उसकी आर्थिक स्थिति का स्पष्ट संकेत देते हैं। इसके अलावा, ये मुद्रा विनिमय दर को स्थिर बनाए रखने में भी महत्वपूर्ण भूमिका निभाते हैं।</pre>\r\n', '', '', '');
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('33', '24', 'en', 'India’s Forex reserves reach record high of over 728 billion USD', '<p>India&rsquo;s foreign exchange reserves surged by more than 4.88 billion US dollars (USD) to an all-time high of over 728.49 billion dollars during the week ended on February 27. According to the Reserve Bank of India, the value of gold reserves, a key component of foreign exchange reserves, increased by over 4.14 billion US dollars to 131.63 billion dollars. Foreign Currency Assets (FCA), the largest component of forex reserves, increased by 561 million US dollars to over 573.12 billion dollars. Expressed in dollar terms, the FCA includes the effect of appreciation or depreciation of non-US units, including the euro, pound, and yen held in the foreign exchange kitty. Meanwhile, the Central Bank&rsquo;s position in the International Monetary Fund also advanced by 158 million to 4.87 billion dollars. The value of Special Drawing Rights increased by 26 million dollars to 18.86 billion US dollars. Foreign exchange reserves are crucial for a country and provide a clear indication of its economic health. Furthermore, they play a significant role in maintaining a stable currency exchange rate</p>\r\n', '', '', '');
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('34', '25', 'hi', 'एशिया कप में भारत की शानदार जीत, फाइनल में जगह।', 'एशिया कप में भारत की शानदार जीत, फाइनल में जगह।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('35', '25', 'en', 'India\'s brilliant win in Asia Cup, secures place in final.', 'India\'s brilliant win in Asia Cup, secures place in final.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('36', '26', 'hi', 'स्मार्टफोन की कीमतों में कटौती, ग्राहकों के लिए खुशखबरी।', 'स्मार्टफोन की कीमतों में कटौती, ग्राहकों के लिए खुशखबरी।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('37', '26', 'en', 'Slash in smartphone prices, good news for customers.', 'Slash in smartphone prices, good news for customers.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('38', '27', 'hi', 'नया स्टार्टअप हब बनेगा यह शहर, युवाओं को मिलेगा मौका।', 'नया स्टार्टअप हब बनेगा यह शहर, युवाओं को मिलेगा मौका।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('39', '27', 'en', 'This city to become a new startup hub, opportunities for youth.', 'This city to become a new startup hub, opportunities for youth.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('40', '28', 'hi', 'डिजिटल इंडिया मिशन का अगला चरण शुरू।', 'डिजिटल इंडिया मिशन का अगला चरण शुरू।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('41', '28', 'en', 'Next phase of Digital India mission begins.', 'Next phase of Digital India mission begins.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('42', '29', 'hi', 'स्वास्थ्य केंद्र में नई सुविधाओं का उद्घाटन।', 'स्वास्थ्य केंद्र में नई सुविधाओं का उद्घाटन।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('43', '29', 'en', 'Inauguration of new facilities in health center.', 'Inauguration of new facilities in health center.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('44', '30', 'hi', 'शिक्षा नीति में बड़े बदलाव, छात्रों को मिलेगी राहत।', 'शिक्षा नीति में बड़े बदलाव, छात्रों को मिलेगी राहत।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('45', '30', 'en', 'Major changes in education policy, relief for students.', 'Major changes in education policy, relief for students.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('46', '31', 'hi', 'शेयर बाजार में रिकॉर्ड उछाल, निवेशकों की चांदी।', '<p>शेयर बाजार में रिकॉर्ड उछाल, निवेशकों की चांदी।</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('47', '31', 'en', 'Stock market hits record high, investors rejoice.', '<p>Stock market hits record high, investors rejoice.</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('48', '32', 'hi', 'नई शिक्षा नीति के तहत कॉलेजों में बदलेंगे नियम।', '<p>नई शिक्षा नीति के तहत कॉलेजों में बदलेंगे नियम।</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('49', '32', 'en', 'College rules to change under new education policy.', '<p>College rules to change under new education policy.</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('50', '33', 'hi', 'शहर में वाटर मेट्रो प्रोजेक्ट की शुरुआत जल्द।', '<p>शहर में वाटर मेट्रो प्रोजेक्ट की शुरुआत जल्द।</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('51', '33', 'en', 'Water Metro project to start soon in the city.', '<p>Water Metro project to start soon in the city.</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('52', '34', 'hi', 'त्योहारों पर स्पेशल ट्रेनों का ऐलान, यात्रियों को राहत।', '<p>त्योहारों पर स्पेशल ट्रेनों का ऐलान, यात्रियों को राहत।</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('53', '34', 'en', 'Special trains announced for festivals, relief for travelers.', '<p>Special trains announced for festivals, relief for travelers.</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('54', '35', 'hi', 'स्मार्ट हेल्थ कार्ड से मुफ्त इलाज की सुविधा शुरू।', '<p>स्मार्ट हेल्थ कार्ड से मुफ्त इलाज की सुविधा शुरू।</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('55', '35', 'en', 'Free treatment facility starts with Smart Health Card.', '<p>Free treatment facility starts with Smart Health Card.</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('56', '36', 'hi', 'किसानों के लिए नई सब्सिडी योजना की घोषणा।', '<p>किसानों के लिए नई सब्सिडी योजना की घोषणा।</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('57', '36', 'en', 'New subsidy scheme announced for farmers.', '<p>New subsidy scheme announced for farmers.</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('58', '37', 'hi', 'फिल्म फेयर अवार्ड्स: बेस्ट फिल्म का खिताब किसे मिला?', '<p>फिल्म फेयर अवार्ड्स: बेस्ट फिल्म का खिताब किसे मिला?</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('59', '37', 'en', 'Filmfare Awards: Who won the Best Movie title?', '<p>Filmfare Awards: Who won the Best Movie title?</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('60', '38', 'hi', 'विंटर ओलंपिक्स की मेजबानी के लिए भारत की दावेदारी।', '<p>विंटर ओलंपिक्स की मेजबानी के लिए भारत की दावेदारी।</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('61', '38', 'en', 'India bids to host the Winter Olympics.', '<p>India bids to host the Winter Olympics.</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('62', '39', 'hi', 'नया साइबर सुरक्षा कानून लागू, अब संभलकर रहे।', '<p>नया साइबर सुरक्षा कानून लागू, अब संभलकर रहे।</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('63', '39', 'en', 'New Cyber Security Law in effect, stay alert.', '<p>New Cyber Security Law in effect, stay alert.</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('64', '40', 'hi', 'अंतरिक्ष पर्यटन: अब आम लोग भी कर सकेंगे सैर।', '<p>अंतरिक्ष पर्यटन: अब आम लोग भी कर सकेंगे सैर।</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('65', '40', 'en', 'Space Tourism: Now common people can also travel to space.', '<p>Space Tourism: Now common people can also travel to space.</p>', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('94', '55', 'en', 'Visual Story: Future of AI', 'Description', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('95', '55', 'hi', 'विजुअल स्टोरी: एआई का भविष्य', '?????', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('96', '56', 'en', 'Video: New Smartphone Review', 'Description', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('97', '56', 'hi', 'वीडियो: नए स्मार्टफोन का रिव्‍यू', '?????', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('98', '57', 'en', 'World: Global Summit in Delhi', 'Description', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('99', '57', 'hi', 'दुनिया: दिल्ली में ग्लोबल समिट 2026', '?????', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('100', '58', 'en', 'Business: Stock Market Record High', '<p>Description</p>\r\n', '', '', '');
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('101', '58', 'hi', 'बिजनेस: शेयर बाजार ने बनाया नया रिकॉर्ड', '<p>बिजनेस: शेयर बाजार ने बनाया नया रिकॉर्ड</p>\r\n', '', '', '');
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('102', '59', 'en', 'Science: New Planet Discovery', 'Description', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('103', '59', 'hi', 'विज्ञान: नए ग्रह की खोज', '?????', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('104', '60', 'en', 'Tech: India Launch New AI Chip', 'Description', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('105', '60', 'hi', 'तकनीक: भारत ने लॉन्च किया नया एआई चिप', '?????', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('106', '61', 'hi', 'समर फैशन 2026: इस सीजन क्या है ट्रेंड में?', '<p>गर्मियों के लिए कुछ खास और आरामदायक फैशन टिप्स जो आपको देंगे कुल लुक।</p>\r\n', '', '', '');
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('107', '106', 'en', 'Summer Fashion 2026: Trends to Watch', 'Top fashion tips and trends to keep you cool and stylish this summer season.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('108', '62', 'hi', 'शहर की नाइटलाइफ: कहाँ जाएं और क्या देखें?', '<p>देर रात की मस्ती के लिए शहर के सबसे बेहतरीन स्पॉट्स की एक झलक।</p>\r\n', '', '', '');
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('109', '108', 'en', 'City Nightlife Guide: Best Spots', 'A guide to the most vibrant nightlife spots in the city for your next night out.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('110', '63', 'hi', 'चटपटा स्वाद: शहर का सबसे मशहूर स्ट्रीट फूड', 'अगर आप खाने के शौकीन हैं तो इन गलियों का स्वाद चखना न भूलें।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('111', '110', 'en', 'Taste of the Streets: Must-Try Food', 'Exploring the most iconic and delicious street food corners in the city.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('112', '64', 'hi', 'फ्यूचरिस्टिक गैजेट्स: 2026 की नई तकनीक', 'आर्टिफिशियल इंटेलिजेंस से लैस ये गैजेट्स बदल देंगे आपकी दुनिया।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('113', '112', 'en', 'Future Tech: Top Gadgets for 2026', 'A look at the most innovative and AI-powered gadgets launching this year.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('114', '65', 'hi', 'छिपे हुए नजारे: शहर के 5 अनसुने पर्यटन स्थल', 'भीड़भाड़ से दूर इन शांत जगहों पर बिताएं अपना वीकेंड।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('115', '114', 'en', 'Hidden Gems: 5 Secret Spots in the City', 'Escape the crowd and discover these peaceful and beautiful locations.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('116', '66', 'hi', 'वीकेंड गेटअवे: पास की शानदार जगहें', 'काम से ब्रेक लें और इन पास की खूबसूरत जगहों की सैर करें।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('117', '116', 'en', 'Weekend Getaway: Best Nearby Locations', 'The perfect guide for a short trip to refresh your mind after a long week.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('118', '67', 'hi', 'योग की शुरुआत: स्वस्थ जीवन के लिए आसान आसन', 'फि‍टनेस की ओर पहला कदम बढ़ाएं इन सरल योग आसनों के साथ।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('119', '118', 'en', 'Yoga for Beginners: Simple Steps to Fitness', 'Kickstart your health journey with these easy-to-follow yoga poses.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('120', '68', 'hi', 'प्रो गेमिंग सेटअप: ऐसा होना चाहिए आपका गेमिंग जोन', 'गेमप्ले को और भी रोमांचक बनाने के लिए बेस्ट सेटअप गाइड।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('121', '120', 'en', 'Pro Gaming: Building Your Dream Setup', 'Everything you need to create the ultimate gaming environment for pro-level play.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('122', '69', 'hi', 'हेल्दी रेसिपीज: 10 मिनट में तैयार होने वाला नाश्ता', 'बिजी मॉर्निंग में भी अपनी सेहत का रखें ख्याल इन झटपट रेसिपीज के साथ।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('123', '122', 'en', 'Quick Healthy Bites: 10-Minute Breakfast', 'Delicious and nutritious breakfast ideas that fit into your busy schedule.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('124', '70', 'hi', 'अंतरिक्ष की खोज: मानव जाति के नए कदम', 'इस साल के सबसे बड़े स्पेस मिशन और उनकी सफलता की कहानी।', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('125', '124', 'en', 'Space 2026: Mankind\'s New Frontier', 'Recapping this year\'s biggest space missions and the future of lunar exploration.', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('126', '71', 'hi', 'अमेरिकी नौसेना ने ईरान के सभी बंदरगाहों और तटीय क्षेत्रों की नाकाबंदी शुरू कर दी है।', '<pre>\r\nअमेरिकी नौसेना ने होर्मुज जलडमरूमध्य सहित सभी ईरानी बंदरगाहों और तटीय क्षेत्रों की नाकाबंदी शुरू कर दी है। अमेरिकी सेना ने आज शाम से ईरानी बंदरगाहों में प्रवेश करने और बाहर निकलने वाले जहाजों को रोक दिया है, हालांकि उसने स्पष्ट किया है कि होर्मुज जलडमरूमध्य से अन्य गंतव्यों की ओर जाने वाले जहाजों को नहीं रोका जाएगा। ईरान के इस्लामिक रिवोल्यूशनरी गार्ड कोर ने कहा है कि होर्मुज जलडमरूमध्य के पास आने वाले किसी भी सैन्य जहाज को युद्धविराम का उल्लंघन माना जाएगा। ईरानी सशस्त्र बलों की एकीकृत कमान ने अमेरिकी नौसैनिक नाकाबंदी के जवाब में कड़ी चेतावनी जारी करते हुए कहा है कि फारस की खाड़ी और ओमान की खाड़ी के बंदरगाहों की सुरक्षा सीधे खतरे में है।\r\n\r\nब्रिटेन के प्रधानमंत्री कीर स्टारमर ने होर्मुज जलडमरूमध्य की किसी भी अमेरिकी नेतृत्व वाली नाकाबंदी में ब्रिटिश भागीदारी से स्पष्ट रूप से इनकार किया है और दोहराया है कि लंदन ईरान के साथ किसी भी संघर्ष में नहीं घसीटा जाएगा। श्री स्टारमर ने सैन्य तनाव को बढ़ाए बिना महत्वपूर्ण समुद्री मार्गों को सुलभ बनाए रखने के लिए ब्रिटेन की प्रतिबद्धता पर जोर दिया। ईरान द्वारा फारस की खाड़ी और ओमान की खाड़ी में बंदरगाहों को धमकी देने के बाद उनकी ये टिप्पणियां आईं। अमेरिकी केंद्रीय कमान (CENTCOM) ने घोषणा की थी कि वह आज शाम से ईरानी बंदरगाहों में आने-जाने वाले समुद्री यातायात की नाकाबंदी शुरू कर देगा। यह नाकाबंदी अरब खाड़ी और ओमान की खाड़ी के बंदरगाहों सहित, ईरानी बंदरगाहों में आने-जाने वाले सभी देशों के जहाजों पर समान रूप से लागू होगी। श्री स्टारमर ने कहा कि ईरान और अमेरिका के बीच तनाव कम होने के बावजूद, ब्रिटेन होर्मुज जलडमरूमध्य को खुला रखने के उपायों पर सहयोगियों के साथ लगातार परामर्श कर रहा है। उन्होंने होर्मुज जलडमरूमध्य पर प्रतिबंधों के वैश्विक ऊर्जा बाजारों पर पड़ने वाले प्रभाव पर गहरी चिंता व्यक्त की।\r\n\r\nऑस्ट्रेलिया के प्रधानमंत्री एंथनी अल्बानीज़ ने भी खुली नौवहन व्यवस्था का समर्थन करते हुए इस बात पर जोर दिया कि कैनबरा को वाशिंगटन से इस रणनीतिक जलमार्ग की नाकाबंदी में शामिल होने का कोई अनुरोध प्राप्त नहीं हुआ है। श्री अल्बानीज़ ने क्षेत्रीय संघर्षों को सुलझाने के लिए नए सिरे से बातचीत के महत्व पर बल दिया और अंतरराष्ट्रीय समुद्री कानून का पूर्ण सम्मान करने का आह्वान किया।\r\n\r\nयूरोपीय संघ ने होर्मुज जलडमरूमध्य में तनाव के बीच आर्थिक और सुरक्षा खतरों की चेतावनी दी है। आज ब्रुसेल्स में एक प्रेस कॉन्फ्रेंस में बोलते हुए, यूरोपीय आयोग की अध्यक्ष उर्सुला वॉन डेर लेयेन ने इस बात पर जोर दिया कि जलडमरूमध्य का निरंतर बंद रहना गंभीर नुकसान पहुंचा रहा है और नौवहन की स्वतंत्रता को बहाल करना यूरोप के लिए अत्यंत महत्वपूर्ण है। उन्होंने कहा कि ईरान और अमेरिका के बीच वार्ता ठप हो गई है और अब यह निर्धारित करना आवश्यक है कि स्थिति किस दिशा में आगे बढ़ेगी।</pre>\r\n', 'अमेरिकी नौसेना ने ईरान के सभी बंदरगाहों और तटीय क्षेत्रों की नाकाबंदी शुरू कर दी है।', 'अमेरिकी नौसेना ने ईरान के सभी बंदरगाहों और तटीय क्षेत्रों की नाकाबंदी शुरू कर दी है।', 'अमेरिकी नौसेना ने होर्मुज जलडमरूमध्य सहित सभी ईरानी बंदरगाहों और तटीय क्षेत्रों की नाकाबंदी शुरू कर दी है। अमेरिकी सेना ने आज शाम से ईरानी बंदरगाहों में प्रवेश करने और बाहर निकलने वाले जहाजों को रोक दिया है, हालांकि उसने स्पष्ट किया है कि होर्मुज जलडमरूमध्य से अन्य गंतव्यों की ओर जाने वाले जहाजों को नहीं रोका जाएगा। ईरान के इस्लामिक रिवोल्यूशनरी गार्ड कोर ने कहा है कि होर्मुज जलडमरूमध्य के पास आने वाले किसी भी सैन्य जहाज को युद्धविराम का उल्लंघन माना जाएगा। ईरानी सशस्त्र बलों की एकीकृत कमान ने अमेरिकी नौसैनिक नाकाबंदी के जवाब में कड़ी चेतावनी जारी करते हुए कहा है कि फारस की खाड़ी और ओमान की खाड़ी के बंदरगाहों की सुरक्षा सीधे खतरे में है।\r\n\r\nब्रिटेन के प्रधानमंत्री कीर स्टारमर ने होर्मुज जलडमरूमध्य की किसी भी अमेरिकी नेतृत्व वाली नाकाबंदी में ब्रिटिश भागीदारी से स्पष्ट रूप से इनकार किया है और दोहराया है कि लंदन ईरान के साथ किसी भी संघर्ष में नहीं घसीटा जाएगा। श्री स्टारमर ने सैन्य तनाव को बढ़ाए बिना महत्वपूर्ण समुद्री मार्गों को सुलभ बनाए रखने के लिए ब्रिटेन की प्रतिबद्धता पर जोर दिया। ईरान द्वारा फारस की खाड़ी और ओमान की खाड़ी में बंदरगाहों को धमकी देने के बाद उनकी ये टिप्पणियां आईं। अमेरिकी केंद्रीय कमान (CENTCOM) ने घोषणा की थी कि वह आज शाम से ईरानी बंदरगाहों में आने-जाने वाले समुद्री यातायात की नाकाबंदी शुरू कर देगा। यह नाकाबंदी अरब खाड़ी और ओमान की खाड़ी के बंदरगाहों सहित, ईरानी बंदरगाहों में आने-जाने वाले सभी देशों के जहाजों पर समान रूप से लागू होगी। श्री स्टारमर ने कहा कि ईरान और अमेरिका के बीच तनाव कम होने के बावजूद, ब्रिटेन होर्मुज जलडमरूमध्य को खुला रखने के उपायों पर सहयोगियों के साथ लगातार परामर्श कर रहा है। उन्होंने होर्मुज जलडमरूमध्य पर प्रतिबंधों के वैश्विक ऊर्जा बाजारों पर पड़ने वाले प्रभाव पर गहरी चिंता व्यक्त की।\r\n\r\nऑस्ट्रेलिया के प्रधानमंत्री एंथनी अल्बानीज़ ने भी खुली नौवहन व्यवस्था का समर्थन करते हुए इस बात पर जोर दिया कि कैनबरा को वाशिंगटन से इस रणनीतिक जलमार्ग की नाकाबंदी में शामिल होने का कोई अनुरोध प्राप्त नहीं हुआ है। श्री अल्बानीज़ ने क्षेत्रीय संघर्षों को सुलझाने के लिए नए सिरे से बातचीत के महत्व पर बल दिया और अंतरराष्ट्रीय समुद्री कानून का पूर्ण सम्मान करने का आह्वान किया।\r\n\r\nयूरोपीय संघ ने होर्मुज जलडमरूमध्य में तनाव के बीच आर्थिक और सुरक्षा खतरों की चेतावनी दी है। आज ब्रुसेल्स में एक प्रेस कॉन्फ्रेंस में बोलते हुए, यूरोपीय आयोग की अध्यक्ष उर्सुला वॉन डेर लेयेन ने इस बात पर जोर दिया कि जलडमरूमध्य का निरंतर बंद रहना गंभीर नुकसान पहुंचा रहा है और नौवहन की स्वतंत्रता को बहाल करना यूरोप के लिए अत्यंत महत्वपूर्ण है। उन्होंने कहा कि ईरान और अमेरिका के बीच वार्ता ठप हो गई है और अब यह निर्धारित करना आवश्यक है कि स्थिति किस दिशा में आगे बढ़ेगी।');
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('127', '71', 'en', 'US Navy begins blockade of all Iranian ports and coastal areas ', '<p>The US Navy has begun its blockade of all Iranian ports and coastal areas, including the Strait of Hormuz. The US military blocked vessels entering and exiting Iranian ports from this evening, though it insisted ships transiting the Strait of Hormuz to other destinations will not be impeded. Iran&rsquo;s Islamic Revolutionary Guard Corps said any military vessel approaching the Strait of Hormuz will be treated as a ceasefire violation. The Unified Command of the Iranian Armed Forces issued a stark warning in response to the US naval blockade, declaring that the security of ports across the Persian Gulf and the Gulf of Oman is under direct threat.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>United Kingdom Prime Minister Keir Starmer has firmly ruled out British involvement in any US-led blockade of the Strait of Hormuz, reiterating that London will not be dragged into a conflict with Iran. Mr. Starmer emphaiszed the UK&rsquo;s commitment to keeping vital shipping lanes accessible without escalating military tensions. His remarks came as Iran threatened ports in the Persian Gulf and the Gulf of Oman after US Central Command (CENTCOM) announced that it would begin blockading maritime traffic entering and exiting Iranian ports this evening. The blockade will be applied impartially to vessels of all nations entering or departing Iranian ports, including those along the Arabian Gulf and Gulf of Oman. Mr. Starmer said that Britain has been consistently in consultation with allies on measures to keep the Strait of Hormuz open as tensions between Iran and the US ease. He expressed grave concern over the impact of restrictions on the Strait of Hormuz on global energy markets.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Australia&rsquo;s Prime Minister Anthony Albanese echoed the call for open navigation, emphasizing that Canberra has received no request from Washington to participate in the blockade of the strategic waterway. Mr. Albanese stressed the importance of renewed negotiations to resolve regional conflicts and called for full respect for international maritime law.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The European Union has warned of economic and security threats amid Strait of Hormuz tensions. Speaking at a press conference in Brussels today, European Commission President Ursula von der Leyen stressed that the ongoing closure of the Strait is causing serious damage and that restoring freedom of navigation is crucial for Europe. She noted that negotiations between Iran and the US have stalled and said it is now essential to determine how the situation will progress.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'US Navy begins blockade of all Iranian ports and coastal areas ', 'US Navy begins blockade of all Iranian ports and coastal areas ', 'The US Navy has begun its blockade of all Iranian ports and coastal areas, including the Strait of Hormuz. The US military blocked vessels entering and exiting Iranian ports from this evening, though it insisted ships transiting the Strait of Hormuz to other destinations will not be impeded. Iran’s Islamic Revolutionary Guard Corps said any military vessel approaching the Strait of Hormuz will be treated as a ceasefire violation. The Unified Command of the Iranian Armed Forces issued a stark warning in response to the US naval blockade, declaring that the security of ports across the Persian Gulf and the Gulf of Oman is under direct threat. \r\n \r\nUnited Kingdom Prime Minister Keir Starmer has firmly ruled out British involvement in any US-led blockade of the Strait of Hormuz, reiterating that London will not be dragged into a conflict with Iran. Mr. Starmer emphaiszed the UK’s commitment to keeping vital shipping lanes accessible without escalating military tensions. His remarks came as Iran threatened ports in the Persian Gulf and the Gulf of Oman after US Central Command (CENTCOM) announced that it would begin blockading maritime traffic entering and exiting Iranian ports this evening. The blockade will be applied impartially to vessels of all nations entering or departing Iranian ports, including those along the Arabian Gulf and Gulf of Oman. Mr. Starmer said that Britain has been consistently in consultation with allies on measures to keep the Strait of Hormuz open as tensions between Iran and the US ease. He expressed grave concern over the impact of restrictions on the Strait of Hormuz on global energy markets.\r\n \r\nAustralia’s Prime Minister Anthony Albanese echoed the call for open navigation, emphasizing that Canberra has received no request from Washington to participate in the blockade of the strategic waterway. Mr. Albanese stressed the importance of renewed negotiations to resolve regional conflicts and called for full respect for international maritime law. \r\n \r\nThe European Union has warned of economic and security threats amid Strait of Hormuz tensions. Speaking at a press conference in Brussels today, European Commission President Ursula von der Leyen stressed that the ongoing closure of the Strait is causing serious damage and that restoring freedom of navigation is crucial for Europe. She noted that negotiations between Iran and the US have stalled and said it is now essential to determine how the situation will progress.\r\n ');
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('128', '72', 'hi', 'Top 10 Places to Visit in Bijnor', 'High resolution story description for Top 10 Places to Visit in Bijnor', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('129', '72', 'en', 'Top 10 Places to Visit in Bijnor', 'High resolution story description for Top 10 Places to Visit in Bijnor', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('130', '73', 'hi', 'The Evolution of Street Food in India', 'High resolution story description for The Evolution of Street Food in India', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('131', '73', 'en', 'The Evolution of Street Food in India', 'High resolution story description for The Evolution of Street Food in India', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('132', '74', 'hi', 'Digital India: Transformation in Small Towns', 'High resolution story description for Digital India: Transformation in Small Towns', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('133', '74', 'en', 'Digital India: Transformation in Small Towns', 'High resolution story description for Digital India: Transformation in Small Towns', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('134', '75', 'hi', 'Monsoon Magic: Best Hill Stations', 'High resolution story description for Monsoon Magic: Best Hill Stations', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('135', '75', 'en', 'Monsoon Magic: Best Hill Stations', 'High resolution story description for Monsoon Magic: Best Hill Stations', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('136', '76', 'hi', 'Budget Friendly Tech Gadgets 2026', 'High resolution story description for Budget Friendly Tech Gadgets 2026', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('137', '76', 'en', 'Budget Friendly Tech Gadgets 2026', 'High resolution story description for Budget Friendly Tech Gadgets 2026', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('138', '77', 'hi', 'Fitness Tips for Busy Professionals', 'High resolution story description for Fitness Tips for Busy Professionals', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('139', '77', 'en', 'Fitness Tips for Busy Professionals', 'High resolution story description for Fitness Tips for Busy Professionals', NULL, NULL, NULL);
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('140', '78', 'hi', 'बिजनेस: शेयर बाजार ने बनाया नया रिकॉर्ड', '<p>बिजनेस: शेयर बाजार ने बनाया नया रिकॉर्ड</p>\r\n', 'Nagina youth drowns in canal in Kerala', 'Nagina youth drowns in canal in Kerala', 'Nagina youth drowns in canal in Kerala');
INSERT INTO `news_translations` (`id`, `news_id`, `language`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('141', '78', 'en', 'Nagina youth drowns in canal in Kerala', '<p>Nagina youth drowns in canal in Kerala</p>\r\n', 'Nagina youth drowns in canal in Kerala', 'Nagina youth drowns in canal in Kerala', 'Nagina youth drowns in canal in Kerala');


DROP TABLE IF EXISTS `news_videos`;
CREATE TABLE `news_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `video_id` varchar(50) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `news_views`;
CREATE TABLE `news_views` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `view_date` date NOT NULL,
  `view_count` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_date` (`news_id`,`view_date`),
  KEY `news_id` (`news_id`),
  KEY `view_date` (`view_date`)
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('1', '1', '2026-04-12', '4500');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('2', '2', '2026-04-12', '8200');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('3', '3', '2026-04-12', '1200');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('4', '4', '2026-04-12', '3200');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('5', '5', '2026-04-12', '1100');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('6', '6', '2026-04-12', '5600');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('7', '7', '2026-04-12', '9100');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('8', '8', '2026-04-12', '2300');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('9', '11', '2026-04-12', '2500');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('10', '12', '2026-04-12', '4200');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('11', '13', '2026-04-12', '1100');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('12', '14', '2026-04-12', '800');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('13', '15', '2026-04-12', '3400');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('14', '13', '2026-04-11', '3');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('17', '8', '2026-04-11', '1');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('18', '3', '2026-04-11', '1');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('19', '12', '2026-04-11', '1');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('20', '37', '2026-04-12', '1');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('21', '33', '2026-04-12', '1');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('22', '67', '2026-04-12', '1');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('23', '17', '2026-04-12', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('25', '68', '2026-04-12', '8');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('31', '69', '2026-04-12', '4');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('37', '72', '2026-04-12', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('39', '47', '2026-04-13', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('41', '100', '2026-04-13', '3');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('44', '104', '2026-04-13', '3');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('47', '94', '2026-04-13', '6');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('49', '49', '2026-04-13', '18');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('51', '3', '2026-04-13', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('53', '95', '2026-04-13', '4');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('57', '110', '2026-04-13', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('59', '97', '2026-04-13', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('61', '22', '2026-04-13', '1');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('62', '32', '2026-04-13', '38');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('72', '33', '2026-04-13', '18');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('110', '98', '2026-04-13', '14');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('114', '51', '2026-04-13', '16');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('116', '2', '2026-04-13', '8');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('124', '14', '2026-04-13', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('178', '95', '2026-04-14', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('180', '10', '2026-04-14', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('182', '96', '2026-04-14', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('184', '127', '2026-04-14', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('186', '94', '2026-04-14', '4');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('190', '100', '2026-04-14', '1');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('191', '6', '2026-04-15', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('193', '1', '2026-04-15', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('195', '24', '2026-04-15', '13');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('208', '129', '2026-04-15', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('210', '96', '2026-04-16', '1');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('211', '8', '2026-04-16', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('213', '108', '2026-04-16', '1');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('214', '7', '2026-04-16', '7');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('221', '59', '2026-04-16', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('223', '3', '2026-04-16', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('225', '4', '2026-04-16', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('227', '18', '2026-04-16', '4');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('231', '49', '2026-04-16', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('233', '1', '2026-04-17', '52');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('264', '127', '2026-04-17', '1');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('280', '47', '2026-04-17', '4');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('282', '141', '2026-04-17', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('286', '3', '2026-04-17', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('288', '13', '2026-04-17', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('290', '49', '2026-04-17', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('292', '129', '2026-04-17', '18');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('294', '131', '2026-04-17', '22');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('306', '139', '2026-04-17', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('308', '135', '2026-04-17', '2');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('336', '130', '2026-04-17', '4');
INSERT INTO `news_views` (`id`, `news_id`, `view_date`, `view_count`) VALUES ('344', '5', '2026-04-17', '2');


DROP TABLE IF EXISTS `page_translations`;
CREATE TABLE `page_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `language` varchar(5) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `page_translations` (`id`, `page_id`, `language`, `title`, `content`) VALUES ('1', '1', 'hi', 'हमारे बारे में', '<div class=\"about-hero mb-5\">\n    <p class=\"lead font-bold text-slate-800\" style=\"font-size: 1.25rem;\">City News is your premier destination for high-quality journalism, bringing you the pulse of India and the world with integrity and speed.</p>\n</div>\n\n<div class=\"row g-4 mb-5\">\n    <div class=\"col-md-6\">\n        <div class=\"p-4 bg-red-50 rounded-3xl border border-red-100\">\n            <h4 class=\"font-black text-red-600 uppercase tracking-widest text-sm mb-3\">Our Mission</h4>\n            <p class=\"text-slate-600 font-bold text-sm\">To empower every citizen with accurate, unbiased, and timely news. We believe that information is the bedrock of democracy, and we strive to provide a platform where every voice matters.</p>\n        </div>\n    </div>\n    <div class=\"col-md-6\">\n        <div class=\"p-4 bg-slate-50 rounded-3xl border border-slate-100\">\n            <h4 class=\"font-black text-slate-900 uppercase tracking-widest text-sm mb-3\">Our Vision</h4>\n            <p class=\"text-slate-600 font-bold text-sm\">To be the most trusted digital news ecosystem in India, leveraging cutting-edge technology to deliver immersive storytelling through videos, visual stories, and real-time updates.</p>\n        </div>\n    </div>\n</div>\n\n<h3 class=\"font-black text-slate-900 mb-4\">Why Choose City News?</h3>\n<ul class=\"space-y-4 mb-5 list-none p-0\">\n    <li class=\"d-flex align-items-start gap-3\">\n        <div class=\"h-6 w-6 rounded-full bg-green-100 text-green-600 d-flex align-items-center justify-content-center flex-shrink-0 mt-1\">\n            <i class=\"fas fa-check\" style=\"font-size: 10px;\"></i>\n        </div>\n        <div>\n            <strong class=\"text-slate-900\">Verified Journalism:</strong> \n            <span class=\"text-slate-600\">Our fact-checking team works around the clock to ensure every story is backed by solid evidence.</span>\n        </div>\n    </li>\n    <li class=\"d-flex align-items-start gap-3\">\n        <div class=\"h-6 w-6 rounded-full bg-green-100 text-green-600 d-flex align-items-center justify-content-center flex-shrink-0 mt-1\">\n            <i class=\"fas fa-check\" style=\"font-size: 10px;\"></i>\n        </div>\n        <div>\n            <strong class=\"text-slate-900\">Hyper-Local & Global:</strong> \n            <span class=\"text-slate-600\">From the smallest village issues to global geopolitics, we cover it all with equal depth.</span>\n        </div>\n    </li>\n    <li class=\"d-flex align-items-start gap-3\">\n        <div class=\"h-6 w-6 rounded-full bg-green-100 text-green-600 d-flex align-items-center justify-content-center flex-shrink-0 mt-1\">\n            <i class=\"fas fa-check\" style=\"font-size: 10px;\"></i>\n        </div>\n        <div>\n            <strong class=\"text-slate-900\">Modern Experience:</strong> \n            <span class=\"text-slate-600\">Experience news like never before with our Visual Stories and immersive video content.</span>\n        </div>\n    </li>\n</ul>\n\n<div class=\"p-5 bg-slate-900 rounded-[2.5rem] text-white text-center shadow-2xl overflow-hidden position-relative\">\n    <div style=\"position:absolute; top:-50px; right:-50px; width:150px; height:150px; background:rgba(220,38,38,0.2); border-radius:50%; filter:blur(40px);\"></div>\n    <h3 class=\"text-white font-black mb-3\">Join Our Community</h3>\n    <p class=\"text-slate-400 font-bold mb-4\">Subscribe to our newsletter and stay ahead of the curve with daily insights.</p>\n    <a href=\"/register\" class=\"btn btn-danger rounded-pill px-5 py-3 font-black text-sm uppercase tracking-widest\">Register Now</a>\n</div>');
INSERT INTO `page_translations` (`id`, `page_id`, `language`, `title`, `content`) VALUES ('2', '1', 'en', 'About Us', '<div class=\"about-hero mb-5\">\n    <p class=\"lead font-bold text-slate-800\" style=\"font-size: 1.25rem;\">City News is your premier destination for high-quality journalism, bringing you the pulse of India and the world with integrity and speed.</p>\n</div>\n\n<div class=\"row g-4 mb-5\">\n    <div class=\"col-md-6\">\n        <div class=\"p-4 bg-red-50 rounded-3xl border border-red-100\">\n            <h4 class=\"font-black text-red-600 uppercase tracking-widest text-sm mb-3\">Our Mission</h4>\n            <p class=\"text-slate-600 font-bold text-sm\">To empower every citizen with accurate, unbiased, and timely news. We believe that information is the bedrock of democracy, and we strive to provide a platform where every voice matters.</p>\n        </div>\n    </div>\n    <div class=\"col-md-6\">\n        <div class=\"p-4 bg-slate-50 rounded-3xl border border-slate-100\">\n            <h4 class=\"font-black text-slate-900 uppercase tracking-widest text-sm mb-3\">Our Vision</h4>\n            <p class=\"text-slate-600 font-bold text-sm\">To be the most trusted digital news ecosystem in India, leveraging cutting-edge technology to deliver immersive storytelling through videos, visual stories, and real-time updates.</p>\n        </div>\n    </div>\n</div>\n\n<h3 class=\"font-black text-slate-900 mb-4\">Why Choose City News?</h3>\n<ul class=\"space-y-4 mb-5 list-none p-0\">\n    <li class=\"d-flex align-items-start gap-3\">\n        <div class=\"h-6 w-6 rounded-full bg-green-100 text-green-600 d-flex align-items-center justify-content-center flex-shrink-0 mt-1\">\n            <i class=\"fas fa-check\" style=\"font-size: 10px;\"></i>\n        </div>\n        <div>\n            <strong class=\"text-slate-900\">Verified Journalism:</strong> \n            <span class=\"text-slate-600\">Our fact-checking team works around the clock to ensure every story is backed by solid evidence.</span>\n        </div>\n    </li>\n    <li class=\"d-flex align-items-start gap-3\">\n        <div class=\"h-6 w-6 rounded-full bg-green-100 text-green-600 d-flex align-items-center justify-content-center flex-shrink-0 mt-1\">\n            <i class=\"fas fa-check\" style=\"font-size: 10px;\"></i>\n        </div>\n        <div>\n            <strong class=\"text-slate-900\">Hyper-Local & Global:</strong> \n            <span class=\"text-slate-600\">From the smallest village issues to global geopolitics, we cover it all with equal depth.</span>\n        </div>\n    </li>\n    <li class=\"d-flex align-items-start gap-3\">\n        <div class=\"h-6 w-6 rounded-full bg-green-100 text-green-600 d-flex align-items-center justify-content-center flex-shrink-0 mt-1\">\n            <i class=\"fas fa-check\" style=\"font-size: 10px;\"></i>\n        </div>\n        <div>\n            <strong class=\"text-slate-900\">Modern Experience:</strong> \n            <span class=\"text-slate-600\">Experience news like never before with our Visual Stories and immersive video content.</span>\n        </div>\n    </li>\n</ul>\n\n<div class=\"p-5 bg-slate-900 rounded-[2.5rem] text-white text-center shadow-2xl overflow-hidden position-relative\">\n    <div style=\"position:absolute; top:-50px; right:-50px; width:150px; height:150px; background:rgba(220,38,38,0.2); border-radius:50%; filter:blur(40px);\"></div>\n    <h3 class=\"text-white font-black mb-3\">Join Our Community</h3>\n    <p class=\"text-slate-400 font-bold mb-4\">Subscribe to our newsletter and stay ahead of the curve with daily insights.</p>\n    <a href=\"/register\" class=\"btn btn-danger rounded-pill px-5 py-3 font-black text-sm uppercase tracking-widest\">Register Now</a>\n</div>');
INSERT INTO `page_translations` (`id`, `page_id`, `language`, `title`, `content`) VALUES ('3', '2', 'hi', 'संपर्क करें', '?? ???? citynewsnbd@gmail.com ?? ???? ?? ???? ???? ????? ???: ??????, ????? ???????');
INSERT INTO `page_translations` (`id`, `page_id`, `language`, `title`, `content`) VALUES ('4', '2', 'en', 'Contact Us', 'You can email us at citynewsnbd@gmail.com. Our address: Bijnor, Uttar Pradesh.');


DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(150) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pages` (`id`, `slug`, `status`, `created_at`) VALUES ('1', 'about-us', 'active', '2026-04-12 00:53:03');
INSERT INTO `pages` (`id`, `slug`, `status`, `created_at`) VALUES ('2', 'contact-us', 'active', '2026-04-12 00:53:03');


DROP TABLE IF EXISTS `poll_options`;
CREATE TABLE `poll_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `option_hi` varchar(255) NOT NULL,
  `option_en` varchar(255) DEFAULT NULL,
  `votes` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`),
  CONSTRAINT `poll_options_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `poll_options` (`id`, `poll_id`, `option_hi`, `option_en`, `votes`) VALUES ('1', '1', 'खेल (Sports)', 'Sports', '45');
INSERT INTO `poll_options` (`id`, `poll_id`, `option_hi`, `option_en`, `votes`) VALUES ('2', '1', 'राजनीति (Politics)', 'Politics', '120');
INSERT INTO `poll_options` (`id`, `poll_id`, `option_hi`, `option_en`, `votes`) VALUES ('3', '1', 'मनोरंजन (Entertainment)', 'Entertainment', '78');
INSERT INTO `poll_options` (`id`, `poll_id`, `option_hi`, `option_en`, `votes`) VALUES ('4', '1', 'प्रौद्योगिकी (Tech)', 'Technology', '34');


DROP TABLE IF EXISTS `polls`;
CREATE TABLE `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_hi` text NOT NULL,
  `question_en` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `polls` (`id`, `question_hi`, `question_en`, `is_active`, `created_at`) VALUES ('1', 'कौन सी समाचार श्रेणी आपको सबसे अधिक पसंद है?', 'Which news category do you prefer most?', '1', '2026-04-14 06:47:27');


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `permissions` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `roles` (`id`, `name`, `permissions`, `created_at`) VALUES ('1', 'Admin', '{\"all\": true}', '2026-04-12 00:30:54');
INSERT INTO `roles` (`id`, `name`, `permissions`, `created_at`) VALUES ('2', 'Editor', '{\"news\": [\"create\", \"edit\", \"publish\"]}', '2026-04-12 00:30:54');
INSERT INTO `roles` (`id`, `name`, `permissions`, `created_at`) VALUES ('3', 'Reporter', '{\"news\": [\"create\", \"edit\"]}', '2026-04-12 00:30:54');


DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`,`ip_address`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:03eba3e8f174d0a2814847e82d6f1f51', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420522;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:042139df494d4b3c32eca850e3306a56', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407036;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:0471c26f7ff3737f6462e09daea5c42b', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419679;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:05a5b870da1435e8d83cf02e5757ca3b', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776409336;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:0b26a53c06d523730e37117e105defbc', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408065;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:0b471de4c093b5bee15c53d330a7837d', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776421492;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:0ca97452f887e8e9784f0125272b35a9', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407399;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:0f27473e1cc978917239e365321beb2a', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420342;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:101c2302b72bb3a4b96a0c2b9264097d', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420402;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:10932296df2049a0e9865da3a6f7f77e', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776421250;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:17ced138c33b277aadfd98344713e5d5', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776421310;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:19debba70b65d0e1424b950491d57ed9', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420101;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:1c75322211c76ed71d2b46fa6fd9da81', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417451;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:1c7fe2e5e15eee8d4d9639b72a76185a', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417210;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:210f7b92b293ed5f43604ad2d9befc20', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408973;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:238cf0544dce177a823224c95cf0f23c', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419498;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:24f5b0eb0fa3fa121f86b56d79fe5192', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418776;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:2b99300b7019b0814ba473724302d671', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407278;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:304f9fa88e260ed02a3134de9ca35e26', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420582;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:306c078f93e4ca3aa1a6cd63e696ba84', '192.168.20.61', '4294967295', '__ci_last_regenerate|i:1776417639;_ci_previous_url|s:40:\"http://192.168.20.61:8080/user/dashboard\";userId|s:1:\"4\";username|s:4:\"User\";email|s:22:\"pk8265850659@gmail.com\";fullName|s:11:\"Parvendrao \";roleId|s:1:\"3\";userRole|s:8:\"Reporter\";isLoggedIn|b:1;avatar|s:35:\"1776418243_170ab6c5b2343348513a.jpg\";error|s:49:\"Access denied. Administrator privileges required.\";__ci_vars|a:1:{s:5:\"error\";s:3:\"old\";}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:31764673a80f12b43100b38120f39175', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776421069;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:35ac7b79c8718c422252d7f4a54e664f', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408730;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:360e2353da21103d7e3aa872f7f91981', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776409094;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:3610c8a0252afeea2985180452066f47', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420161;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:37bde396c5071392e5a36d3d37c18514', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407823;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:381738e28c0abc54ac9637acad70b8d6', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776409215;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:389f210fadbab1c39874fc134645ae5f', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408367;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:3b7326573ff3d4042a4addeb57bc895c', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776409276;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:3ced43cf1f0ebaa71bd6f3b79385f9a1', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407702;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:4099b7eb243768dd53827d36a52351c6', '192.168.20.61', '4294967295', '__ci_last_regenerate|i:1776420616;_ci_previous_url|s:26:\"http://192.168.20.61:8080/\";lang|s:2:\"en\";');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:40bb9d4640cb61eb64914b04c733683f', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408549;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:440ea6bf314a273d2f80652d9975eb86', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417270;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:4816151617fd8ac8a8ccf33c7918d23c', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776421190;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:48214323ba68d6621a8f8fc6ec0ff424', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776409155;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:4a342e20a540e3653401a80f1e51ff9f', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420826;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:4a7a71ce1a4796c658c883fd08ff1265', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420040;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:4c5a93264214f12904ad1d92c3ea5c3e', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418233;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:4c9c157205b364b43857fbbbda53770a', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418535;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:4d470be3a9d1fb09e142fb8e1c1046db', '192.168.20.61', '4294967295', '__ci_last_regenerate|i:1776406662;_ci_previous_url|s:42:\"http://192.168.20.61:8080/news/green-urban\";captcha_result|i:16;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:4d601fb6237f91b1e02e9094dec05a78', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418896;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:4da423642138a944798b09a4c8739844', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419378;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:4e9cb9529419b40bf6db7f52ecec5e2a', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407218;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:4f7a4c6856ac000a5e8e102042f038ac', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419016;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:500dca814076c611cf4bfa3578d23fd2', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408670;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:508b3081727ad954502d7f6115ea1786', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417330;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:5260109ce9e89bc3384bbc329e85c15a', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776409397;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:5400f35dd585fa03be14b8d3ae5f772b', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417992;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:55585b54b3610bbf1b3d0e43a998edf0', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417571;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:5ab349bc9c0ac0c3852c595249014c22', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419920;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:5d3b3d07696215a48afab6bdf1f3e408', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776409457;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:60ef564b72b7f45ab0e952be0fa9f2a1', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417149;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:61f54fad46d385c543503ce1bebf9cbf', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408246;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:64ed4154b9f5a130d2930ed482d31d85', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417511;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:6c02a45eae323532eb78df488864463e', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776406976;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:6ced49701c2682bf6e50f3bc3c59196a', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418595;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:6e3445996ff2563582029b3639c95b9b', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776406915;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:72c01d661a4fe9ef21c710b22be0fd84', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419980;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:72db6143c2013f2cf700e0520d6b5a95', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418173;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:72ecc0b288a5e4b2fc81d9ec41a7bc47', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419257;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:7723e274e774de88fae3e6da7f8cb1cf', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408851;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:7a774bb11d83492fdcd62535596c6cf0', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418354;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:7bd7ecfd44f193650627f29d537cd140', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420643;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:7e2dc3201700361330c66a68c558c1ff', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418053;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:82d70509b225b06a8bfa276b1fbe1fc6', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776421371;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:839963245f5062ac5b3d5ca3999b3560', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408912;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:87c463aefb388d8346676e00d3729677', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407157;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:884300d4379440ae4b9b9ec33f649d07', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408791;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:887d67510f6fe901d5f0c3b5dd9a8182', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419197;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:89254ad090d766ca42415e1ddee34643', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417631;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:8c3354b3810121b1aa2d9f16b8915b43', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418294;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:8e693e5f37ee8c0c6797630fbde6dec0', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420281;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:90b88b5333df897f10e0eab4df33ce18', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407097;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:9178da9cac42c4faf86ced70b238efae', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419137;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:9554298407e3caa8d95e350c9733f8d4', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408005;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:958dc43ebe28713618f838c04a0a666b', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418414;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:990bfd5cb92a8b63b694f0db6cb88172', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417691;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:9ea6b133d33815b582ae2f4765458b2c', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420887;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:9fe22dca8805876a869fbb54fbb62fa6', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776406732;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:a00fac6ac87e7cf9a48e7bccc620ab7e', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776421431;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:a1c480f631ee583640dbfa4516203b60', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407762;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:a3cef96fe2da67e65e1b9b4fe9a7590c', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419619;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:a3da041e12b73df3c34afb904aadb5d4', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408126;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:a59ecbcd3cf9c597d6c05bee87016007', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408609;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:a9f9f888dd125561a8e5978b48d0585c', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420765;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:aa7343a98214b9ef8817c11e8b033078', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407641;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:ac6df252e3a29b70b538f5be948edfe4', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417752;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:acd7a9acb619315ba887351c23a5fb37', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420462;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:acea37d81fdb80030ee9a660a3a6fd58', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776409579;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:ae1911e474599240fc2f6664ffcd8188', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417872;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:b04c329c4f0b5f9815d2796657b2ae9d', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420948;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:b87b402bf43926436d89ac585c080dc0', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776409033;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:b9429f6dd19e6c46795efc6ea27f2842', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419077;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:bbca370f352751bbd0affce1684fff56', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419318;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:bdeb5d307fbe73f168a97256210113c7', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418956;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:be5e8946db3ff656c75f9337e56b6ca1', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419739;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:bf1bf685be247661af6482b0959ca6c1', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420704;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:c2df6067b76cdd629dbd58349ae5bd83', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419559;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:c36b1e661df1da1aecd813d2b3976fb1', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408186;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:c393682194574d597b49256072831da8', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776406854;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:c793017e5c92e52a5bcb7ce0d452df1a', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418655;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:c7e48649c444be8d77de5d90241ec779', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408307;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:ce7611816d3597443120ca6279e32532', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407339;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:cf1557d7f0f1f42c1ef23bcca3e7afd1', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407581;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:d0126303ec15c825c968adae0686f340', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408428;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:d194c20b2f9d05d72841b03a7d0ed1c0', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407884;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:d2f49efe5a60adb5245823064695fe37', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417812;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:d5d5e1ddf83a2e3f3d2c3ab64c8a5daf', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417390;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:dce7502087e5cf1f730767ce5a0c77be', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419860;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:dd4eabca39773b53ff428705f60969f4', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418113;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:de1a4c8b3ecf468026b94c9ac18c09f0', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776417932;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:dea54038ed66f280e12f64c177e14da2', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419800;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:e210256d040ed0a995fb21f7a2819acd', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776406671;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:e40c7f60394a3df97feb898824cb9900', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407944;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:e42a1408265337ef13a1d66f105f8f68', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776421009;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:e50d6a0cf905ca566860c83516721719', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776409518;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:e5192433cc575469bd0c14887a1f8a7f', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776419438;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:e997b764d2619396766612e6cb5737c0', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407520;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:eaf2195ed62c38e45947a8507bc8b89d', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776420221;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:ec0398265dadeb6f0b88867255b1b573', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418715;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:ecbd9adb66fab2d6631f418dc20c398c', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418474;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:ecca4f495069fc875e0c70d71a524353', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776406794;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:eee4f7c17a8b826de0977268d75cdf7a', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776421130;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:efaa76617bf38f7452e2800dde8e1acd', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776418836;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:f3cf7c883f978b007b32577c086bb39e', '192.168.20.67', '4294967295', '__ci_last_regenerate|i:1776421018;_ci_previous_url|s:39:\"http://192.168.20.61:8080/admin/backups\";userId|s:1:\"2\";username|s:8:\"kumypyho\";email|s:23:\"parvendra@xsinfosol.com\";fullName|s:13:\"Administrator\";roleId|s:1:\"1\";userRole|s:5:\"Admin\";isLoggedIn|b:1;success|s:15:\"Backup deleted.\";__ci_vars|a:1:{s:7:\"success\";s:3:\"old\";}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:f7bd69074318ddc3127f3e404729c239', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776407460;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:fb515ea9d8e403b53d885dff8f3a94ad', '192.168.20.26', '4294967295', '__ci_last_regenerate|i:1776408488;__ci_vars|a:0:{}');
INSERT INTO `sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ci_session:fd4c7737fd6375fbd27559a559be99c8', '192.168.20.61', '4294967295', '__ci_last_regenerate|i:1776407417;_ci_previous_url|s:42:\"http://192.168.20.61:8080/news/green-urban\";__ci_vars|a:0:{}');


DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `settings` (`key`, `value`) VALUES ('activity_logs_status', '1');
INSERT INTO `settings` (`key`, `value`) VALUES ('contact_email', 'parvendra.info@gmail.com');
INSERT INTO `settings` (`key`, `value`) VALUES ('copyright_text', '© 2026 City News. All Rights Reserved.');
INSERT INTO `settings` (`key`, `value`) VALUES ('facebook_url', 'https://www.facebook.com/Citynewsofficiall/');
INSERT INTO `settings` (`key`, `value`) VALUES ('favicon', '1776393196_3c8ff718d7892ece4e3c.jpg');
INSERT INTO `settings` (`key`, `value`) VALUES ('footer_about', 'City News is your source for everything that happens in the city. Real-time news, deep dive stories and viral content.');
INSERT INTO `settings` (`key`, `value`) VALUES ('footer_banner', '1776145218_19bb774ee019a994d6ee.jpg');
INSERT INTO `settings` (`key`, `value`) VALUES ('google_analytics', '');
INSERT INTO `settings` (`key`, `value`) VALUES ('header_banner', '1776145204_e13e1af09a4fef850651.jpg');
INSERT INTO `settings` (`key`, `value`) VALUES ('instagram_url', 'https://www.instagram.com/citynews100/');
INSERT INTO `settings` (`key`, `value`) VALUES ('meta_author', 'City News');
INSERT INTO `settings` (`key`, `value`) VALUES ('meta_description', 'City News is your go-to source for breaking news, in-depth reporting and stories from across the city.');
INSERT INTO `settings` (`key`, `value`) VALUES ('meta_keywords', 'city news, local news, breaking news, hindi news');
INSERT INTO `settings` (`key`, `value`) VALUES ('meta_title', 'City News ');
INSERT INTO `settings` (`key`, `value`) VALUES ('og_image', '');
INSERT INTO `settings` (`key`, `value`) VALUES ('primary_color', '#dc2626');
INSERT INTO `settings` (`key`, `value`) VALUES ('primary_language', 'hi');
INSERT INTO `settings` (`key`, `value`) VALUES ('protection_devtools', '0');
INSERT INTO `settings` (`key`, `value`) VALUES ('protection_right_click', '0');
INSERT INTO `settings` (`key`, `value`) VALUES ('sidebar_banner', 'ad.jpg');
INSERT INTO `settings` (`key`, `value`) VALUES ('sitemap_last_generated', '2026-04-14 01:19:44');
INSERT INTO `settings` (`key`, `value`) VALUES ('site_description', 'City News is your go-to source for breaking news, in-depth reporting and stories from across the city.');
INSERT INTO `settings` (`key`, `value`) VALUES ('site_location', 'Bijnor, Uttar Pradesh, India');
INSERT INTO `settings` (`key`, `value`) VALUES ('site_logo', '1776393291_cea2235fac036aa29349.png');
INSERT INTO `settings` (`key`, `value`) VALUES ('site_name', 'City News');
INSERT INTO `settings` (`key`, `value`) VALUES ('site_tagline', 'Your City. Your News.');
INSERT INTO `settings` (`key`, `value`) VALUES ('timezone', 'Asia/Kolkata');
INSERT INTO `settings` (`key`, `value`) VALUES ('twitter_url', 'https://x.com/bijnorpolice');
INSERT INTO `settings` (`key`, `value`) VALUES ('youtube_url', 'https://www.youtube.com/channel/UCBV3Lx0462-7UaxdPtn9Gzg');


DROP TABLE IF EXISTS `sms_settings`;
CREATE TABLE `sms_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_name` varchar(100) DEFAULT 'Generic Gateway',
  `api_url` text DEFAULT NULL,
  `api_key` varchar(255) DEFAULT NULL,
  `sender_id` varchar(20) DEFAULT NULL,
  `entity_id` varchar(50) DEFAULT NULL,
  `template_id` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sms_settings` (`id`, `gateway_name`, `api_url`, `api_key`, `sender_id`, `entity_id`, `template_id`, `is_active`, `updated_at`) VALUES ('1', 'Twilio / MSG91 / Textlocal', NULL, NULL, NULL, NULL, NULL, '0', '2026-04-14 07:02:59');


DROP TABLE IF EXISTS `smtp_settings`;
CREATE TABLE `smtp_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `smtp_host` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(10) DEFAULT NULL,
  `smtp_user` varchar(255) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `smtp_crypto` enum('none','tls','ssl') DEFAULT 'tls',
  `from_email` varchar(255) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `smtp_settings` (`id`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_pass`, `smtp_crypto`, `from_email`, `from_name`, `is_active`, `updated_at`) VALUES ('1', 'lns1.xsinfosol.com', '587', 'parvendra@xsinfosol.com', 'Parvend@123', 'tls', 'parvendra@xsinfosol.com', 'parvendra', '1', '2026-04-16 00:36:33');


DROP TABLE IF EXISTS `story_slides`;
CREATE TABLE `story_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `caption` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`),
  CONSTRAINT `story_slides_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `story_slides` (`id`, `news_id`, `image`, `caption`, `sort_order`, `created_at`) VALUES ('1', '72', 'bijnor_1.jpg', 'Welcome to the historic city of Bijnor.', '0', '2026-04-14 07:49:43');
INSERT INTO `story_slides` (`id`, `news_id`, `image`, `caption`, `sort_order`, `created_at`) VALUES ('2', '72', 'bijnor_2.jpg', 'The majestic Ganges flows through our heart.', '1', '2026-04-14 07:49:43');
INSERT INTO `story_slides` (`id`, `news_id`, `image`, `caption`, `sort_order`, `created_at`) VALUES ('3', '72', 'bijnor_3.jpg', 'Explore the ancient temples and heritage.', '2', '2026-04-14 07:49:43');
INSERT INTO `story_slides` (`id`, `news_id`, `image`, `caption`, `sort_order`, `created_at`) VALUES ('4', '72', 'bijnor_4.jpg', 'Experience the vibrant local culture and food.', '3', '2026-04-14 07:49:43');


DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `status` enum('active','unsubscribed') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `subscribers` (`id`, `email`, `status`, `created_at`) VALUES ('1', 'admin@citynews.com', 'active', '2026-04-14 06:41:05');
INSERT INTO `subscribers` (`id`, `email`, `status`, `created_at`) VALUES ('2', 'user1@gmail.com', 'active', '2026-04-14 06:41:05');
INSERT INTO `subscribers` (`id`, `email`, `status`, `created_at`) VALUES ('3', 'reader@yahoo.com', 'active', '2026-04-14 06:41:05');
INSERT INTO `subscribers` (`id`, `email`, `status`, `created_at`) VALUES ('4', 'news.lover@outlook.com', 'active', '2026-04-14 06:41:05');
INSERT INTO `subscribers` (`id`, `email`, `status`, `created_at`) VALUES ('5', 'editor@test.com', 'active', '2026-04-14 06:41:05');
INSERT INTO `subscribers` (`id`, `email`, `status`, `created_at`) VALUES ('6', 'pk8265850659@gmail.com', 'active', '2026-04-14 02:17:27');


DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `telegram_settings`;
CREATE TABLE `telegram_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bot_token` varchar(255) DEFAULT NULL,
  `channel_id` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `telegram_settings` (`id`, `bot_token`, `channel_id`, `is_active`, `updated_at`) VALUES ('1', '', NULL, '0', '2026-04-14 07:06:37');


DROP TABLE IF EXISTS `user_interests`;
CREATE TABLE `user_interests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_cat` (`user_id`,`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user_interests` (`id`, `user_id`, `category_id`, `created_at`) VALUES ('10', '4', '6', '2026-04-17 14:49:28');
INSERT INTO `user_interests` (`id`, `user_id`, `category_id`, `created_at`) VALUES ('11', '4', '7', '2026-04-17 14:49:28');
INSERT INTO `user_interests` (`id`, `user_id`, `category_id`, `created_at`) VALUES ('12', '4', '8', '2026-04-17 14:49:28');


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(150) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `failed_attempts` int(11) DEFAULT 0,
  `locked_until` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_ip` varchar(45) DEFAULT NULL,
  `last_user_agent` varchar(255) DEFAULT NULL,
  `two_factor_secret` varchar(100) DEFAULT NULL,
  `two_factor_enabled` tinyint(1) DEFAULT 0,
  `password_updated_at` datetime DEFAULT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expires_at` datetime DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `role_id`, `status`, `username`, `email`, `password`, `full_name`, `avatar`, `created_at`, `updated_at`, `failed_attempts`, `locked_until`, `last_login`, `last_ip`, `last_user_agent`, `two_factor_secret`, `two_factor_enabled`, `password_updated_at`, `otp_code`, `otp_expires_at`, `reset_token`, `reset_expires_at`) VALUES ('1', '1', 'active', 'admin', '1admin@citynews.com', '.zLfCZqTfCcdLebYFV4BEQSjSzPm5gd.', 'Administrator', NULL, '2026-04-12 00:30:54', '2026-04-12 07:31:28', '0', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` (`id`, `role_id`, `status`, `username`, `email`, `password`, `full_name`, `avatar`, `created_at`, `updated_at`, `failed_attempts`, `locked_until`, `last_login`, `last_ip`, `last_user_agent`, `two_factor_secret`, `two_factor_enabled`, `password_updated_at`, `otp_code`, `otp_expires_at`, `reset_token`, `reset_expires_at`) VALUES ('2', '1', 'active', 'kumypyho', 'parvendra@xsinfosol.com', '$2y$10$gPL73EqlksJx8QoOSSTizOXe1b0lU7Fd.JdN9JW3OE6ZgF1TvHrMS', 'Administrator', NULL, '2026-04-11 19:10:44', '2026-04-17 15:47:22', '0', NULL, '2026-04-17 15:46:58', '192.168.20.67', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', NULL, '0', '2026-04-16 09:32:43', NULL, NULL, NULL, NULL);
INSERT INTO `users` (`id`, `role_id`, `status`, `username`, `email`, `password`, `full_name`, `avatar`, `created_at`, `updated_at`, `failed_attempts`, `locked_until`, `last_login`, `last_ip`, `last_user_agent`, `two_factor_secret`, `two_factor_enabled`, `password_updated_at`, `otp_code`, `otp_expires_at`, `reset_token`, `reset_expires_at`) VALUES ('4', '3', 'active', 'User', 'pk8265850659@gmail.com', '$2y$10$MIaMMhUN4efwMpzp/y0LluLz73LtPHOilrCdvlJ7eArRNoLfxr4x6', 'Parvendrao ', '1776418243_170ab6c5b2343348513a.jpg', '2026-04-17 09:24:53', '2026-04-17 15:00:43', '0', NULL, '2026-04-17 14:50:39', '192.168.20.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', NULL, '0', '2026-04-17 09:24:53', NULL, NULL, NULL, NULL);


DROP TABLE IF EXISTS `video_news`;
CREATE TABLE `video_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_hi` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description_hi` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` enum('published','draft') DEFAULT 'published',
  `author_name` varchar(255) DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `video_news` (`id`, `title_hi`, `title_en`, `video_url`, `thumbnail`, `slug`, `description_hi`, `description_en`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `author_name`, `views`, `created_at`) VALUES ('1', 'Global Climate Summit 2026 (हिन्दी)', 'Global Climate Summit 2026', 'https://youtu.be/w3bwC1yVQW4?si=hkMwsBETHhJeY41u', '1776421198_c15fb14b5f8185193db8.jpg', 'global-summit', '<p>175,167 views Feb 3, 2026 <a dir=\"auto\" href=\"https://www.youtube.com/hashtag/hindisong\">#hindisong</a> <a dir=\"auto\" href=\"https://www.youtube.com/hashtag/bollywoodsongs\">#bollywoodsongs</a> <a dir=\"auto\" href=\"https://www.youtube.com/hashtag/originalsong\">#originalsong</a></p>\r\n\r\n<p>This song is for those who spent their lives understanding everyone else, but never fully understood themselves. For those who feel like an empty room even in a crowded place. For those who never learned how to ask for love, but know exactly how to give it&mdash;with everything they have. &ldquo;Agar Tum Mil Jao&rdquo; is a soft, intimate confession. No grand promises. No loud declarations. Just quiet honesty, gentle vulnerability, and emotions that linger. It tells the story of someone who doesn&rsquo;t show their wounds, but knows how to heal. Someone who has never truly received love, and therefore understands how precious it really is. With minimal music, deep silence, and words that breathe, this song slowly finds its way into the listener&rsquo;s own heart. Listen with headphones. If this song feels even a little familiar, maybe it&rsquo;s not just a song&mdash; maybe it&rsquo;s a part of your story too. lyrics: [Intro] Agar poochho mujhse Main kya hoon&hellip; To bas ek khaali kamra Jo kisi ki aahat dhoondhta hai [Verse 1] Maine baarish ko dekha hai Par kabhi bheega nahi Maine rishton ko chhua hai Par koi apna nahi Thoda-thoda jeeta raha Bina wajah, bina naam Dil ne chaaha bahut kuchh Par maanga kabhi nahi [Pre-Chorus] Phir tum aayi Jaise andhere mein Khidki khul jaaye Aur hawa poochhe mujhse &ldquo;Ab bhi akele rehna hai?&rdquo; [Refrain &ndash; Hook] Agar tum mil jao To main woh sab doon Jo mujhe kabhi mila nahi Agar tum thaam lo To main woh sab banoon Jo mujhe banne diya nahi Agar tum keh do &ldquo;Ruko mere paas&rdquo; To saari duniya Yahin chhod doon Kyunki jo pyaar Maine maanga nahi Wo saara pyaar Main tumhe saunp doon [Verse 2] Maine khud ko hamesha Aakhir mein rakha Sabko samjha Khud ko nahi samjha Mere hisse mein Sirf khaamoshi thi Ab tum ho To shor bhi sukoon lagta [Pre-Chorus 2] Main waada nahi karta Sitare todne ka Bas itna keh sakta hoon Ki tumhari thakaan Mere kandhe pehchaan lenge [Refrain &ndash; Repeat] Agar tum mil jao To main woh sab doon Jo mujhe kabhi mila nahi Agar tum muskura do To meri har kami Mukammal ho jaaye kahin Agar tum keh do &ldquo;Yahin theek hoon&rdquo; To mera har darr Chup ho jaaye Kyunki jo pyaar Maine maanga nahi Wo saara pyaar Main tumhe saunp doon [Bridge] Main zakhm nahi dikhaunga Par bharna jaanta hoon Main oonchi awaaz nahi Par theherna jaanta hoon Agar kabhi tumhe lage Duniya bhaari hai To meri khaamoshi Tumhara ghar ban jayegi [Final Chorus ] Agar tum mil jao To main khud ko de doon Bina shart, bina sawaal Agar tum thaam lo To mera har kal Ho jayega bemisaal Maine pyaar kabhi paaya nahi Isliye jaanta hoon Pyaar kitna qeemti hota hai Aur agar tum meri hui To yaqeen maano Main woh sab doonga Jo mujhe kabhi nahi mila Aur phir bhi Muskurata rahunga [Outro] Main tumhe waada nahi Apni poori kahaani de raha hoon Agar padh sako&hellip; To reh jaana <a href=\"https://www.youtube.com/hashtag/music\" tabindex=\"0\" target=\"\">#music</a> <a href=\"https://www.youtube.com/hashtag/hindisong\" tabindex=\"0\" target=\"\">#hindisong</a> <a href=\"https://www.youtube.com/hashtag/originalsong\" tabindex=\"0\" target=\"\">#originalsong</a> <a href=\"https://www.youtube.com/hashtag/love\" tabindex=\"0\" target=\"\">#love</a> <a href=\"https://www.youtube.com/hashtag/valentine\" tabindex=\"0\" target=\"\">#valentine</a> <a href=\"https://www.youtube.com/hashtag/bollywoodsongs\" tabindex=\"0\" target=\"\">#bollywoodsongs</a> <a href=\"https://www.youtube.com/hashtag/guitar\" tabindex=\"0\" target=\"\">#guitar</a> <a href=\"https://www.youtube.com/hashtag/heart\" tabindex=\"0\" target=\"\">#heart</a></p>\r\n', '<p>175,167 views Feb 3, 2026 <a dir=\"auto\" href=\"https://www.youtube.com/hashtag/hindisong\">#hindisong</a> <a dir=\"auto\" href=\"https://www.youtube.com/hashtag/bollywoodsongs\">#bollywoodsongs</a> <a dir=\"auto\" href=\"https://www.youtube.com/hashtag/originalsong\">#originalsong</a></p>\r\n\r\n<p>This song is for those who spent their lives understanding everyone else, but never fully understood themselves. For those who feel like an empty room even in a crowded place. For those who never learned how to ask for love, but know exactly how to give it&mdash;with everything they have. &ldquo;Agar Tum Mil Jao&rdquo; is a soft, intimate confession. No grand promises. No loud declarations. Just quiet honesty, gentle vulnerability, and emotions that linger. It tells the story of someone who doesn&rsquo;t show their wounds, but knows how to heal. Someone who has never truly received love, and therefore understands how precious it really is. With minimal music, deep silence, and words that breathe, this song slowly finds its way into the listener&rsquo;s own heart. Listen with headphones. If this song feels even a little familiar, maybe it&rsquo;s not just a song&mdash; maybe it&rsquo;s a part of your story too. lyrics: [Intro] Agar poochho mujhse Main kya hoon&hellip; To bas ek khaali kamra Jo kisi ki aahat dhoondhta hai [Verse 1] Maine baarish ko dekha hai Par kabhi bheega nahi Maine rishton ko chhua hai Par koi apna nahi Thoda-thoda jeeta raha Bina wajah, bina naam Dil ne chaaha bahut kuchh Par maanga kabhi nahi [Pre-Chorus] Phir tum aayi Jaise andhere mein Khidki khul jaaye Aur hawa poochhe mujhse &ldquo;Ab bhi akele rehna hai?&rdquo; [Refrain &ndash; Hook] Agar tum mil jao To main woh sab doon Jo mujhe kabhi mila nahi Agar tum thaam lo To main woh sab banoon Jo mujhe banne diya nahi Agar tum keh do &ldquo;Ruko mere paas&rdquo; To saari duniya Yahin chhod doon Kyunki jo pyaar Maine maanga nahi Wo saara pyaar Main tumhe saunp doon [Verse 2] Maine khud ko hamesha Aakhir mein rakha Sabko samjha Khud ko nahi samjha Mere hisse mein Sirf khaamoshi thi Ab tum ho To shor bhi sukoon lagta [Pre-Chorus 2] Main waada nahi karta Sitare todne ka Bas itna keh sakta hoon Ki tumhari thakaan Mere kandhe pehchaan lenge [Refrain &ndash; Repeat] Agar tum mil jao To main woh sab doon Jo mujhe kabhi mila nahi Agar tum muskura do To meri har kami Mukammal ho jaaye kahin Agar tum keh do &ldquo;Yahin theek hoon&rdquo; To mera har darr Chup ho jaaye Kyunki jo pyaar Maine maanga nahi Wo saara pyaar Main tumhe saunp doon [Bridge] Main zakhm nahi dikhaunga Par bharna jaanta hoon Main oonchi awaaz nahi Par theherna jaanta hoon Agar kabhi tumhe lage Duniya bhaari hai To meri khaamoshi Tumhara ghar ban jayegi [Final Chorus ] Agar tum mil jao To main khud ko de doon Bina shart, bina sawaal Agar tum thaam lo To mera har kal Ho jayega bemisaal Maine pyaar kabhi paaya nahi Isliye jaanta hoon Pyaar kitna qeemti hota hai Aur agar tum meri hui To yaqeen maano Main woh sab doonga Jo mujhe kabhi nahi mila Aur phir bhi Muskurata rahunga [Outro] Main tumhe waada nahi Apni poori kahaani de raha hoon Agar padh sako&hellip; To reh jaana <a href=\"https://www.youtube.com/hashtag/music\" tabindex=\"0\" target=\"\">#music</a> <a href=\"https://www.youtube.com/hashtag/hindisong\" tabindex=\"0\" target=\"\">#hindisong</a> <a href=\"https://www.youtube.com/hashtag/originalsong\" tabindex=\"0\" target=\"\">#originalsong</a> <a href=\"https://www.youtube.com/hashtag/love\" tabindex=\"0\" target=\"\">#love</a> <a href=\"https://www.youtube.com/hashtag/valentine\" tabindex=\"0\" target=\"\">#valentine</a> <a href=\"https://www.youtube.com/hashtag/bollywoodsongs\" tabindex=\"0\" target=\"\">#bollywoodsongs</a> <a href=\"https://www.youtube.com/hashtag/guitar\" tabindex=\"0\" target=\"\">#guitar</a> <a href=\"https://www.youtube.com/hashtag/heart\" tabindex=\"0\" target=\"\">#heart</a></p>\r\n', '', '', '', 'published', 'Editor', '0', '2026-04-14 06:41:05');
INSERT INTO `video_news` (`id`, `title_hi`, `title_en`, `video_url`, `thumbnail`, `slug`, `description_hi`, `description_en`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `author_name`, `views`, `created_at`) VALUES ('2', 'The Rise of Quantum Computing (हिन्दी)', 'The Rise of Quantum Computing', 'https://youtu.be/w3bwC1yVQW4?si=hkMwsBETHhJeY41u', '1776421227_64a7deca924ff2f33500.jpg', 'quantum-rise', '', '', '', '', '', 'published', 'Editor', '0', '2026-04-14 06:41:05');
INSERT INTO `video_news` (`id`, `title_hi`, `title_en`, `video_url`, `thumbnail`, `slug`, `description_hi`, `description_en`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `author_name`, `views`, `created_at`) VALUES ('3', 'SpaceX: Moon Mission Launch (हिन्दी)', 'SpaceX: Moon Mission Launch', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1776421269_9442d25b48e325a037dc.jpg', 'spacex-moon', '', '', '', '', '', 'published', 'Editor', '0', '2026-04-14 06:41:05');
INSERT INTO `video_news` (`id`, `title_hi`, `title_en`, `video_url`, `thumbnail`, `slug`, `description_hi`, `description_en`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `author_name`, `views`, `created_at`) VALUES ('4', 'Economic Shift: The Digital Rupee (हिन्दी)', 'Economic Shift: The Digital Rupee', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1776421287_95f30e33310b6c471d6a.jpg', 'digital-rupee', '', '', '', '', '', 'published', 'Editor', '0', '2026-04-14 06:41:05');
INSERT INTO `video_news` (`id`, `title_hi`, `title_en`, `video_url`, `thumbnail`, `slug`, `description_hi`, `description_en`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `author_name`, `views`, `created_at`) VALUES ('5', 'Olympics 2026: Closing Ceremony (हिन्दी)', 'Olympics 2026: Closing Ceremony', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', '1776421301_eaf98235e3515e18aa90.jpg', 'olympics-closing', '', '', '', '', '', 'published', 'Editor', '0', '2026-04-14 06:41:05');


DROP TABLE IF EXISTS `visual_stories`;
CREATE TABLE `visual_stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_hi` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `content_hi` text DEFAULT NULL,
  `content_en` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `views` int(11) DEFAULT 0,
  `status` enum('published','draft') DEFAULT 'published',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `visual_stories` (`id`, `title_hi`, `title_en`, `image`, `content_hi`, `content_en`, `slug`, `views`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES ('1', 'Welcome back, Administrator', 'Welcome back, Administrator', '1776105028_5e7db04538ab729b5681.jpg', '<p>Welcome back, Administrator</p>\r\n', '<p>Welcome back, Administrator</p>\r\n', 'welcome-back-administrator', '0', 'draft', NULL, NULL, NULL, '2026-04-13 18:30:28');
INSERT INTO `visual_stories` (`id`, `title_hi`, `title_en`, `image`, `content_hi`, `content_en`, `slug`, `views`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES ('2', 'शहर की रातें: 2026 में आधुनिक जीवन', 'City Lights: Night Life in 2026', '1776157325_f9c2039cac1f5fefd49e.webp', '<p>शहर की रातें: 2026 में आधुनिक जीवन</p>\r\n', '<p>Exploring the vibrant neon streets of the future city.</p>\r\n', 'night-life', '12', 'published', '', '', '', '2026-04-14 06:41:05');
INSERT INTO `visual_stories` (`id`, `title_hi`, `title_en`, `image`, `content_hi`, `content_en`, `slug`, `views`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES ('3', 'शहरी क्षेत्रों में हरित क्रांति', 'Green Revolution in Urban Spaces', '1776157402_6c30647d70675de95270.jpg', '<p>शहरी क्षेत्रों में हरित क्रांति</p>\r\n', '<p>How vertical gardens are changing our skyline.</p>\r\n', 'green-urban', '35', 'published', '', '', '', '2026-04-14 06:41:05');
INSERT INTO `visual_stories` (`id`, `title_hi`, `title_en`, `image`, `content_hi`, `content_en`, `slug`, `views`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES ('4', 'टेक एक्सपो: एआई की बड़ी उपलब्धि', 'Tech Expo: The AI Breakthrough', 'story3.jpg', 'टेक एक्सपो: एआई की बड़ी उपलब्धि', 'A deep dive into the latest neural interface technology.', 'tech-expo', '2', 'published', NULL, NULL, NULL, '2026-04-14 06:41:05');
INSERT INTO `visual_stories` (`id`, `title_hi`, `title_en`, `image`, `content_hi`, `content_en`, `slug`, `views`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES ('5', 'भविष्य का भोजन: हम क्या खाएंगे', 'Future Food: What We Will Eat', 'story4.png', 'भविष्य का भोजन: हम क्या खाएंगे', 'Lab-grown meat and sustainable farming at scale.', 'future-food', '13', 'published', NULL, NULL, NULL, '2026-04-14 06:41:05');
INSERT INTO `visual_stories` (`id`, `title_hi`, `title_en`, `image`, `content_hi`, `content_en`, `slug`, `views`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES ('6', 'मंगल कॉलोनी: पहले 100 दिन', 'Mars Colony: First 100 Days', 'story5.png', 'मंगल कॉलोनी: पहले 100 दिन', 'Live updates from the first human settlement on Mars.', 'mars-colony', '2', 'published', NULL, NULL, NULL, '2026-04-14 06:41:05');


DROP TABLE IF EXISTS `whatsapp_settings`;
CREATE TABLE `whatsapp_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gateway_name` varchar(100) DEFAULT 'Meta Business API',
  `api_url` varchar(255) DEFAULT 'https://graph.facebook.com/v17.0/',
  `api_key` text DEFAULT NULL,
  `phone_number_id` varchar(100) DEFAULT NULL,
  `waba_id` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `whatsapp_settings` (`id`, `gateway_name`, `api_url`, `api_key`, `phone_number_id`, `waba_id`, `is_active`, `updated_at`) VALUES ('1', 'Meta Cloud API / Wathi / Interakt', 'https://graph.facebook.com/v17.0/', NULL, NULL, NULL, '0', '2026-04-14 07:04:26');


