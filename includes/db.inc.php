<?php
/*
 * Opens the mysqli connection as $conn and makes sure the database and all
 * of the site's tables exist (users, admins, contributions, enquiries and
 * plants). The same schema is in sql/user_management.sql for importing
 * through phpMyAdmin.
 *
 * The default admin account is Admin / Admin. Both are matched without
 * regard to case: MySQL's default collation ignores case for the username,
 * and the password is lower-cased before it is hashed or checked.
 */
require_once __DIR__ . '/settings.inc.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($host, $user, $pwd);
    mysqli_set_charset($conn, 'utf8mb4');
    mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$sql_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    mysqli_select_db($conn, $sql_db);

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `admin` (
        admin_id      INT UNSIGNED NOT NULL AUTO_INCREMENT,
        username      VARCHAR(20)  NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (admin_id),
        UNIQUE KEY uq_admin_username (username)
    )");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `user` (
        user_id       INT UNSIGNED NOT NULL AUTO_INCREMENT,
        first_name    VARCHAR(25)  NOT NULL,
        last_name     VARCHAR(25)  NOT NULL,
        username      VARCHAR(10)  NOT NULL,
        email         VARCHAR(100) NOT NULL,
        street        VARCHAR(40)  NOT NULL,
        city          VARCHAR(20)  NOT NULL,
        state         VARCHAR(20)  NOT NULL,
        postcode      CHAR(5)      NOT NULL,
        phone         VARCHAR(10)  NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (user_id),
        UNIQUE KEY uq_user_username (username)
    )");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `contribution` (
        contribution_id  INT UNSIGNED NOT NULL AUTO_INCREMENT,
        contributor_name VARCHAR(25)  NOT NULL,
        plant_name       VARCHAR(25)  NOT NULL,
        comments         TEXT         NOT NULL,
        status           ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
        created_at       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (contribution_id)
    )");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `contribution_photo` (
        photo_id        INT UNSIGNED NOT NULL AUTO_INCREMENT,
        contribution_id INT UNSIGNED NOT NULL,
        file_path       VARCHAR(255) NOT NULL,
        PRIMARY KEY (photo_id),
        FOREIGN KEY (contribution_id) REFERENCES `contribution` (contribution_id) ON DELETE CASCADE
    )");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `enquiry` (
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
    )");

    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `plant` (
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
    )");

    // Seed the default admin the first time the table is created.
    $result = mysqli_query($conn, 'SELECT COUNT(*) FROM `admin`');
    if ((int) mysqli_fetch_row($result)[0] === 0) {
        $stmt = mysqli_prepare($conn, 'INSERT INTO `admin` (username, password_hash) VALUES (?, ?)');
        $adminName = 'Admin';
        $adminHash = password_hash(strtolower('Admin'), PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, 'ss', $adminName, $adminHash);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
} catch (mysqli_sql_exception $e) {
    error_log('Database error: ' . $e->getMessage());
    http_response_code(500);
    exit('<p>Sorry, the database is unavailable right now. Please make sure MySQL is running and try again.</p>');
}
