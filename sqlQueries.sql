drop database library_system;
CREATE DATABASE library_system;
USE library_system;
CREATE TABLE admin(id INT  AUTO_INCREMENT PRIMARY KEY, 
					 firstname VARCHAR (100) NOT NULL,
                     lastname VARCHAR (100) NOT NULL,
                     phone_number VARCHAR (100) NOT NULL,
                     email_address VARCHAR (100),
                     password VARCHAR (300) NOT NULL,
                     status ENUM('0','1') DEFAULT '0',
                     inserted_dt DATETIME DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE genres(id INT AUTO_INCREMENT PRIMARY KEY, 
					genre_id VARCHAR (10) NOT NULL,
                    genre_name VARCHAR (50) NOT NULL,
                    no_of_books INT  DEFAULT 0,
                    inserted_date DATETIME DEFAULT CURRENT_TIMESTAMP);
                    
CREATE TABLE book_types(id INT  AUTO_INCREMENT PRIMARY KEY, 
						book_type_id VARCHAR (10) NOT NULL,
                        book_type_name VARCHAR (50) NOT NULL,
                        no_of_books INT DEFAULT 0,
                        inserted_date DATETIME DEFAULT CURRENT_TIMESTAMP);

CREATE TABLE authors (id INT  AUTO_INCREMENT PRIMARY KEY, 
					  author_id VARCHAR (10) NOT NULL,
                      author_name VARCHAR (100) NOT NULL,
                      no_of_books INT  default 0,
                      inserted_date DATETIME default CURRENT_TIMESTAMP);
                        
CREATE TABLE books (id INT  AUTO_INCREMENT PRIMARY KEY,
					book_id VARCHAR (10) NOT NULL,
                    title VARCHAR (100) NOT NULL,
                    author_id VARCHAR (10) NOT NULL,
                    year_of_production INT ,
                    age_barrier INT  DEFAULT 0,
                    no_of_pages INT  NOT NULL,
                    book_type_id VARCHAR (10) NOT NULL,
                    genre_id VARCHAR (10) NOT NULL,
                    status ENUM('0','1','2') NOT NULL DEFAULT '0',
                    inserted_dt DATETIME DEFAULT CURRENT_TIMESTAMP);

CREATE TABLE student(id INT  AUTO_INCREMENT PRIMARY KEY, 
					 firstname VARCHAR (100) NOT NULL,
                     lastname VARCHAR (100) NOT NULL,
                     phone_number VARCHAR (100) NOT NULL,
                     email_address VARCHAR (100),
                     address VARCHAR (300) NOT NULL,
                     date_of_birth DATE NOT NULL,
                     status ENUM('0','1') DEFAULT '0',
                     inserted_dt DATETIME DEFAULT CURRENT_TIMESTAMP);

CREATE TABLE book_logs (id INT  AUTO_INCREMENT PRIMARY KEY,
						book_id VARCHAR(10) not null,
                        student_id varchar(10) not null,
						borrowed_date DATETIME DEFAULT CURRENT_TIMESTAMP,
                        return_date DATE);
                        
alter table genres add column description varchar(500);