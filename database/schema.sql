CREATE DATABASE IF NOT EXISTS clinic_monitoring_system;
USE clinic_monitoring_system;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  username VARCHAR(60) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_no VARCHAR(50) NOT NULL UNIQUE,
  first_name VARCHAR(80) NOT NULL,
  last_name VARCHAR(80) NOT NULL,
  course VARCHAR(120) NULL,
  year_level VARCHAR(20) NULL,
  birth_date DATE NULL,
  sex ENUM('Male','Female') DEFAULT 'Male',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE employees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  employee_no VARCHAR(50) NOT NULL UNIQUE,
  first_name VARCHAR(80) NOT NULL,
  last_name VARCHAR(80) NOT NULL,
  department VARCHAR(120) NULL,
  position VARCHAR(120) NULL,
  birth_date DATE NULL,
  sex ENUM('Male','Female') DEFAULT 'Male',
  physical_exam VARCHAR(255) NULL,
  drug_test VARCHAR(255) NULL,
  dental_benefits VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vaccinations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  vaccine_name VARCHAR(120) NOT NULL,
  dose VARCHAR(30) NULL,
  date_administered DATE NULL,
  notes TEXT NULL,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

CREATE TABLE lab_results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  test_type VARCHAR(120) NOT NULL,
  result VARCHAR(255) NULL,
  test_date DATE NULL,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

CREATE TABLE inventory (
  id INT AUTO_INCREMENT PRIMARY KEY,
  item_name VARCHAR(120) NOT NULL,
  category VARCHAR(120) NOT NULL,
  quantity INT NOT NULL DEFAULT 0,
  expiration_date DATE NULL,
  is_damaged TINYINT(1) DEFAULT 0,
  batch_no VARCHAR(80) NULL,
  notes TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE visits (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NULL,
  employee_id INT NULL,
  visit_datetime DATETIME NOT NULL,
  complaint TEXT NOT NULL,
  intervention TEXT NULL,
  disposition VARCHAR(150) NULL,
  private_notes TEXT NULL,
  CONSTRAINT chk_visit_patient CHECK ((student_id IS NOT NULL AND employee_id IS NULL) OR (student_id IS NULL AND employee_id IS NOT NULL)),
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE SET NULL,
  FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE SET NULL
);

CREATE TABLE consultations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NULL,
  employee_id INT NULL,
  consultation_date DATE NOT NULL,
  complaint TEXT NOT NULL,
  diagnosis TEXT NOT NULL,
  treatment TEXT NULL,
  confidential_notes TEXT NULL,
  CONSTRAINT chk_consult_patient CHECK ((student_id IS NOT NULL AND employee_id IS NULL) OR (student_id IS NULL AND employee_id IS NOT NULL)),
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE SET NULL,
  FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE SET NULL
);

CREATE TABLE borrowing_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  borrower_name VARCHAR(120) NOT NULL,
  inventory_id INT NOT NULL,
  date_borrowed DATE NOT NULL,
  date_returned DATE NULL,
  item_condition VARCHAR(120) NULL,
  staff_name VARCHAR(120) NOT NULL,
  FOREIGN KEY (inventory_id) REFERENCES inventory(id) ON DELETE RESTRICT
);

CREATE TABLE first_aid_records (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NULL,
  employee_id INT NULL,
  record_datetime DATETIME NOT NULL,
  cause TEXT NOT NULL,
  first_aid_treatment TEXT NOT NULL,
  diagnosis TEXT NOT NULL,
  CONSTRAINT chk_firstaid_patient CHECK ((student_id IS NOT NULL AND employee_id IS NULL) OR (student_id IS NULL AND employee_id IS NOT NULL)),
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE SET NULL,
  FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE SET NULL
);

INSERT INTO users (full_name, username, password) VALUES
('System Administrator', 'admin', '$2y$10$R5P5/XwzCROTx8Jx85TRW.k6v52Nmnif6xvYIh9n6D6M7UAuRdR8K');
-- password: admin123
