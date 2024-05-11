CREATE DATABASE IF NOT EXISTS glamour_styles_database;

USE glamour_styles_database;

CREATE TABLE IF NOT EXISTS roles(
	id_role INT NOT NULL,
    role_name VARCHAR(55) NOT NULL,
    PRIMARY KEY(id_role)
);

CREATE TABLE IF NOT EXISTS services(
	id_service INT NOT NULL AUTO_INCREMENT,
	service_name VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL,
    image_path TEXT NOT NULL,
    PRIMARY KEY(id_service)
);

CREATE TABLE IF NOT EXISTS users(
	id_user INT NOT NULL AUTO_INCREMENT,
    role_id INT NOT NULL,
    service_id INT DEFAULT NULL,
    names VARCHAR(255) NOT NULL,
    lastnames VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    address TEXT NOT NULL,
    phone_number VARCHAR(55) NOT NULL,
    salary FLOAT DEFAULT NULL,
    dci VARCHAR(55) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
    password TEXT DEFAULT NULL,
    token TEXT DEFAULT NULL,
    time_token INT DEFAULT NULL,
	PRIMARY KEY(id_user),
    FOREIGN KEY(role_id) REFERENCES roles(id_role),
    FOREIGN KEY(service_id) REFERENCES services(id_service)
);

CREATE TABLE IF NOT EXISTS schedules(
	id_schedules INT NOT NULL AUTO_INCREMENT,
    customer_id INT NOT NULL,
    employee_id INT NOT NULL,
    service_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    color VARCHAR(50) NOT NULL,
    date_schedules DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    attendance INT DEFAULT NULL,
    PRIMARY KEY(id_schedules),
    FOREIGN KEY(customer_id) REFERENCES users(id_user),
    FOREIGN KEY(employee_id) REFERENCES users(id_user),
    FOREIGN KEY(service_id) REFERENCES services(id_service)
);

