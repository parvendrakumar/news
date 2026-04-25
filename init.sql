CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    permissions TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(150),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX (role_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent_id INT DEFAULT 0,
    slug VARCHAR(150) NOT NULL UNIQUE,
    image VARCHAR(255),
    meta_title VARCHAR(200),
    meta_description TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    INDEX (parent_id),
    INDEX (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS category_translations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    language VARCHAR(5) NOT NULL,
    title VARCHAR(150) NOT NULL,
    INDEX (category_id),
    INDEX (language)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    image VARCHAR(255),
    gallery JSON,
    author_id INT NOT NULL,
    status ENUM('published', 'draft', 'scheduled') DEFAULT 'draft',
    publish_at TIMESTAMP NULL,
    is_video_news BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX (category_id),
    INDEX (status),
    INDEX (created_at),
    INDEX (publish_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS news_translations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    news_id INT NOT NULL,
    language VARCHAR(5) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description LONGTEXT,
    meta_title VARCHAR(200),
    meta_keywords TEXT,
    meta_description TEXT,
    INDEX (news_id),
    INDEX (language),
    FULLTEXT INDEX (title, description)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS news_videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    news_id INT NOT NULL,
    video_url VARCHAR(255),
    video_id VARCHAR(50),
    thumbnail VARCHAR(255),
    INDEX (news_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(100) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS news_tag (
    news_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (news_id, tag_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS news_views (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    news_id INT NOT NULL,
    view_date DATE NOT NULL,
    view_count INT DEFAULT 1,
    UNIQUE INDEX news_date (news_id, view_date),
    INDEX (news_id),
    INDEX (view_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    news_id INT NOT NULL,
    user_name VARCHAR(100),
    comment_text TEXT,
    is_approved BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (news_id),
    INDEX (is_approved)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS settings (
    `key` VARCHAR(100) PRIMARY KEY,
    `value` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Initial Seed Data
INSERT INTO roles (name, permissions) VALUES ('Admin', '{"all": true}'), ('Editor', '{"news": ["create", "edit", "publish"]}'), ('Reporter', '{"news": ["create", "edit"]}');

-- Add some default settings
INSERT INTO settings (`key`, `value`) VALUES 
('site_name', 'City News Nidhi Sharma'),
('site_logo', ''),
('primary_language', 'hi'),
('contact_email', 'info@citynews.com');

-- Default User (password is 'admin123')
INSERT INTO users (role_id, username, email, password, full_name) VALUES 
(1, 'admin', 'admin@citynews.com', '$2y$10$0UPAXMxwoTaYo8Dc1RG5U.zLfCZqTfCcdLebYFV4BEQSjSzPm5gd.', 'Administrator');
