-- Create database
CREATE DATABASE IF NOT EXISTS production_management;
USE production_management;

-- Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    matricule VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100) NOT NULL,
    role ENUM('admin', 'staff') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Machines table
CREATE TABLE machines (
    id INT PRIMARY KEY AUTO_INCREMENT,
    matricule VARCHAR(50) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    status ENUM('active', 'inactive', 'maintenance') NOT NULL,
    worktime INT NOT NULL, -- in minutes
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Stock table
CREATE TABLE stock (
    id INT PRIMARY KEY AUTO_INCREMENT,
    matricule VARCHAR(50) UNIQUE NOT NULL,
    machine_id INT,
    description TEXT,
    quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (machine_id) REFERENCES machines(id)
);

-- Planning table
CREATE TABLE planning (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Staff table
CREATE TABLE staff (
    id INT PRIMARY KEY AUTO_INCREMENT,
    matricule VARCHAR(50) UNIQUE NOT NULL,
    level VARCHAR(50) NOT NULL,
    join_date DATE NOT NULL,
    planning_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (planning_id) REFERENCES planning(id)
);

-- History table
CREATE TABLE history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    machine_id INT,
    staff_id INT,
    stock_id INT,
    start_time DATETIME NOT NULL,
    end_time DATETIME,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (machine_id) REFERENCES machines(id),
    FOREIGN KEY (staff_id) REFERENCES staff(id),
    FOREIGN KEY (stock_id) REFERENCES stock(id)
);

-- Reviews table
CREATE TABLE reviews (
    id INT PRIMARY KEY AUTO_INCREMENT,
    history_id INT,
    quality_score INT CHECK (quality_score BETWEEN 1 AND 4),
    efficiency_score INT CHECK (efficiency_score BETWEEN 1 AND 4),
    safety_score INT CHECK (safety_score BETWEEN 1 AND 4),
    remark TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (history_id) REFERENCES history(id)
);

-- Insert default planning times
INSERT INTO planning (name, start_time, end_time) VALUES
('Planning 1', '08:00:00', '10:00:00'),
('Planning 2', '10:00:00', '12:00:00'),
('Planning 3', '12:00:00', '14:00:00'),
('Planning 4', '14:00:00', '16:00:00'),
('Planning 5', '16:00:00', '18:00:00'),
('Planning 6', '18:00:00', '20:00:00'),
('Planning 7', '20:00:00', '22:00:00'),
('Planning 8', '22:00:00', '00:00:00'),
('Planning 9', '00:00:00', '02:00:00'),
('Planning 10', '02:00:00', '04:00:00'); 