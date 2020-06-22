-- create user table

CREATE TABLE users (
	id INT PRIMARY KEY AUTO_INCREMENT,
    uid VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL,
    library_name VARCHAR(100) NOT NULL,
    pwd VARCHAR(400) NOT NULL
);