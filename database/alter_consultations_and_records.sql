USE clinic_monitoring_system;

ALTER TABLE consultations DROP FOREIGN KEY IF EXISTS consultations_ibfk_1;
ALTER TABLE consultations DROP FOREIGN KEY IF EXISTS consultations_ibfk_2;
ALTER TABLE consultations DROP COLUMN IF EXISTS student_id;
ALTER TABLE consultations DROP COLUMN IF EXISTS employee_id;
ALTER TABLE consultations DROP COLUMN IF EXISTS consultation_date;
ALTER TABLE consultations DROP COLUMN IF EXISTS diagnosis;
ALTER TABLE consultations DROP COLUMN IF EXISTS treatment;
ALTER TABLE consultations DROP COLUMN IF EXISTS confidential_notes;
ALTER TABLE consultations ADD COLUMN IF NOT EXISTS consult_datetime DATETIME NOT NULL AFTER id;
ALTER TABLE consultations ADD COLUMN IF NOT EXISTS patient_id INT NOT NULL AFTER consult_datetime;
ALTER TABLE consultations ADD COLUMN IF NOT EXISTS patient_type ENUM('Student','Employee') NOT NULL AFTER patient_id;
ALTER TABLE consultations ADD COLUMN IF NOT EXISTS complaint TEXT NOT NULL AFTER patient_type;
ALTER TABLE consultations ADD COLUMN IF NOT EXISTS intervention TEXT NULL AFTER complaint;
ALTER TABLE consultations ADD COLUMN IF NOT EXISTS disposition VARCHAR(150) NULL AFTER intervention;
ALTER TABLE consultations ADD COLUMN IF NOT EXISTS private_notes TEXT NULL AFTER disposition;

CREATE TABLE IF NOT EXISTS student_labs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  lab_type VARCHAR(120) NOT NULL,
  record_date DATE NOT NULL,
  file_path VARCHAR(255) NULL,
  result_summary TEXT NULL,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS student_vaccinations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  dose ENUM('1st','2nd','3rd') NOT NULL,
  record_date DATE NOT NULL,
  file_path VARCHAR(255) NULL,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS student_drug_tests (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  record_date DATE NOT NULL,
  result VARCHAR(120) NOT NULL,
  notes TEXT NULL,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS employee_health_records (
  id INT AUTO_INCREMENT PRIMARY KEY,
  employee_id INT NOT NULL,
  record_type ENUM('Physical Exam','Drug Test','Dental Benefits') NOT NULL,
  record_date DATE NOT NULL,
  results TEXT NOT NULL,
  notes TEXT NULL,
  FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS damaged_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  item_name VARCHAR(120) NOT NULL,
  description TEXT NULL,
  quantity INT NOT NULL,
  record_date DATE NOT NULL
);
