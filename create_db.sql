CREATE DATABASE taskvictor;

USE taskvictor;

CREATE TABLE client (
  id_client INT PRIMARY KEY AUTO_INCREMENT,
  lastname_client VARCHAR(255),
  firstname_client VARCHAR(255),
  email_client VARCHAR(255),
  password_client VARCHAR(255)
);

CREATE TABLE task (
  id_task INT PRIMARY KEY AUTO_INCREMENT,
  description_task VARCHAR(255),
  date_creation DATETIME,
  status_task TINYINT(1) DEFAULT 0,
  client_id INT,
  FOREIGN KEY (client_id) REFERENCES client(id)
);

CREATE TABLE notification (
  id_notification INT PRIMARY KEY AUTO_INCREMENT,
  message VARCHAR(255),
  created_at DATETIME
);

ALTER TABLE task ADD COLUMN task_order INT DEFAULT NULL;