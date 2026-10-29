-- Database schema for Plant Story: users, admins, contributions, enquiries and plants.
-- includes/db.inc.php creates these automatically on first use; this file
-- is for importing manually through phpMyAdmin if preferred.

CREATE DATABASE IF NOT EXISTS plantstory_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE plantstory_db;

CREATE TABLE IF NOT EXISTS `admin` (
    admin_id      INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username      VARCHAR(20)  NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (admin_id),
    UNIQUE KEY uq_admin_username (username)
);

CREATE TABLE IF NOT EXISTS `user` (
    user_id       INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name    VARCHAR(25)  NOT NULL,   -- letters only
    last_name     VARCHAR(25)  NOT NULL,   -- letters only
    username      VARCHAR(10)  NOT NULL,   -- letters, digits, underscore
    email         VARCHAR(100) NOT NULL,
    street        VARCHAR(40)  NOT NULL,
    city          VARCHAR(20)  NOT NULL,
    state         VARCHAR(20)  NOT NULL,   -- one of the 16 Malaysian states / territories
    postcode      CHAR(5)      NOT NULL,   -- exactly 5 digits
    phone         VARCHAR(10)  NOT NULL,   -- up to 10 digits
    password_hash VARCHAR(255) NOT NULL,   -- password_hash() output, never plain text
    created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id),
    UNIQUE KEY uq_user_username (username)
);

-- Plant contributions sent in from contribute.php; reviewed by the admin.
CREATE TABLE IF NOT EXISTS `contribution` (
    contribution_id  INT UNSIGNED NOT NULL AUTO_INCREMENT,
    contributor_name VARCHAR(25)  NOT NULL,   -- letters and spaces
    plant_name       VARCHAR(25)  NOT NULL,   -- letters and spaces
    comments         TEXT         NOT NULL,
    status           ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    created_at       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (contribution_id)
);

-- One row per uploaded photo; removed with its contribution.
CREATE TABLE IF NOT EXISTS `contribution_photo` (
    photo_id        INT UNSIGNED NOT NULL AUTO_INCREMENT,
    contribution_id INT UNSIGNED NOT NULL,
    file_path       VARCHAR(255) NOT NULL,   -- relative to the site root, e.g. uploads/contributions/ab12.jpg
    PRIMARY KEY (photo_id),
    FOREIGN KEY (contribution_id) REFERENCES `contribution` (contribution_id) ON DELETE CASCADE
);

-- Messages sent from enquiry.php.
CREATE TABLE IF NOT EXISTS `enquiry` (
    enquiry_id   INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name   VARCHAR(25)  NOT NULL,
    last_name    VARCHAR(25)  NOT NULL,
    email        VARCHAR(100) NOT NULL,
    phone        VARCHAR(10)  NOT NULL,
    enquiry_type ENUM('families', 'genera', 'species') NOT NULL,
    comments     TEXT         NOT NULL,
    status       ENUM('new', 'read', 'replied') NOT NULL DEFAULT 'new',
    created_at   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (enquiry_id)
);

-- Species added by the admin; listed publicly on plants.php.
CREATE TABLE IF NOT EXISTS `plant` (
    plant_id        INT UNSIGNED NOT NULL AUTO_INCREMENT,
    scientific_name VARCHAR(100) NOT NULL,
    common_name     VARCHAR(100) NOT NULL DEFAULT '',
    family          VARCHAR(50)  NOT NULL,
    genus           VARCHAR(50)  NOT NULL,
    plant_type      VARCHAR(20)  NOT NULL,
    description     TEXT         NOT NULL,
    image_path      VARCHAR(255) NOT NULL,
    created_at      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (plant_id),
    UNIQUE KEY uq_plant_scientific_name (scientific_name)
);

-- Default admin: username Admin, password Admin (both case-insensitive).
-- The hash below is password_hash('admin'); db.inc.php inserts an
-- equivalent row automatically when the admin table is empty.
INSERT INTO `admin` (username, password_hash)
SELECT 'Admin', '$2y$10$XQ.LDjB0DLEGMmOXHUY1iOnYzLHARf9f.msbSZnD8PKNF35MChKgq'
WHERE NOT EXISTS (SELECT 1 FROM `admin`);
