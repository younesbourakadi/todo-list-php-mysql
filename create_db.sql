CREATE DATABASE taskvictor;

USE taskvictor;

CREATE TABLE client (
  id_client INT PRIMARY KEY AUTO_INCREMENT,
  lastname_client VARCHAR(255),
  firstname_client VARCHAR(255),
  email_client VARCHAR(255)
  password_client VARCHAR(255)
);

CREATE TABLE task (
  id_task INT PRIMARY KEY AUTO_INCREMENT,
  description_task VARCHAR(255),
  date_creation DATETIME,
  client_id INT,
  FOREIGN KEY (client_id) REFERENCES client(id)
);

