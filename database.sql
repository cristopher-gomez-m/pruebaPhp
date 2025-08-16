CREATE DATABASE IF NOT EXISTS consultorio;
USE consultorio;

CREATE TABLE IF NOT EXISTS citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre TEXT,
    especialidad ENUM('medicina general','pediatria','dermatologia') NOT NULL,
    fecha DATE NOT NULL
);
