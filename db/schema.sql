-- ========================================
-- Expense Tracker Database Schema
-- Database: expense_tracker
-- Created: 2026-07-28
-- ========================================

-- Create database
CREATE DATABASE IF NOT EXISTS expense_tracker
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE expense_tracker;

-- ========================================
-- Table: users
-- ========================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    profile_picture VARCHAR(255),
    currency VARCHAR(3) DEFAULT 'USD',
    date_format VARCHAR(20) DEFAULT 'Y-m-d',
    email_notifications TINYINT(1) DEFAULT 1,
    remember_token VARCHAR(100),
    email_verified_at TIMESTAMP NULL,
    role TINYINT DEFAULT 1 COMMENT '1=user, 2=admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: categories
-- ========================================
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL COMMENT 'NULL for default categories',
    name VARCHAR(50) NOT NULL,
    type TINYINT NOT NULL COMMENT '1=income, 2=expense',
    icon VARCHAR(50),
    color VARCHAR(7) DEFAULT '#000000',
    is_default TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_type (user_id, type),
    INDEX idx_type (type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: transactions
-- ========================================
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    type TINYINT NOT NULL COMMENT '1=income, 2=expense',
    amount DECIMAL(10,2) NOT NULL,
    description TEXT,
    date DATE NOT NULL,
    receipt_image VARCHAR(255),
    is_recurring TINYINT(1) DEFAULT 0,
    recurring_frequency TINYINT COMMENT '1=daily, 2=weekly, 3=monthly, 4=yearly',
    parent_transaction_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT,
    FOREIGN KEY (parent_transaction_id) REFERENCES transactions(id) ON DELETE SET NULL,
    INDEX idx_user_date (user_id, date),
    INDEX idx_user_category (user_id, category_id),
    INDEX idx_user_type (user_id, type),
    INDEX idx_date (date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: budgets
-- ========================================
CREATE TABLE IF NOT EXISTS budgets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    month DATE NOT NULL COMMENT 'Stores first day of month (YYYY-MM-01)',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    UNIQUE KEY uk_user_category_month (user_id, category_id, month),
    INDEX idx_user_month (user_id, month)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: settings
-- ========================================
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    `key` VARCHAR(100) NOT NULL,
    value TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY uk_user_key (user_id, `key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: password_resets
-- ========================================
CREATE TABLE IF NOT EXISTS password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_token (token)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Default Data: Categories
-- ========================================

-- Default Income Categories
INSERT INTO categories (name, type, icon, color, is_default, user_id) VALUES
('Salary', 1, 'bi-briefcase', '#28a745', 1, NULL),
('Freelance', 1, 'bi-laptop', '#17a2b8', 1, NULL),
('Investment', 1, 'bi-graph-up', '#ffc107', 1, NULL),
('Gift', 1, 'bi-gift', '#e83e8c', 1, NULL),
('Other Income', 1, 'bi-three-dots', '#6c757d', 1, NULL);

-- Default Expense Categories
INSERT INTO categories (name, type, icon, color, is_default, user_id) VALUES
('Food', 2, 'bi-utensils', '#dc3545', 1, NULL),
('Transport', 2, 'bi-bus', '#fd7e14', 1, NULL),
('Housing', 2, 'bi-house', '#20c997', 1, NULL),
('Utilities', 2, 'bi-lightning', '#6610f2', 1, NULL),
('Entertainment', 2, 'bi-film', '#e83e8c', 1, NULL),
('Shopping', 2, 'bi-cart', '#d63384', 1, NULL),
('Healthcare', 2, 'bi-heart', '#dc3545', 1, NULL),
('Education', 2, 'bi-book', '#0d6efd', 1, NULL),
('Other Expense', 2, 'bi-three-dots', '#6c757d', 1, NULL);

-- ========================================
-- Sample Data: Admin User (Optional)
-- Password: admin123 (bcrypt hash)
-- ========================================
-- INSERT INTO users (username, email, password, first_name, last_name, role, email_verified_at)
-- VALUES ('admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin', 'User', 2, NOW());

-- ========================================
-- Sample Data: Regular User (Optional)
-- Password: user123 (bcrypt hash)
-- ========================================
-- INSERT INTO users (username, email, password, first_name, last_name, role, email_verified_at)
-- VALUES ('john', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'John', 'Doe', 1, NOW());

-- ========================================
-- Notes
-- ========================================
-- 1. All ENUM columns replaced with TINYINT
-- 2. Type values: 1=income, 2=expense
-- 3. Role values: 1=user, 2=admin
-- 4. Recurring frequency: 1=daily, 2=weekly, 3=monthly, 4=yearly
-- 5. Boolean flags: 1=true/active, 0=false/inactive
-- 6. Default categories have user_id=NULL so they can be shared
-- 7. Password hashes are bcrypt (generated by password_hash())
-- 8. Run this file in phpMyAdmin or MySQL CLI: mysql -u root -p expense_tracker < db/schema.sql
