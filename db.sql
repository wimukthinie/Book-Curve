CREATE DATABASE book_club;

USE book_club;

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    genre VARCHAR(255) NOT NULL,
    review TEXT NOT NULL,
    image VARCHAR(255) NOT NULL
);
